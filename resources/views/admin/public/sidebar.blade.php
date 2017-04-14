<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            <li class="active">
                <a class="" href="index.html">
                    <i class="icon-dashboard"></i>
                    <span>首页</span>
                </a>
            </li>
            @inject('aside', 'App\Presenters\AsidePresenter')

            <li class="sub-menu {{ $aside->openTag(['admin/users']) }}">
                <a href="javascript:;" class="">
                    <i class="icon-book"></i>
                    <span>用户管理</span>
                    <span class="arrow {{ $aside->openTag(['admin/users','admin/subscribers']) }}"></span>
                </a>
                <ul class="sub" {{ $aside->displayBlock(['admin/users','admin/subscribers']) }}>
                    <li><a class="" href="{{ url('admin/subscribers') }}">前台用户</a></li>
                    <li><a class="" href="{{ url('admin/users') }}">后台用户</a></li>
                </ul>
            </li>
            <li class="sub-menu {{ $aside->openTag(['admin/classification', 'admin/classification/create']) }}">
                <a href="javascript:;" class="">
                    <i class="icon-th"></i>
                    <span>分类管理</span>
                    <span class="arrow {{ $aside->openTag(['admin/classification', 'admin/classification/create']) }}"></span>
                </a>
                <ul class="sub" {{ $aside->displayBlock(['admin/classification', 'admin/classification/create']) }}>
                    <li><a class="icon-align-center" href="{{ route('classification.index') }}"> 分类列表</a></li>
                    <li><a class=" icon-indent-left" href="{{ route('classification.create') }}"> 添加分类</a></li>
                </ul>
            </li>

            <li class="sub-menu {{ $aside->openTag(['admin/categoryLabel']) }}">
                <a href="javascript:;" class="">
                    <i class="icon-th"></i>
                    <span>标签管理</span>
                    <span class="arrow {{ $aside->openTag(['admin/categoryLabel']) }}"></span>
                </a>
                <ul class="sub" {{ $aside->displayBlock(['admin/categoryLabel']) }}>
                    <li><a class="icon-align-center" href="{{ route('categoryLabel.index') }}"> 分类标签列表</a></li>
                    <li><a class=" icon-indent-left" href=""> 添加分类</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-glass"></i>
                    <span>商品管理</span>
                    <span class="arrow {{ $aside->openTag(['admin/goods', 'admin/goods/create']) }}"></span>
                </a>
                <ul class="sub" {{ $aside->displayBlock(['admin/goods', 'admin/goods/create']) }}>
                    <li><a href="/admin/goods">商品列表</a></li>
                    <li><a href="/admin/goods/create">添加商品</a></li>
                    <li><a href="invoice.html">Invoice</a></li>
                    <li><a href="404.html">404 Error</a></li>
                    <li><a href="500.html">500 Error</a></li>
                </ul>
            </li>
            <li>
                <a class="" href="login.html">
                    <i class="icon-user"></i>
                    <span>订单管理</span>
                </a>
            </li>
            <li>
                <a class="" href="login.html">
                    <i class="icon-user"></i>
                    <span>评论管理</span>
                </a>
            </li>
            <li>
                <a class="" href="login.html">
                    <i class="icon-user"></i>
                    <span>网站配置</span>
                    <ul class="sub">
                        <li><a class="" href="dynamic_table.html">基本配置</a></li>
                        <li><a class="" href="dynamic_table.html">网站组件</a></li>
                        <li><a class="" href="basic_table.html">友情链接</a></li>
                    </ul>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-th"></i>
                    <span>权限管理</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li>
                <a class="" href="login.html">
                    <i class="icon-user"></i>
                    <span>售后管理</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-glass"></i>
                    <span>操作日志</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="blank.html">用户登录日志</a></li>
                    <li><a class="" href="profile.html">用户操作日志</a></li>
                    <li><a class="" href="profile.html">管理员操作日志</a></li>
                </ul>
            </li>
            <li>
                <a class="" href="login.html">
                    <i class="icon-user"></i>
                    <span>缓存管理</span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>