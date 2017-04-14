
new Vue({
    el: ".wrapper",

    methods: {
        addGoods(e){
            var fd = new FormData(e.target);
            axios.post('/admin/goods', fd).then(response => {
                console.log(response);
            });
        }
    }
});