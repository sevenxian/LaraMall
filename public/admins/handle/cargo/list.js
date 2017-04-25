/**
 * 货品列表
 * @author zhulinjie
 */
new Vue({
    el: ".wrapper",
    data(){
        return {
            pagination: {
                total: 0,                   // 总条数
                from: 1,                    // 当前页码第一个栏数据是数据库第几条
                to: 0,                      // 当前页码最后一栏数据是数据库第几条
                current_page: 1             // 当前页
            },
            offset: 4,                      // 页码偏移量
            cargo: [],                      // 货品列表
            per_page: 10,                   // 一页显示多少条的数据
            recommends: [],                 // 存储所有的推荐位
            recommendIds: [],               // 存储一个货品对应的推荐位的所有ID
            cargo_id: '',                   // 货品ID
        }
    },
    // 第一次执行
    mounted() {
        // 获取第一页数据
        this.fetchDatas(this.pagination.current_page);
    },
    // 计算属性
    computed: {
        // 选中页
        isActived() {
            return this.pagination.current_page;
        },
        // 页码
        pagesNumber() {
            // 无数据返回空
            if (!this.pagination.to) return [];
            // 获取第一个页码
            var from = this.pagination.current_page - this.offset;
            if (from < 1) from = 1;
            // 最后一个页码
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) to = this.pagination.last_page;
            // 所有页码
            var pages = [];
            for (; from <= to; from++) {
                pages.push(from);
            }
            return pages;
        },
        // 上一页省略号
        preOmit() {
            return (this.pagination.current_page - 1) > this.offset;
        },
        // 下一页省略号
        nextOmit() {
            return (this.pagination.last_page - this.pagination.current_page) > this.offset;
        },
        // 判断是存在数据
        isData(){
            return this.cargo.length;
        }
    },
    methods: {
        // 获取页码数据
        fetchDatas(page) {
            // 请求数据
            var data = {
                page: page,                 // 当前页
                perPage: this.per_page,     // 一页显示多少条的数据
                goods_id: goods_id          // 商品ID
            };
            // 请求数据
            axios.post('/admin/getCargoList', data).then(response => {
                console.log(response);
                // layer 加载层关闭
                layer.closeAll();
                // 判断请求结果
                if(response.data.ServerNo != 200){
                    sweetAlert("请求失败!", response.data.ResultData, "error");
                }
                // 响应式更新数据
                this.cargo = response.data.ResultData.data;
                this.pagination = response.data.ResultData;
            }).catch(error => {
                // layer 加载层关闭
                layer.closeAll();
                sweetAlert("请求失败!", response.request.statusText, "error");
            });
        },
        // 改变页码
        changePage(page) {
            // 防止重复点击当前页
            if (page == this.pagination.current_page) return;
            // layer 加载层
            layer.load(2);
            // 修正当前页
            this.pagination.current_page = page;
            // 执行修改
            this.fetchDatas(page);
        },
        // 选择推荐位界面，获取相关数据
        getRecommend(e){
            this.cargo_id = $(e.target).data('cid');
            axios.post('/admin/getRecommend', {cargo_id: this.cargo_id}).then(response => {
                console.log(response);
                // 判断请求结果
                if(response.data.ServerNo != 200){
                    sweetAlert("请求失败!", response.data.ResultData, "error");
                }
                this.recommends = response.data.ResultData.recommends;
                this.recommendIds = response.data.ResultData.recommendIds;
            }).catch(error => {
                sweetAlert("请求失败!", response.request.statusText, "error");
            });
        },
        // 选择推荐位操作
        selectRecommend(e){
            // 构造一个包含Form表单数据的FormData对象，需要在创建FormData对象时指定表单的元素
            var fd = new FormData($('#recommend')[0]);
            fd.append('cargo_id', this.cargo_id);

            axios.post('/admin/selectRecommend', fd).then(response => {
                if(response.data.ServerNo != 200){
                    sweetAlert("操作失败!", response.request.ResultData, "error");
                }
                sweetAlert("操作成功!", response.request.ResultData, "success");
                setTimeout(function () {
                    // location.href = '/admin/cargoList/'+goods_id;
                }, 500);
            }).catch(error => {
                sweetAlert("请求失败!", response.request.ResultData, "error");
            });
        },
        // 判断数组中是否存在某个值
        inArray(recommendId){
            for(var i in this.recommendIds){
                if(this.recommendIds[i] == recommendId){
                    return true;
                }
            }
            return false;
        }
    }
});