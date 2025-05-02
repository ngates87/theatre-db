/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//var uvOptions = {};
//(function() {
//    var uv = document.createElement('script');
//    uv.type = 'text/javascript';
//    uv.async = true;
//    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/djRvYelDQFGgGMTTFc31w.js';
//    var s = document.getElementsByTagName('script')[0];
//    s.parentNode.insertBefore(uv, s);
//})();

var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-25056867-1']);
_gaq.push(['_setDomainName', '.marshallareastagecompany.org']);
_gaq.push(['_trackPageview']);

(function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
})();

function nav()
{
    $('nav ul li').mouseover(function() {
        $(this).find('ul:first').show();
    });

    $('nav ul li').mouseleave(function() {
        $('nav ul li ul').hide();
    });

    $('nav ul li ul').mouseleave(function() {
        $('nav ul li ul').hide();
    });
}

$(document).ready(function()
{
    //nav();
    $("button, a.button").button();
    $("#loading-screen").fadeOut('slow');
//    $("#donateButton").click(function()
//    {
//        $("#donateWidget").slideToggle();
//        return false;
//    });
//    
////    snowStorm.snowColor = '#ffffff'; // blue-ish snow!?
////    snowStorm.flakesMaxActive = 96;  // show more snow on screen at once
////    snowStorm.useTwinkleEffect = false; // let the snow flicker in and out of view
//
//    $('#sdt_menu > li').bind('mouseenter',function(){
//        var $elem = $(this);
//        $elem.find('img')
//        .stop(true)
//        .animate({
//            'width':'150px',
//            'height':'170px',
//            'left':'0px'
//        },400,'easeOutBack')
//        .andSelf()
//        .find('.sdt_wrap')
//        .stop(true)
//        .animate({
//            'top':'140px'
//        },500,'easeOutBack')
//        .andSelf()
//        .find('.sdt_active')
//        .stop(true)
//        .animate({
//            'height':'170px'
//        },300,function(){
//            var $sub_menu = $elem.find('.sdt_box');
//            if($sub_menu.length){
//                var left = '150px';
//                if($elem.parent().children().length == $elem.index()+1)
//                    left = '-150px';
//                $sub_menu.show().animate({
//                    'left':left
//                },200);
//            }
//        });
//    }).bind('mouseleave',function(){
//        var $elem = $(this);
//        var $sub_menu = $elem.find('.sdt_box');
//        if($sub_menu.length)
//            $sub_menu.hide().css('left','0px');
//
//        $elem.find('.sdt_active')
//        .stop(true)
//        .animate({
//            'height':'0px'
//        },300)
//        .andSelf().find('img')
//        .stop(true)
//        .animate({
//            'width':'0px',
//            'height':'0px',
//            'left':'85px'
//        },400)
//        .andSelf()
//        .find('.sdt_wrap')
//        .stop(true)
//        .animate({
//            'top':'3px'
//        },500);
//    });

});
