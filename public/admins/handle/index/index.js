/**
 * 首页填充数据
 * @author zhangyuchao
 */
new Vue({
    // 绑定元素
    el: '.wrapper',
    // 响应式参数
    data() {
        return {
            datas: [], // 页码内容

        }
    },
    // 第一次执行
    mounted() {
        // 获取第一页数据
        this.fetchDatas();
    },
    // 方法定义
    methods: {
        // 获取页码数据
        fetchDatas() {
            // 请求数据
            axios.post('/admin/index/count',{'_token':token}).then(response => {
                    if(response.data.ServerNo == 200){
                        this.datas = response.data.ResultData.data;
                        layer.closeAll();
                    }
                }).catch(error => {
                    // layer 加载层关闭
                    layer.closeAll();
                    sweetAlert("请求数据失败!", "", "error");
                });

        },
    }
});