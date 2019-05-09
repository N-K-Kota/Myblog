$(function(){

    $('.usermenu-box__item').hover(function(){
        var ind = $('.usermenu-box__item').index(this);
        $('.usermenu-box__item__pop').each(function(index,element){
            $(element).stop();
            if(ind == index) {
                $(element).show(100);
            } else {
                $(element).hide(100);
            }
        });
    },function(){
        
    });
});