/**
 * Created by Administrator on 2016/4/14.
 */
$(function(){
    //首页文字滚动
    var Otext=$("#jsText");
    var Oheight=$('.home-icons .news').height()+2;
    setInterval(function () {
        Otext.animate({marginTop:-Oheight},500,function(){
            $(this).css('marginTop',0).find('dd:first').appendTo($(this));
        })
    },2000)
});

//公共tab切换
$(function(){
    $('.js-tab li').click(function () {
        $(this).addClass('on').siblings().removeClass('on');
         $(this).parents().siblings('.js-con').hide().eq($(this).index()).show();
    })
})

//月份切换
$(function(){
    var $prevBtn=$('.date-view .prev');
    var $nextBtn=$('.date-view .next');
    var $aLi=$('.date-view .month li');
    var $oUl=$('.date-view .month ul');
    var $conUl=$('.date-view-body ul');
    $nextBtn.click(function () {
        $oUl.css({
            transform: 'translateX(-15.225rem)',
            MozTransform: 'translateX(-15.225rem)',
            WebkitTransform: 'translateX(-15.225rem)',
            msTransform: 'translateX(-15.225rem)'
        })
    });
    $prevBtn.click(function () {
        $oUl.css({
            transform: 'translateX(0rem)',
            MozTransform: 'translateX(0rem)',
            WebkitTransform: 'translateX(0rem)',
            msTransform: 'translateX(0rem)'
        })
    });
    $aLi.click(function () {
        $(this).addClass('on').siblings().removeClass('on')
        $conUl.hide().eq($(this).index()).show();
    })

})

$(function(){
    $('.mxtj').each(function(){
        var $aLi=$(this).find('li');
        var $widht=$aLi.size()*($aLi.width()+16);
        $(this).find('.mxtj-body ul').css({width:$widht});
    })
})



$(function(){
    //城市列表
    $('.slider-nav').each(function () {
        var Oheight=($(window).height()-$('.header').height()-$('.footer').height()-18)/$('.slider-nav li').size();
        $('.slider-nav li').height(Oheight)
    })
    //公共导航栏
    $('.top-nav li').click(function () {
       if($(this).hasClass('on')){
            $(this).removeClass('on');
           $(this).find('dl').stop().slideUp(200);
       }else {
           $(this).addClass('on').siblings('li').removeClass('on');
           $(this).find('dl').stop().slideDown(200);
           $(this).siblings('li').find('dl').hide();
       }
    })
    $('.top-nav dd').click(function () {
        $(this).addClass('on').siblings().removeClass('on');
    })
    //回到顶部
    $('.footer li:last-child').click(function () {
        $('html,body').animate({
                scrollTop: 0
            },1000);
    })
})










