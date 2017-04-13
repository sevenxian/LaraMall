new Vue({
    el: ".wrapper",
    data(){
      return {
          message: ''
      }
    },
    mounted(){
        axios.get('/admin/goodsList').then(response=>{
            this.message = response.data;
        }).catch(error=>{
            console.log(error);
        });
    }
});