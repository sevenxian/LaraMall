/**
 * 验证邮箱
 */
$('#email').blur(function () {
    checkEmail($(this), $('#emailErrorMessage'))
})
/**
 * 验证邮箱验证码
 */
$('#emailCode').blur(function () {
    checkVerifyCode($(this), $('#emailCodeErrorMessage'), 6);
});
/**
 * 验证密码
 */
$('#emailPwd').blur(function () {
    checkPassword($(this), $('#emailPwdErrorMessage'), 6);
})
/**
 * 验证重复密码
 */
$('#relEmailPwd').blur(function () {
    checkRelPassword($('#emailPwd'), $(this), $('#relEmailPwdErrorMessage'), 6);
})
/**
 * 发送邮箱验证码
 */
function sendEmailCode() {
    var result = checkEmail($('#email'), $('#emailErrorMessage'))
    if (result != 100) {
        return false;
    }
    sendAjax({
        'email': $('#email').val(),
        '_token': $('#token').val()
    }, emailVerifyCodeUrl, function (response) {
        if (response.ServerNo == 200) {
            $('#message').html('验证码已发送');
        } else {
            $('#message').html(response.ResultData);
        }
    })
}
/**
 * 点击注册
 */
function submitParamForEmail() {

    if ($('.emailAgree').prop('checked') != true) {
        $('#message').html('请先勾选协议')
        return false;
    }
    $('#message').html('')
    // 判断
    var telResult = checkEmail($('#email'), $('#emailErrorMessage'))
    var codeResult = checkVerifyCode($('#emailCode'), $('#emailCodeErrorMessage'), 6);
    var pwdResult = checkPassword($('#emailPwd'), $('#emailPwdErrorMessage'), 6);
    var pwdRelResult = checkRelPassword($('#emailPwd'), $('#relEmailPwd'), $('#relEmailPwdErrorMessage'), 6);
    if (telResult != 100 && codeResult != 100 && pwdResult != 100 && pwdRelResult != 100) {
        return false;
    }
    var data;
    data = {
        'email': $('#email').val(),
        'code': $('#emailCode').val(),
        'registerType': 2,
        'password': $('#emailPwd').val(),
        'rel_password': $('#relEmailPwd').val(),
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