(function($){
    $.popup = function(type, userWidth, productId){
        // defaults options
        var defaults = {
            htmlCode: '',
            clickMask: true,//
            maskOpacity: 0.45,//
            width: userWidth, // popup width
            left:'',
            top:'',
            type:type,
            className: '#popup_'+type
//            className: '.popup'
        };
        var options = $.extend(defaults,options);
        var maskHeight = $(document).height();
//        var maskWidth = $(window).width();
        $('#mask').css({
            'width':'100%',
            'height':maskHeight
        });
        $('#mask').fadeTo(50,options.maskOpacity);
	
        var winH = $(window).height();
        var winW = $(window).width();
        
        if( productId !== 0 )
        {
            if( type == 'subscribe' && productId != 'footer' )
            {
                pTop = $("div#wb"+productId).offset().top;
            }
            else if( productId == 'footer' )
            {
               pTop = $(".footerSubs").offset().top - 300; 
            }
            else{
                pTop = $("div#productBlock_"+productId).offset().top + 200;
            }
            
        }
        else
        {
            var pTop = Math.max(20,winH/2 - $(options.className).height()/2);
            if(options.top!==''){
                pTop = options.top - $(options.className).height()/2;
            }   
        }
        
//        var mePos = me.offset();
        $(options.className).css({
            'width': options.width,
            'top': pTop,
            'left': winW/2 - options.width/2
        }).fadeIn(500);

        var popupHeight = $(options.className).height();
        $('body, #mask').height(Math.max($(document).height(),24 + pTop + popupHeight));

        if(options.clickMask){
            var mask = $('#mask');
        }

        $('.closePopup').add(mask).click(function () {
            $.closePopup('#popup_'+type);
            return false;
        });
        $(document).keyup(function (e) {
            if(e.keyCode === 27){
                $.closePopup('#popup_'+type);
            }
        });
    };
    $.closePopup = function(closeElem){
//        var defaults = {
//            closeElem: '.popup'
//        };
//        var options = $.extend(defaults,options);
        $('#mask').add(closeElem).hide();
        $('body, #mask').css('height','auto');
        $('#popup_message').removeClass('error').removeClass('done').html('');
        $('#login_message').removeClass('error').removeClass('done').html('');
        $('#mask').add(closeElem).find('input').css('background-color', 'white');
    };
})(jQuery);