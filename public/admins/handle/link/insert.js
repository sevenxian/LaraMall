// /**
//  * 获取图标编码
//  * @author wutao
//  */
// function getObjectURL(file) {
//     var url = null;
//     if (window.createObjectURL != undefined) {
//         url = window.createObjectURL(file);
//     } else if (window.URL != undefined) {
//         url = window.URL.createObjectURL(file);
//     } else if (window.webkitURL != undefined) {
//         url = window.webkitURL.createObjectURL(file);
//     }
//     return url;
// }
//
// /**
//  * 立即显示图标
//  * @author wutao
//  */
// $('#image').on('change', function () {
//     // 获取控件中得文件
//     var files = $(this).prop('files')[0];
//     // 获取当前 id
//     var id = $(this).prop('id');
//     // 获取图标编码
//     var url = getObjectURL(files);
//     // 立即显示图片
//     $('#' + id + '_image').attr({'src': url});
// });

// 头像上传
// $('#img').on('change', function () {
//     // 获取控件中得文件
//     var obj = this;
//     var formData = new FormData();
//     formData.append('photo', this.files[0]);
//     formData.append('_token',$('#token').val());
//     $.ajax({
//         url: '/home/userInfo/uploadAvatar',
//         type: 'post',
//         data: formData,
//         // 因为data值是FormData对象，不需要对数据做处理
//         processData: false,
//         contentType: false,
//         success: function(data){
//             if(data.ServerNo==200){
//                 // 成功
//                 $('#images').attr('src', imgUrl+data.ResultData);
//             }
//         }
//     });
//
// });

$('#image').on('change',function(){
    //获取控件中的文件
    var obj =this;
    var formData = new FormData();
    formData.append('image',this.files[0]);
    formData.append('_token',$('#token').val());
    $.ajax({
        url: '/admin/FriendLink/fileDo',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.ServerNo == 200) {
                //成功
                $('#images').attr('src', imgUrl + data.ResultData);
            }
        }
    });
});