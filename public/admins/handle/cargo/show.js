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
            categoryLabels: [],      // 分类标签
            goodsLabels: [],         // 商品标签
        }
    },
    // 第一次执行
    mounted(){
        // 获取货品相关数据
        axios.post('/admin/cargo/detail', {goods_id: goods_id}).then(response => {
            // 获取数据失败的情况
            if(response.data.ServerNo != 200){
                sweetAlert("请求失败!", response.request.statusText, "error");
                return;
            }
            // 一级分类
            this.lv1s = response.data.ResultData.lv1s;
            // 二级分类
            this.lv2s = response.data.ResultData.lv2s;
            // 三级分类
            this.lv3s = response.data.ResultData.lv3s;
            // 商品信息
            this.goods = response.data.ResultData.goods;
            // 分类标签
            this.categoryLabels = response.data.ResultData.lv3s.labels;
            // 商品标签
            this.goodsLabels = response.data.ResultData.goodsLabels;
        }).catch(error => {
            sweetAlert("请求失败!", response.request.statusText, "error");
        });
    },
    // 方法定义
    methods: {
        // 选择分类标签值
        selectLabel(e){
            e.preventDefault();
            // 样式切换
            if(!$(e.target).hasClass('r_on')){
                // 取消选中其它的单选按钮
                $(e.target).parents('.form-group').find('.label_radio').removeClass('r_on');
                $(e.target).parents('.form-group').find('.label_radio').find('input').attr('checked', false);
                // 选中当前的单选按钮
                $(e.target).addClass('r_on');
                $(e.target).find('input').attr('checked', true);
            }
        },
        // 添加分类标签值
        addCategoryAttr(e){
            // 获取分类标签值
            var attribute_name = $.trim($(e.target).parents('.add').find('input[type=text]').val());
            var category_label_id = $(e.target).data('category_label_id');

            // 分类标签值不能为空
            if(!attribute_name){
                sweetAlert("操作失败!", "请先填写分类标签值!", "error");
            }

            // 分类标签值添加请求
            axios.post('/admin/addCategoryAttr', {category_label_id: category_label_id, attribute_name: attribute_name}).then(response => {
                if(response.data.ServerNo != 200){
                    sweetAlert("操作失败!", response.data.ResultData, "error");
                    return;
                }
                // 接收返回数据
                var data = response.data.ResultData;
                // 获取标签索引
                var index = $(e.target).data('index');
                // 前端实时添加
                this.categoryLabels[index].labels.push(data);
                sweetAlert("操作成功!", '分类标签值添加成功', "success");
            // 请求失败的情况
            }).catch(error => {
                sweetAlert("操作失败!", response.request.statusText, "error");
            });
        },
        // 添加商品标签值
        addGoodsAttr(e){
            // 获取分类标签值
            var goods_label_name = $.trim($(e.target).parents('.add').find('input[type=text]').val());
            var goods_label_id = $(e.target).data('goods_label_id');

            // 商品标签值不能为空
            if(!goods_label_name){
                sweetAlert("操作失败!", "请先填写商品标签值!", "error");
            }

            // 商品标签值添加请求
            axios.post('/admin/addGoodsAttr', {goods_label_id: goods_label_id, goods_label_name: goods_label_name}).then(response => {
                if(response.data.ServerNo != 200){
                    sweetAlert("操作失败!", response.data.ResultData, "error");
                    return;
                }
                // 接收返回数据
                var data = response.data.ResultData;
                // 获取标签索引
                var index = $(e.target).data('index');
                // 前端实时添加
                this.goodsLabels[index].labels.push(data);
                sweetAlert("操作成功!", '商品标签值添加成功', "success");
                // 请求失败的情况
            }).catch(error => {
                sweetAlert("操作失败!", response.request.statusText, "error");
            });
        }
    }
});