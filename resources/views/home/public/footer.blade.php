<div class="footer">
    <div class="footer-hd">
        <p style="text-align:center">
            <a href="#">恒望科技</a>
            <b>|</b>
            <a href="#">商城首页</a>
            <b>|</b>
            <a href="#">支付宝</a>
            <b>|</b>
            <a href="#">物流</a>
        </p>
    </div>
    <div class="footer-bd">
        @inject('BasicConfig', 'App\Presenters\BasicConfigPresenter')
        <p style="text-align:center">
            <a href="#">关于恒望</a>
            <a href="#">合作伙伴</a>
            <a href="#">联系我们</a>
            <a href="#">网站地图</a>
            <em>@if(empty($BasicConfig->getBasicConfig()->copyright))版权所有 @else {{$BasicConfig->getBasicConfig()->copyright}} @endif</em>
        </p>
    </div>
</div>