/**
 * 添加货品 Vue
 * @author zhulinjie
 */
new Vue({
    // 绑定元素
    el: "#main-content",
    // 响应式参数
    data(){
        return {
            lv1s: {},                // 一级分类
            lv2s: {},                // 二级分类
            lv3s: {},                // 三级分类
            goods: {},               // 商品信息
            categoryLabels: []
        }
    },
    // 第一次执行
    mounted(){
        // 获取货品相关数据
        axios.post('/admin/cargo/detail', {goods_id: goods_id}).then(response => {
            if(response.data.ServerNo != 200){
                sweetAlert("请求失败!", response.request.statusText, "error");
                return;
            }
            this.lv1s = response.data.ResultData.lv1s;
            this.lv2s = response.data.ResultData.lv2s;
            this.lv3s = response.data.ResultData.lv3s;
            this.goods = response.data.ResultData.goods;
            this.categoryLabels = response.data.ResultData.lv3s.labels;
        }).catch(error => {
            sweetAlert("请求失败!", response.request.statusText, "error");
        });
    }
});