/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var sponsorHeight; 
var sponsorWidth;
$(window).load(function () {
    $('.flexslider').flexslider();
    $(".sponsor").each(function(){
        //alert($(this).find("img").height());
        //$(this).width($(this).find("img").width() + 20);
        //$(this).height($(this).find("img").height() + 20);
        
        var width = $(this).find("img").width();
        var height = $(this).find("img").height();
        
        var left = Math.floor(($(this).width() - width)/2);
        var top = Math.floor(($(this).height() - height)/2);
        
        $(this).find("img").css("left", left-10);
        $(this).find("img").css("top", top-10);
        
        sponsorHeight = height;
        sponsorWidth = width;
    });
    
    $("#sponsors ul").css("display", "inline");
    $("#sponsors ul").css("width", $("#sponsors ul").width()+1);
    $("#sponsors ul").css("display", "block");
});

$(window).resize(function(){  
    $(".sponsor").each(function(){
        //alert($(this).find("img").height());
        //$(this).width($(this).find("img").width() + 20);
        //$(this).height($(this).find("img").height() + 20);
        
        var width = $(this).find("img").width();
        var height = $(this).find("img").height();
        
        if(width != sponsorWidth || height != sponsorHeight)
        {
            var left = Math.floor(($(this).width() - width)/2);
            var top = Math.floor(($(this).height() - height)/2);
        
            $(this).find("img").css("left", left-10);
            $(this).find("img").css("top", top-10);
            
            sponsorHeight = height;
            sponsorWidth = width;
        }
    });
    
    $("#sponsors ul").css("display", "inline");
    $("#sponsors ul").css("width", $("#sponsors ul").width()+1);
    $("#sponsors ul").css("display", "block");
});

$(function(){
    $(function(){
        /*$('#slides').slides({
            effect:'slide,fade',
            preload: true,
            preloadImage: 'img/loading.gif',
            play: 5000,
            pause: 2500,
            hoverPause: true,
            //autoHeight: true,
            animationStart: function(current){
                $('.caption').animate({
                    bottom:-35
                },100);
                if (window.console && console.log) {
                    // example return of current slide number
                    console.log('animationStart on slide: ', current);
                }
            },
            animationComplete: function(current){
                $('.caption').animate({
                    bottom:0
                },200);
                if (window.console && console.log) {
                    // example return of current slide number
                    console.log('animationComplete on slide: ', current);
                }
            },
            slidesLoaded: function() {
                $('.caption').animate({
                    bottom:0
                },200);
            }
        });*/
    });
   
    $('.sponsorFlip').bind("click",function(){

        // $(this) point to the clicked .sponsorFlip element (caching it in elem for speed):

        var elem = $(this);

        // data('flipped') is a flag we set when we flip the element:

        if(elem.data('flipped'))
        {
            // If the element has already been flipped, use the revertFlip method
            // defined by the plug-in to revert to the default state automatically:

            elem.revertFlip();

            // Unsetting the flag:
            elem.data('flipped',false)
        }
        else
        {
            // Using the flip method defined by the plugin:

            elem.flip({
                direction:'lr',
                speed: 350,
                onBefore: function(){
                    // Insert the contents of the .sponsorData div (hidden
                    // from view with display:none) into the clicked
                    // .sponsorFlip div before the flipping animation starts:

                    elem.html(elem.siblings('.sponsorData').html());
                }
            });

            // Setting the flag:
            elem.data('flipped',true);
        }
    });
});