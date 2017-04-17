<?php

namespace App\Http\Controllers\Home;

use App\Repositories\IndexUserLoginRepository;
use App\Repositories\LogUserLoginRepository;
use App\Repositories\RegisterRepository;
use App\Repositories\UserInfoRepository;
use App\Tools\Common;
use App\Tools\LogOperation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use iscms\Alisms\SendsmsPusher as Sms;
use Mockery\Exception;

class RegisterController extends Controller
{

    /**
     * log日志
     * @var LogOperation
     */
    protected $log;

    /**
     * 阿里大鱼
     * @var Sms
     */
    protected $sms;
    /**
     * @var RegisterRepository
     */
    protected $register;

    /**
     * @var UserInfoRepository
     */
    protected $userInfo;
    /**
     * @var IndexUserLoginRepository
     */
    protected $indexUserLogin;
    /**
     * @var LogUserLoginRepository
     */
    protected $logUserLogin;

    /**
     * RegisterController constructor.
     * @param LogOperation $logOperation
     * @param Sms $sms
     * @param RegisterRepository $registerRepository
     * @param UserInfoRepository $userInfoRepository
     * @param IndexUserLoginRepository $indexUserLoginRepository
     * @param LogUserLoginRepository $logUserLoginRepository
     * @author zhangyuchao
     */
    public function __construct
    (
        LogOperation $logOperation,
        Sms $sms,
        RegisterRepository $registerRepository,
        UserInfoRepository $userInfoRepository,
        IndexUserLoginRepository $indexUserLoginRepository,
        LogUserLoginRepository $logUserLoginRepository
    )
    {

        // log日志
        $this->log = $logOperation;
        // 阿里大鱼短信
        $this->sms = $sms;
        // 注册原始数据表辅助模型
        $this->register = $registerRepository;
        // 用户信息表
        $this->userInfo = $userInfoRepository;
        // 用户登录索引表
        $this->indexUserLogin = $indexUserLoginRepository;
        // 用户登录日志表
        $this->logUserLogin = $logUserLoginRepository;

    }

    /**
     * 返回用户注册视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function register()
    {
        return view('home.register');
    }

    /**
     * 发送手机验证码
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhangyuchao
     */
    public function sendMobileCode(Request $request)
    {
        // 去用户登录表里边查询
        $result = $this->indexUserLogin->findOneUserManner(['login_name' => $request['tel']]);
        if ($result) return responseMsg('手机号码已注册!', 400);
        // 判断手机号码是否重复发送
        $exists = \Redis::exists(STRING_USER_VERIFY_CODE_ . $request['tel']);
        if (!empty($exists)) return responseMsg('重复发送', 400);
        // 生成验证码
        $num = rand(100000, 999999);
        // 接收人手机号
        $phone = $request['tel'];
        // 阿里大鱼模板签名  可替换
        $name = 'laravl商城';
        // 阿里大鱼模板内容 根据模板填入对应字段 为json格式
        $content = json_encode(['code' => "$num"]);
        // 模板的ID
        $code = 'SMS_61965053';
        // 调用组件发送短信
        $data = $this->sms->send("$phone", "$name", "$content", "$code");
        // 判断是否发送成功
        if (property_exists($data, 'result')) {
            // 存入redis 防止频繁发送验证码
            \Redis::sEtex(STRING_USER_VERIFY_CODE_ . $request['tel'], 600, $num);
            return responseMsg('发送成功');
        } else {
            // 获取失败原因
            $reason = array_merge($request->all(), Common::objectToArray($data));
            // 组装log日志需要的信息
            $message = Common::logMessageForOutside($request->getClientIp(), $request->url(), $reason, config('log.systemLog')[1]);
            // 写入日志并返回状态码
            $this->log->writeSystemLog($message);
            return responseMsg('发送失败', 400);
        }

    }

    /**
     * 发送有邮箱验证码
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhangyuchao
     */
    public function sendEmailCode(Request $request)
    {
        $result = $this->indexUserLogin->findOneUserManner(['login_name' => $request['email']]);
        if ($result) return responseMsg('邮箱已注册!', 400);
        // 判断邮箱是否重复发送
        $exists = \Redis::exists(STRING_USER_VERIFY_CODE_ . $request['email']);
        if (!empty($exists)) return responseMsg('重复发送', 400);
        // 生成验证码
        $num = rand(100000, 999999);
        // 调用发送邮件函数
        $emailResult = Common::sendEmail(config('email.templateName')[1], config('email.title')[1], $request['email'], ['code' => $num]);
        // 判断是否发送成功
        if (!$emailResult) {
            // 未成功 记录日志
            $message = Common::logMessageForOutside($request->getClientIp(), $request->url(), $request->all(), config('log.systemLog')[2]);
            $this->log->writeSystemLog($message);

            // 返回错误信息
            return responseMsg('发送失败', 400);
        } else {
            // 成功存入redis
            \Redis::sEtex(STRING_USER_VERIFY_CODE_ . $request['email'], 600, $num);

            return responseMsg('发送成功');
        }
    }


    /**
     * 用户注册
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhangyuchao
     */
    public function createUser(Request $request)
    {
        // 密码处理
        $password = trim($request['password']);
        if ($password != $request['rel_password']) return responseMsg('两次密码输入不一致', 400);
        // 验证码处理
        if ($request['registerType'] == 1) {
            $code = \Redis::get(STRING_USER_VERIFY_CODE_ . $request['tel']);
            $request['login_name'] = $request['tel'] = trim($request['tel']);
        } else {
            $code = \Redis::get(STRING_USER_VERIFY_CODE_ . $request['email']);
            $request['login_name'] = $request['email'] = trim($request['email']);
        }
        // 验证码失败判断
        if (empty($code)) return responseMsg('验证码已失效', 400);
        // 验证码是否正确判断
        if ($code != $request['code']) return responseMsg('验证码错误', 400);
        // 密码加密
        $request['password'] = bcrypt($password);
        // 记录IP  登录日志表的登录IP   登录索引表的最后一次登录IP     户注册原始表的注册IP
        $request['login_ip'] = $request['last_login_ip'] = $request['register_ip'] = $request->getClientIp();
        // 初始化昵称
        $request['nickname'] = 'nickname';
        try {
            // 开始事物
            \DB::beginTransaction();
            // 向用户注册原始表 添加一条数据
            $registerResult = $this->register->createOneUser($request->all());
            // 添加失败抛出异常信息
            if (empty($registerResult)) throw new Exception(config('log.systemLog')[3]);
            // 用户注册原始表的ID是用户基本表、用户登录索引表的user_id
            $request['user_id'] = $registerResult->id;
            // 向用户基本表添加一条数据
            $userInfoResult = $this->userInfo->createUserData($request->all());
            // 添加失败抛出异常信息
            if (empty($userInfoResult)) throw new Exception(config('log.systemLog')[4]);
            // 向用户登录索引表添加一条数据
            $indexUserResult = $this->indexUserLogin->createOneUserManner($request->all());
            // 添加失败抛出异常信息
            if (empty($indexUserResult)) throw new Exception(config('log.systemLog')[5]);
            // 全部正确 事物提交
            \DB::commit();
            // 记录登录类型
            $request['third_party'] = 1;
            // 记录用户登录日志
            $logUserLoginResult = $this->logUserLogin->addOneUserLoginData($request->all());
            if (empty($logUserLoginResult)) {
                // 拼装系统日志信息
                $message = Common::logMessageForOutside($request['login_ip'], $request->url(), $request->all(), config('log.systemLog')[6]);
                // 写入系统日志
                $this->log->writeSystemLog($message);
            }

            // 返回注册成功提示
            return responseMsg('注册成功', 200);
        } catch (Exception $e) {
            // 错误一个 事物回滚
            \DB::rollBack();
            // 组装填写log日志
            $message = Common::logMessageForOutside($request['register_ip'], $request->url(), $request->all(), $e->getMessage());
            // 写入log日志
            $this->log->writeSystemLog($message);

            return responseMsg('注册失败', 400);
        }


    }

    /**
     * 用户登录
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function login()
    {
        return view('home.login');
    }

}
