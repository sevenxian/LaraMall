<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * 商城首页
 */
Route::get('/', function () {
    return redirect('home/index');
});

/**
 * 公共路由
 * 路由前缀 common
 * 目录 Common
 */
Route::group(['prefix' => 'common', 'namespace' => 'Common'], function () {
    // ...
});

/**
 * 前台
 * 路由前缀 home
 * 目录 Home
 */
Route::group(['prefix' => 'home', 'namespace' => 'Home'], function () {
    // 商城首页
    Route::get('index', 'IndexController@index')->name('home.index');
    // 用户注册
    Route::get('register', 'UserController@register')->name('home.register');
    // 用户登录
    Route::get('login', 'UserController@login')->name('home.login');
    // 商品列表页
    Route::get('goodsList', 'GoodsController@goodsList')->name('home.goodsList');
    // 商品详情页
    Route::get('goodsDetail', 'GoodsController@goodsDetail')->name('home.goodsDetail');
    // 分类
    Route::get('sort', 'GoodsController@sort')->name('home.sort');
    // 购物车
    Route::get('goods/shopCart', 'GoodsController@shopCart')->name('home.goods.shopCart');
    // 个人中心
    Route::get('personal', 'PersonalController@index')->name('home.personal');
    // 个人信息
    Route::get('personal/information', 'PersonalController@information')->name('home.personal.information');
});

/**
 * 后台
 * 路由前缀 admin
 * 目录 Admin
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // 后台登录
    Route::get('login', 'UserController@login')->name('admin.login');
    // 后台用户登陆块
    Route::resource('user', 'UserController');

    // 认证后的操作路由
    Route::group(['middleware' => 'user:admin'], function () {
        // 后台用户管理块
        Route::resource('subscribers', 'SubscribersController');
        // 管理员重置密码
        Route::post('usersUpdate', 'AdminUserController@update');
        // 后台管理员列表
        Route::any('usersList', 'AdminUserController@userList');
        // 后台用户管理
        Route::resource('users', 'AdminUserController');

        // 后台首页
        Route::get('index', 'IndexController@index')->name('admin.index');
        Route::get('/', 'IndexController@index');
        // 用户退出登陆
        Route::any('logout', 'UserController@logout')->name('admin.logout');

        // 管理员重置密码
        Route::post('usersUpdate', 'AdminUserController@update');
        // 后台用户管理
        Route::resource('subscribers', 'SubscribersController');

        // 分类块
        Route::resource('classification', 'ClassificationController');
        // 修改分类内容
        Route::post('classificationUpdate/{id}', 'ClassificationController@update');
        // 分类列表
        Route::any('classificationList', 'ClassificationController@categoryList');
        // 添加子分类
        Route::post('classificationCreate', 'ClassificationController@categoryCreate');
        // 分类标签
        Route::resource('categoryLabel', 'CategoryLabelController');

        // 商品管理
        Route::resource('goods', 'GoodsController');
        // 获取商品列表数据
        Route::any('goodsList', 'GoodsController@goodsList')->name('admin.goodsList');

        // 权限块
        Route::resource('acl', 'AclController');
        // 角色列表
        Route::any('aclList', 'AclController@aclList');
        // 修改权限信息
        Route::post('aclUpdate/{id}', 'AclController@update');
        // 添加权限
        Route::get('permission', 'AclController@permissionForm')->name('permission.create');
        Route::post('permission', 'AclController@permission')->name('permission.store');
        // 更新权限
        Route::patch('syncPermission/{id}', 'AclController@syncPermissions');
    });
});
