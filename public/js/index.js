// JavaScript Document

$(function(){
    <!--轮播-->
    (function() {
        $('.am-slider').flexslider();
    });
    $(document).ready(function() {
        $("li").hover(function() {
            $(".category-content .category-list li.first .menu-in").css("display", "none");
            $(".category-content .category-list li.first").removeClass("hover");
            $(this).addClass("hover");
            $(this).children("div.menu-in").css("display", "block")
        }, function() {
            $(this).removeClass("hover")
            $(this).children("div.menu-in").css("display", "none")
        });
    });

    if ($(window).width() < 640) {
        function autoScroll(obj) {
            $(obj).find("ul").animate({
                marginTop: "-39px"
            }, 500, function() {
                $(this).css({
                    marginTop: "0px"
                }).find("li:first").appendTo(this);
            })
        }
        $(function() {
            setInterval('autoScroll(".demo")', 3000);
        })
    }
});