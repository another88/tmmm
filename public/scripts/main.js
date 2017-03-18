$(document).ready(function()
{
//    $('.analiticsToCartButton').on('click', function() {
//      ga('send', 'event', 'tocart', 'tocartadd');
//    });        
    
    $('.clickToWhite').click(function(){
        $(this).css('background-color', 'white');
    });
    
    jQuery(function(f){
        var element = f("#toTopBig");
        f(window).scroll(function(){
            element['fade'+ (f(this).scrollTop() > 550 ? 'In': 'Out')](500);          
        });
    });     
    $('#content').click(function(){
        if( $('.slide_menu').css('display') == 'block' )
        {
            $('.slide_menu').toggle( "slide" );
        }        
    });  
    
    $('.phoneNumberClass').hide();
});

function scrollTo(id)
{
    var destination = $('#'+id).offset().top;
    $("html:not(:animated),body:not(:animated)").animate({scrollTop: destination}, 1100);
    return false;
}

function redirect(url)
{
    window.location.href = rootPath + url;
}

function openModal(type)
{
    $.popup(type, 378, 0);
    window.scroll(0,0);
}

function openModalSubs(type, wbn)
{
    $.popup('subscribe', 340, wbn);
    $('input[name="subsType"]').val(type);
    if( type == 'user' )
    {
        $('.feedbackHeader').html('Оформление подписки<div class="clr"></div>');
        $('.subsPopupButton').html('Подписаться');
    }
    else
    {
        $('.feedbackHeader').html('Запрос коммерческого предложения<div class="clr"></div>');
        $('.subsPopupButton').html('Получить предложение');
    }
//    window.scroll(0,0);
}

function subsSend()
{
    var send = true;
    var errorText = '';
    $('#subs_message').html('');    
    
    var checkInp = $('#subsForm').find('input[name="phoneNumber"]').val();
    if( empty(checkInp) )
    {
        $('#subsForm input:visible').each(function(i,v)
        {
            var jQ = $(v);

            if ( jQ.attr('valid') && !validate(jQ.val(), jQ.attr('content-type')) )
            {
                send = false;
                jQ.css('background-color', 'red');
                var currentErrorText = jQ.attr('errortext');
                if( errorText !== '' )
                    errorText += '<br/>'+currentErrorText;
                else
                    errorText += currentErrorText;
            } else {
                jQ.css('background-color', 'white');
            }        
        });

        if( send )
        {    
            $('#subs_message').removeClass('error').removeClass('done').html('');     
            $.ajax({
                type: "POST",
                data: $('#subsForm :input').serializeArray(),
                url: rootPath + "wholesale/addsubcribe",
                async: false,
                success: function(resp)
                {
                    if(resp === 'ok')
                    {
                        $('#subs_message').addClass('done').removeClass('error').html('Проверьте свой E-mail.');
                        setTimeout('window.location.reload()', 1500);   
                    }
                    else{
                        $('#subs_message').addClass('error').removeClass('done').html(resp);
                    }
                }
            });
        }
        else
        {
            $('#subs_message').addClass('error').removeClass('done').html(errorText);
        }    
    }
}

function openModalBuyClick(prId)
{
    $.popup('buyOnClick_'+prId, 740, prId);
}

function popupEnter(e, $this)
{
    
     var keynum
     if(window.event) // IE
     {
        keynum = e.keyCode
     }
     else if(e.which) // Netscape/Firefox/Opera
     {
         keynum = e.which
     }
     
     if(keynum == 13) 
     {
         $this.parent('div').parent('.popupContent').find('.popupDoButton').click();   
     }
}

function login()
{
    var send = true;
    
    $('#popup_login input:visible').each(function(i,v)
    {
        var jQ = $(v);
        
        if ( jQ.attr('valid') && !validate(jQ.val(), jQ.attr('content-type')) )
        {
            send = false;
            jQ.css('background-color', 'red');
            $('#login_message').html('');
            $('#login_message').addClass('error').removeClass('done').html('Поля, отмеченные звездочкой, обязательны для заполнения.');
        } else {
            jQ.css('background-color', 'white');
        }        
    });
    
    if( send )
    {    
        $('#login_message').removeClass('error').removeClass('done').html('');     
        $.ajax({
            type: "POST",
            data: $('#popup_login :input').serializeArray(),
            url: rootPath + "user/login",
            async: false,
            success: function(resp)
            {
                if(resp === 'ok')
                {
                    $('#login_message').addClass('done').removeClass('error').html('Вы успешно зашли.');
                    setTimeout('window.location.reload()', 1500);   
                }
                else{
                    $('#login_message').addClass('error').removeClass('done').html(resp);
                }
            }
        });
    }
}

function toCart(productId, openPopup)
{
//    $.popup('to_basket', 500, productId);
    var amount = 1;
    if( parseInt($('#productAmount').val()) )
    {
        amount = parseInt($('#productAmount').val());
    }
    $.ajax({
        type: "POST",
        data: 'productId='+productId+'&amount='+amount,
        url: rootPath + "checkout/addtocart",
        async: false,
        success: function(resp)
        {
            $('#basket').html(resp);
            if( openPopup )
            {
                $.popup('to_basket', 500, productId);
            }
            else
            {
                setTimeout('window.location.reload()', 500); 
                scrollTo('top');
            }
//           scrollTo('top');
        }
    });
}

function headerSearchEnter(e)
{
     var keynum
     if(window.event) // IE
     {
        keynum = e.keyCode
     }
     else if(e.which) // Netscape/Firefox/Opera
     {
         keynum = e.which
     }
     if(keynum == 13) 
         search();  
}

function search()
{
    var key = $('input[name="searchKey"]').val();
    if( key != 'Поиск по каталогу' && key != '')
    {
        window.location.href = rootPath + 'search/index/searchKey/'+key;
    }
}

function searchInputClick()
{
    if( $('#searchInp').val() == 'Поиск по каталогу' )
    {    
        $('#searchInp').css('font-style', 'normal').css('color', 'black').val('');
    }
}

function searchInputBlur()
{
    if( $('#searchInp').val() == '' )
    {
        $('#searchInp').css('font-style', 'italic').css('color', '#6e6e6e').val('Поиск по каталогу');
    }
}

function buyOnClick(productId)
{
    var send = true;
    
    var checkInp = $('#popup_buyOnClick_'+productId).find('.popupContent').find('input[name="phoneNumber"]').val();
    if( empty(checkInp) )
    {    
        var errorText = '';
        $('#popup_buyOnClick_'+productId).find('#product_popup_message').html('');

        $('#popup_buyOnClick_'+productId+' input:visible').each(function(i,v)
        {
            var jQ = $(v);
            if ( jQ.attr('valid') && !validate(jQ.val(), jQ.attr('content-type')) )
            {
                send = false;
                jQ.css('background-color', 'red');
                var currentErrorText = jQ.attr('errortext');
                if( errorText !== '' )
                    errorText += '<br/>'+currentErrorText;
                else
                    errorText += currentErrorText;
            } else {
                jQ.css('background-color', 'white');
            }        
        });

        if( send )
        {    
            $('#popup_buyOnClick_'+productId).find('#product_popup_message').removeClass('error').removeClass('done').html('');        
            $.ajax({
                type: "POST",
                data: $('#popup_buyOnClick_'+productId+' :input').serializeArray(),
                url: rootPath + "checkout/onclick",
                async: false,
                success: function(resp)
                {
                    if(resp === 'ok')
                    {
    //                    ga('send', 'event', 'onclick', 'onclickadd');
                        $('#popup_buyOnClick_'+productId).find('.popupFinishDiv').addClass('done').html('Ваш заказ успешно добавлен, мы с Вами свяжемся. Спасибо!'); 
    //                    $('#popup_buyOnClick_'+productId).find('#product_popup_message').removeClass('error').addClass('done').html('Ваш заказ успешно добавлен, мы с Вами свяжемся. Спасибо!');        
                        setTimeout('window.location.reload()', 1500);   
                    }
                    else{
                        $('#popup_buyOnClick_'+productId).find('#product_popup_message').addClass('error').removeClass('done').html(resp);        
                    }
                }
            });
        }
        else
        {
            $('#popup_buyOnClick_'+productId).find('#product_popup_message').addClass('error').removeClass('done').html(errorText);
        }
    }
}

function toTopHover($this)
{
    $this.css('background-color', 'black');
    $this.find('.toTopInfo').find('.toTopImg').find('img').attr('src', 'i/up_arrow_active.png');
    $this.find('.toTopInfo').find('.toTopText').css('color', 'white');
}

function toTopOut($this)
{
    $this.css('background', 'transparent url("i/to_top_bg.png") repeat-x 0 0');
    $this.find('.toTopInfo').find('.toTopImg').find('img').attr('src', 'i/up_arrow.png');
    $this.find('.toTopInfo').find('.toTopText').css('color', '#d7d7d7');
}

function slideMenu()
{
    $('.slide_menu').toggle( "slide" );
}