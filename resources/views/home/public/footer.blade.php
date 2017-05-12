<div class="footer">
    <div class="footer-hd">
        @inject('Links','App\Presenters\HomeLinksPresenter')
        @foreach( $Links -> getLinks() as $link)
            {{--显示友情链接名称--}}
            {{--<a href="{{$link->url}}" target="_blank"><font size="4" color="#a52a2a">{{ $link->name }}</font></a>--}}
            {{--显示友情链接图片--}}
            @if (($link->type) == 1)
                <a href="{{$link->url}}" target="_blank"><img src="{{ env("QINIU_DOMAIN") }}{{ $link->image }}" style="width:45px" height="35px"></a>
            @else
                <a href="{{$link->url}}" target="_blank"><font size="4" color="red">{{ $link->name }}</font></a>
            @endif
            <b>|</b>
        @endforeach
        <hr style="height:1px;border:none;border-top:1px solid ;" />
    </div>
    <div class="footer-bd">
        <p>
            <a href="#">关于恒望</a>
            <a href="#">合作伙伴</a>
            <a href="#">联系我们</a>
            <a href="#">网站地图</a>
            <em>© 2015-2025 Hengwang.com 版权所有</em>
        </p>
    </div>
</div>


