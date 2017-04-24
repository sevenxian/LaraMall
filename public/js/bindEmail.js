/**
 * 初次绑定邮箱
 */
$('#sendEmail').click(function(){
    // 检测邮箱
    if(checkEmail($('#user-new-email'),$('#errorMessage')) != 100 ){
        return false;
    }
    // 组装参数
    var data = {
        'email':$('#user-new-email').val(),
        '_token': $('#token').val(),
    }
    // 请求发送邮件路由
    sendAjax(data, '/home/safety/bingEmail', function (response) {
        if (response.ServerNo != 200) {
            $('#errorMessage').html(response.ResultData);
        } else {
            $('#errorMessage').html(response.ResultData);
        }
    })
})