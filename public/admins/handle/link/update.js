/**
 * 修改管理员信息
 * @author wutao
 */
new Vue({
    // 绑定元素
    el: '.updateAdminLink',
    data() {
        return {
            data:{
                'id':'',
                'name':'',
                'image':'',
                'url':''
            },
    },
    // 方法定义
    methods: {
        linkUpdate() {
            // 获取友情链接ID
            this.data.id = linkListVue.adminId;
            // 发送参数
            axios.post('/admin/linkUpdate', this.data).then(response => {
                // 判断返回结果
                if(response.data.ServerNo == 200){
                // 信息提示
                layer.closeAll();
                sweetAlert('修改成功','', "success");
            }else{
                // 添加失败信息提示
                layer.closeAll();
                sweetAlert('修改失败',response.data.ResultData, "error");
            }
        }).catch(error => {
                // 请求失败
                layer.closeAll();
            sweetAlert("网络请求失败!", '', "error");
        });
        }
    }
});