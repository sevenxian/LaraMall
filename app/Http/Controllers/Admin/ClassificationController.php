<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ClassificationController
 * @package App\Http\Controllers\Admin
 */
class ClassificationController extends Controller
{

    /**
     * 文件操作
     *
     * @var \Storage
     */
    protected $disk;

    /**
     * @var CategoryRepository
     */
    protected $category;

    /**
     * 服务注入
     *
     * ClassificationController constructor.
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        // 注入七牛服务
        $this->disk = \Storage::disk('qiniu');
        // 注入分类操作类
        $this->category = $categoryRepository;
    }

    /**
     * 分类列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Luoyan
     */
    public function index()
    {
        // 返回分类列表视图
        return view('admin.classification.index');
    }

    /**
     * 添加分类视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Luoyan
     */
    public function create()
    {
        // 返回创建分类视图
        return view('admin.classification.insert');
    }


    /**
     * 分类信息录入
     *
     * @param Request $request
     * @return $this
     * @author: Luoyan
     */
    public function store(Request $request)
    {
        // 判断是否有图标上传，并且检查图片是否合法
        if ($request->hasFile('image') && checkImage($file = $request->file('image'))) {
            // 上传七牛文件云存储后返回图片名字
            $imageName = $this->disk->put(IMAGE_PATH, $file);
            // 将图片名字塞入请求之中
            $request->merge(['img' => $imageName]);
        }

        // 录入分类信息，并且判断录入结果
        if ($this->category->createByCategory($request->all())) {
            // 录入成功跳转分类列表
            return redirect()->route('classification.index');
        }

        // 录入失败返回上一页，并且附带提交表单值
        return back()->withInput();
    }

    /**
     * 分类列表
     *
     * @param Request $request
     * @return mixed
     * @author: Luoyan
     */
    public function categoryList(Request $request)
    {
        // 获取分页或搜索后的数据
        return $this->category->categoryPaginate($request->get('perPage'), $request->get('where'));
    }
}
