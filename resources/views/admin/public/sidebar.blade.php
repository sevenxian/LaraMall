<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            <li class="active">
                <a class="" href="index.html">
                    <i class="icon-dashboard"></i>
                    <span>控制面板</span>
                </a>
            </li>
            @inject('aside', 'App\Presenters\AsidePresenter')

            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-book"></i>
                    <span>UI Elements</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="general.html">General</a></li>
                    <li><a class="" href="buttons.html">Buttons</a></li>
                    <li><a class="" href="widget.html">Widget</a></li>
                    <li><a class="" href="slider.html">Slider</a></li>
                    <li><a class="" href="font_awesome.html">Font Awesome</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-cogs"></i>
                    <span>Components</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="grids.html">Grids</a></li>
                    <li><a class="" href="calendar.html">Calendar</a></li>
                    <li><a class="" href="charts.html">Charts</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-tasks"></i>
                    <span>Form Stuff</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="form_component.html">Form Components</a></li>
                    <li><a class="" href="form_wizard.html">Form Wizard</a></li>
                    <li><a class="" href="form_validation.html">Form Validation</a></li>
                </ul>
            </li>
            <li class="sub-menu {{ $aside->openTag(['admin/classification', 'classification/create']) }}">
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
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-glass"></i>
                    <span>商品管理</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a href="/admin/goods">商品列表</a></li>
                    <li><a href="/admin/goods/create">添加商品</a></li>
                    <li><a href="invoice.html">Invoice</a></li>
                    <li><a href="404.html">404 Error</a></li>
                    <li><a href="500.html">500 Error</a></li>
                </ul>
            </li>
            <li>
                <a class="" href="inbox.html">
                    <i class="icon-envelope"></i>
                    <span>Mail </span>
                    <span class="label label-danger pull-right mail-info">2</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-glass"></i>
                    <span>Extra</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="blank.html">Blank Page</a></li>
                    <li><a class="" href="profile.html">Profile</a></li>
                    <li><a class="" href="invoice.html">Invoice</a></li>
                    <li><a class="" href="404.html">404 Error</a></li>
                    <li><a class="" href="500.html">500 Error</a></li>
                </ul>
            </li>
            <li>
                <a class="" href="login.html">
                    <i class="icon-user"></i>
                    <span>Login Page</span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>