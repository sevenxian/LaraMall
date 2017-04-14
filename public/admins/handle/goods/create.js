
new Vue({
    el: ".wrapper",
    data(){
      return {
          categorys: [],
      }
    },
    mounted(){
        // 获取一级分类
        this.getCategory({level: 1});
    },
    methods: {
        // 添加商品
        addGoods(e){
            var fd = new FormData(e.target);
            axios.post('/admin/goods', fd).then(response => {
                console.log(response);
            });
        },
        // 获取某一等级下的分类
        getCategory(param){
            axios.post('/admin/getCategory', param).then(response => {
                this.categorys = response.data.ResultData;
            }).catch(error => {

            });
        },
        selected(e){
            this.getCategory({pid: e.target.value});
        }
    }
});