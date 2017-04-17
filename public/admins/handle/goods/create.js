/**
 * 商品分类 Vue
 * @author zhulinjie
 */
new Vue({
    // 绑定元素
    el: "#app",
    // 响应式参数
    data(){
        return {
            level1: '',  // 双向绑定 一级分类
            level2: '',  // 双向绑定 二级分类
            level3: '',  // 双向绑定 三级分类
            lv1s: [],    // 存储一级分类数据
            lv2s: [],    // 存储二级分类数据
            lv3s: []     // 存储三级分类数据
        }
    },
    // 第一次执行
    mounted(){
        // 第一次网页加载默认获取一级分类
        axios.post('/admin/getCategory', {level: 1}).then(response => {
            layer.closeAll();
            this.lv1s = response.data.ResultData;
        }).catch(error => {
            sweetAlert("请求失败!", "分类获取失败!", "error");
        });
    },
    // 方法定义
    methods: {
        // 获取二级分类
        lv1(){
            layer.load(2);
            axios.post('/admin/getCategory', {pid: this.level1}).then(response => {
                layer.closeAll();
                this.lv2s = response.data.ResultData;
                // 初始化二级分类和三级分类
                this.level2 = '';
                this.level3 = '';
                this.lv3s = [];
            }).catch(error => {
                layer.closeAll();
                sweetAlert("请求失败!", "分类获取失败!", "error");
            });
        },
        // 获取三级分类
        lv2(){
            if(this.level2){
                layer.load(2);
                axios.post('/admin/getCategory', {pid: this.level2}).then(response => {
                    layer.closeAll();
                    this.lv3s = response.data.ResultData;
                    // 初始化三级分类
                    this.level3 = '';
                }).catch(error => {
                    layer.closeAll();
                    sweetAlert("请求失败!", "分类获取失败!", "error");
                });
            }
        }
    }
});