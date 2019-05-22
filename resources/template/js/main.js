$(function() {
    'use strict';
    // windows height
    var windowheight=$(window).height();
    $('#header').css('height',windowheight);

// after scroll style for navbar
    function stickyMenu(){
        $(window).on('scroll', function(){
            var x = $(this).scrollTop();

            if(x > 100){
                $('.active_nav').addClass('isActive');
            }else{
                $('.active_nav').removeClass('isActive');
            }
        });
    }
    stickyMenu();


}());