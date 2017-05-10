<aside class="menu">
    <ul>
        <li class="person active">
            <a href="{{ url('/home/personal') }}">个人中心</a>
        </li>
        <li class="person">
            <a href="javascript:;">个人资料</a>
            <ul>
                <li><a href="{{ url('/home/userInfo/information') }}">个人信息</a></li>
                <li><a href="{{ route('home.safety.index') }}">安全设置</a></li>
            </ul>
        </li>
        <li class="person">
            <a href="javascript:;">地址管理</a>
            <ul>
                <li><a href="{{ url('/home/address') }}">收货地址</a></li>
                <li><a href="{{ url('/home/address/create') }}">新增地址</a></li>
            </ul>
        <li class="person">
            <a href="javascript:;">我的交易</a>
            <ul>
                <li><a href="{{ url('/home/orders') }}/0">订单管理</a></li>
            </ul>
        </li>
        <li class="person">
            <a href="javascript:;">我的小窝</a>
            <ul>
                <li><a href="{{ url('/home/GoodsCollection') }}">商品收藏</a></li>
                <li><a href="{{ url('/home/comments') }}">商品评价</a></li>
            </ul>
        </li>
    </ul>

</aside>