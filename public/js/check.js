/**
 * Created by admin on 2017/3/9.
 */
/**
 * 检测验证码
 * param object obj
 * param int    length
 * return object
 */
function checkVerifyCode(obj,length){
    $(obj).blur(function(){
        if(!isNull($(this).val())) return  $('#message').html('验证码不能为空');
        if($(this).val().length < length) return  $('#message').html('验证码长度不正确');
        return $('#message').html(' ');
    })
}

/**
 * 判断密码与重复密码
 * param object obj  密码
 * param int    type 1密码 2重复密码
 * param object obj2 重复密码
 * return object
 */
function checkPassword(obj,type,obj2)
{
    $(obj).blur(function(){
        if(type==1){
            if(!isNull($(this).val())) return  $('#message').html('密码不能为空');
            if($(this).val().length < 6) return  $('#message').html('密码长度不能小于6位');
            return $('#message').html(' ');
        }else{
            if(!isNull($(this).val())) return  $('#message').html('重复密码不能为空');
            if($(this).val().length < 6) return  $('#message').html('重复密码长度不能小于6位');
            if($(this).val() != obj2.val()) return  $('#message').html('两次密码输入不一致');
            return $('#message').html(' ');
        }

    })

}
/**
 * 检测手机号函数
 * param object  obj
 * return object
 */
function checkTel(obj){

    $(obj).blur(function(){
        if(!isNull($(this).val())) return  $('#message').html('手机号码不能为空');
        if(!isTel($(this).val()))  return  $('#message').html('手机号码格式不正确');
        return $('#message').html(' ');
    })
}
/**
 * 验证字段是否为空
 * param s string
 * return bool
 */
function isNull(s){
    if(s == "" || s == undefined || s == null) return false;
    return true
}
/**
 * 验证手机号码是否符合规范
 * param tel string
 * return bool
 */
function isTel(s)
{
    var patrn = /^(13|14|15|17|18)[0-9]{9}$/;
    if (!patrn.exec(s)) return false;
    return true;
}