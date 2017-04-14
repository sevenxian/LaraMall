
new Vue({
    el: ".wrapper",
    data(){
      return {
          categorys: []
      }
    },
    mounted(){
        // 获取一级分类
        axios.post('/admin/getCategory', {level: 1}).then(response => {
            this.categorys = response.data.ResultData;
        }).catch(error => {

        });
    },
    methods: {
        addGoods(e){
            var fd = new FormData(e.target);
            axios.post('/admin/goods', fd).then(response => {
                console.log(response);
            });
        },
        getCategory(){
            alert('1');
        }
    }
});