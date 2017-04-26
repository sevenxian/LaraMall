/**
 * 分页获取友情链接
 * @author wutao
 */
var linkListVue = new Vue({
    // 绑定元素
    el: '#main-content',
    // 响应式参数
    data() {
        return {
            pagination: {
                total: 0, // 总条数
                from: 1, // 当前页码第一个栏数据是数据库第几条
                to: 0, // 当前页码最后一栏数据是数据库第几条
                current_page: 1 // 当前页
            },
            adminId: '',
            offset: 4, // 页码偏移量
            datas: [], // 页码内容
            search: {'value': ''}, // 搜索条件
            per_page: 5, // 一页显示的数据
            link: '',
            type: 1,
            insert: {
                'id':'',
                'name':'',
                'image':'',
                'url':''
            },
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
        }

    },
    // 删除方法定义
    methods: {
        // 获取页码数据
        fetchDatas(page) {
            // 请求数据
            var data = {
                page: page, // 当前页
                where: this.search, // 搜索条件
                perPage: this.per_page, // 页面展示的数据
            };
            // 请求数据
            axios.post('/admin/linkList', data).then(response => {
                if(response.data.ServerNo == 200){
                    this.datas = response.data.ResultData.data;
                    this.pagination = response.data.ResultData;
                    layer.closeAll();
                }
            }).catch(error => {
                // layer 加载层关闭
                layer.closeAll();
                sweetAlert("请求数据失败!", "", "error");
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
        // 搜索
        searchLists() {
            this.fetchDatas(this.pagination.current_page);
        },
        // 获取友情链接ID
        getAdminId(id,data) {
            this.adminId = id;
           this.link = data;
        },
        // 删除友情链接操作
        deleteAdmin(id,index) {
            axios.post('/admin/friendLink/'+id,{'_method':'delete'}).then(response => {
                if(response.data.ServerNo == 200){
                    // 删除成功 页面数据移除
                    this.datas.splice(index,1)
                    layer.closeAll();
                    sweetAlert("删除成功!", "", "success");
                }else{
                    layer.closeAll();
                    sweetAlert("删除失败!", "", "success");
                }
            }).catch(error => {
                // layer 加载层关闭
                layer.closeAll();
                sweetAlert("请求数据失败!", "", "error");
            });
        },
        //添加定义方法
        sub() {
            // FormData支援把 Form 元素丟進去
            var formData = new FormData(event.target);
            // 发送参数
            axios.post('/admin/friendLink', formData).then(response => {
                // 判断返回结果
                if(response.data.ServerNo == 200){
                    console.log(response.data);
                    // 信息提示
                    layer.closeAll();
                    sweetAlert('添加完成','', "success");
                }else{
                    // 添加失败信息提示
                    layer.closeAll();
                    sweetAlert('添加失败',response.data.ResultData, "error");
                }
            }).catch(error => {
                // 请求失败
                layer.closeAll();
                sweetAlert("网络请求失败!", '', "error");
            });
        },
        //修改定义方法
        linkUpdate(event) {
            // 获取友情链接ID
            this.insert.id = this.adminId;
            var formData = new FormData($(event.target).parents('form')[0]);
            formData.append('id',this.insert.id);
            // 发送参数
            axios.post('/admin/linkUpdate', formData).then(response => {
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
    },

});