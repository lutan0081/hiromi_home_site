/**
 * 左から右にhr描写
 */
 $(window).on('scroll',function(){
    $(".boderTrigger").each(function(){
        var position = $(this).offset().top;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll > position - windowHeight){
            $("hr").css('width', '100%');
        }
    });
 });
 