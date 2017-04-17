/**
 * Created by zhangyuchao on 17/4/16.
 * @author zhangyuchao
 */
/**
 * 判断手机号码格式
 */
$('#phone').blur(function () {
    checkTel($(this), $('#telErrorMessage'));
});
/**
 * 检测验证码位数
 */
$('#telCode').blur(function () {
    checkVerifyCode($(this), $('#telCodeErrorMessage'), 6);
});

/**
 * 验证密码
 */
$('#telPwd').blur(function () {
    checkPassword($(this), $('#telPwdErrorMessage'), 6);
})
/**
 * 验证确认密码
 */
$('#relTelPwd').blur(function () {
    checkRelPassword($('#telPwd'), $(this), $('#relTelRelPwdErrorMessage'), 6);
})

/**
 * 发送手机验证码
 * @author zhangyuchao
 */
function sendMobileCode() {
    var result = checkTel($('#phone'), $('#telErrorMessage'))
    if (result != 100) {
        return false;
    }
    sendAjax({
        'tel': $('#phone').val(),
        '_token': $('#token').val()
    }, telVerifyCodeUrl, function (response) {
        if (response.ServerNo == 200) {
            $('#message').html('验证码已发送');
        } else {
            $('#message').html(response.ResultData);
        }
    })
}
/**
 * 使用手机号码注册
 */
function submitParamForTel() {
    if ($('.telAgree').prop('checked') != true) {
        $('#message').html('请先勾选协议')
        return false;
    }
    $('#message').html('')
    // 判断
    var telResult = checkTel($('#phone'), $('#telErrorMessage'))
    var codeResult = checkVerifyCode($('#telCode'), $('#telCodeErrorMessage'), 6);
    var pwdResult = checkPassword($('#telPwd'), $('#telPwdErrorMessage'), 6);
    var pwdRelResult = checkRelPassword($('#telPwd'), $('#relTelPwd'), $('#relTelRelPwdErrorMessage'), 6);
    if (telResult != 100 && codeResult != 100 && pwdResult != 100 && pwdRelResult != 100) {
        return false;
    }
    var data;
    data = {
        'tel': $('#phone').val(),
        'code': $('#telCode').val(),
        'registerType': 1,
        'password': $('#telPwd').val(),
        'rel_password': $('#relTelPwd').val(),
        '_token': $('#token').val(),
    }

    sendAjax(data, registerUrl, function (response) {
        if (response.ServerNo == 200) {
            window.location.href = '';
        } else {
            $('#message').html(response.ResultData);
        }
    })

}