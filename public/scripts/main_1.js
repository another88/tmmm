$(document).ready(function()
{
//    $('#sm_slider').smSlider({
//            autoPlay : true,
//            delay : 4000
//    });
    
    $('.imageFancy').fancybox({
                margin:0,
                padding:0,
                cyclic:true
    });      
    
    if( loadMap )
    {
        mapLoad();
    }
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
    $.popup(type, 505);
    window.scroll(0,0);
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
         $this.parent('.inputField').parent('.popupContent').find('.popupDoButton').click();   
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

function orderCall()
{
    var send = true;
    
    $('#popup_callOrder input:visible').each(function(i,v)
    {
        var jQ = $(v);
        
        if ( jQ.attr('valid') && !validate(jQ.val(), jQ.attr('content-type')) )
        {
            send = false;
            jQ.css('background-color', 'red');
            $('#callOrder_message').html('');
            $('#callOrder_message').addClass('error').removeClass('done').html('Поля, отмеченные звездочкой, обязательны для заполнения.');
        } else {
            jQ.css('background-color', 'white');
        }        
    });
    
    if( send )
    {    
        $('#callOrder_message').removeClass('error').removeClass('done').html('');        
        $.ajax({
            type: "POST",
            data: $('#popup_callOrder :input').serializeArray(),
            url: rootPath + "index/callorder",
            async: false,
            success: function(resp)
            {
                if(resp === 'ok')
                {
                    $('#callOrder_message').removeClass('error').addClass('done').html('Ваша заявка успешно отправлена! Мы с Вами свяжемся! Спасибо!'); 
                    setTimeout('window.location.reload()', 1500);   
                }
                else{
                    $('#callOrder_message').addClass('error').removeClass('done').html(resp); 
                }
            }
        });
    }
}

function registry()
{
    var send = true;
    
    $('.contentLeft input:visible').each(function(i,v)
    {
        var jQ = $(v);
        
        if ( jQ.attr('valid') && !validate(jQ.val(), jQ.attr('content-type')) )
        {
            send = false;
            jQ.css('background-color', 'red');
            $('#registry_message').html('');
            $('#registry_message').addClass('error').removeClass('done').html('Поля, отмеченные звездочкой, обязательны для заполнения.');
        } else {
            jQ.css('background-color', 'white');
        }        
    });
    
    if( send )
    {    
        $('#registry_message').removeClass('error').removeClass('done').html('');        
        $.ajax({
            type: "POST",
            data: $('.contentLeft :input').serializeArray(),
            url: rootPath + "user/registry",
            async: false,
            success: function(resp)
            {
                if(resp === 'ok')
                {
                    $('#registry_message').removeClass('error').addClass('done').html('Вы успешно зарегистрировались. Добро Пожаловать!'); 
                    redirect('#');  
                }
                else{
                    $('#registry_message').addClass('error').removeClass('done').html(resp); 
                }
            }
        });
    }
}

function buyOnClick(productId)
{
    var send = true;
    
    $('#popup_buyOnClick_'+productId+' input:visible').each(function(i,v)
    {
        var jQ = $(v);
        
        if ( jQ.attr('valid') && !validate(jQ.val(), jQ.attr('content-type')) )
        {
            send = false;
            jQ.css('background-color', 'red');
            $('#popup_buyOnClick_'+productId).find('.buyOnClick_message').html('');
            $('#popup_buyOnClick_'+productId).find('.buyOnClick_message').addClass('error').removeClass('done').html('Поля, отмеченные звездочкой, обязательны для заполнения.');
        } else {
            jQ.css('background-color', 'white');
        }        
    });
    
    if( send )
    {    
        $('#popup_buyOnClick_'+productId).find('.buyOnClick_message').removeClass('error').removeClass('done').html('');        
        $.ajax({
            type: "POST",
            data: $('#popup_buyOnClick_'+productId+' :input').serializeArray(),
            url: rootPath + "checkout/onclick",
            async: false,
            success: function(resp)
            {
                if(resp === 'ok')
                {
                    $('#popup_buyOnClick_'+productId).find('.buyOnClick_message').removeClass('error').addClass('done').html('Ваш заказ успешно добавлен, мы с Вами свяжемся. Спасибо!');        
                    setTimeout('window.location.reload()', 1500);   
                }
                else{
                    $('#popup_buyOnClick_'+productId).find('.buyOnClick_message').addClass('error').removeClass('done').html(resp);        
                }
            }
        });
    }
}

function toCart(productId, openPopup)
{
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
            window.scroll(0,0);
            openCart();
            if( openPopup )
            {
                $.popup('to_basket', 400);
                setTimeout('openCart()', 4000); 
            }
           else
           {
               setTimeout('window.location.reload()', 500); 
           }
        }
    });
}

function openCart()
{
    if( !isCheckoutPage )
    {
        if( $('.headerCart').css('display') !== 'block' )
            $('.headerCart').slideDown(500);
        else
            $('.headerCart').slideUp(500);
    }
}

function deleteFromCart(productId, isOpenCart)
{
    if(!confirm('Подветрдите удаление.'))
        return;    
    $.ajax({
        type: "POST",
        data: 'productId='+productId,
        url: rootPath + "checkout/removefromcart",
        async: false,
        success: function(resp)
        {
            if( isOpenCart )
            {
                $('#basket').html(resp);
                window.scroll(0,0);
                openCart();
                setTimeout('openCart()', 4000);   
            }
            else
            {
                setTimeout('window.location.reload()', 200);  
            }
        }
    });
}

function changeImage(medium, original)
{
    $('#productImage').find('a').find('img').attr('src', medium);
//    $('#productImage').find('a').attr('href', original);
}

function addComment()
{
    var send = true;
    
    $('#commentBlock input:visible, #commentBlock textarea').each(function(i,v)
    {
        var jQ = $(v);
        
        if ( jQ.attr('valid') && !validate(jQ.val(), jQ.attr('content-type')) )
        {
            send = false;
            jQ.css('background-color', 'red');
            $('#comment_message').html('');
            $('#comment_message').addClass('error').removeClass('done').html('Поля, отмеченные звездочкой, обязательны для заполнения.');
        } else {
            jQ.css('background-color', 'white');
        }        
    });
    
    if( send )
    {    
        $('#comment_message').removeClass('error').removeClass('done').html('');        
        $.ajax({
            type: "POST",
            data: $('#commentBlock :input').serializeArray(),
            url: rootPath + "product/addcomment",
            async: false,
            success: function(resp)
            {
                if(resp === 'ok')
                {
                    $('#comment_message').removeClass('error').addClass('done').html('Ваш комментарий отправлен на модерацию! Спасибо!');   
                    setTimeout('window.location.reload()', 1500);   
                }
                else{
                    $('#comment_message').addClass('error').removeClass('done').html(resp);   
                }
            }
        });
    }    
}

function addFeedback()
{
    var send = true;
    
    $('#feedback input:visible, #feedback textarea').each(function(i,v)
    {
        var jQ = $(v);
        
        if ( jQ.attr('valid') && !validate(jQ.val(), jQ.attr('content-type')) )
        {
            send = false;
            jQ.css('background-color', 'red');
            $('#comment_message').html('');
            $('#comment_message').addClass('error').removeClass('done').html('Поля, отмеченные звездочкой, обязательны для заполнения.');
        } else {
            jQ.css('background-color', 'white');
        }        
    });
    
    if( send )
    {    
        $('#comment_message').removeClass('error').removeClass('done').html('');        
        $.ajax({
            type: "POST",
            data: $('#feedback :input').serializeArray(),
            url: rootPath + "content/addfeedback",
            async: false,
            success: function(resp)
            {
                if(resp === 'ok')
                {
                    $('#comment_message').removeClass('error').addClass('done').html('Ваше сообщение успешно отправленно! Спасибо!');  
                    setTimeout('window.location.reload()', 500);   
                }
                else{
                    $('#comment_message').addClass('error').removeClass('done').html(resp);  
                }
            }
        });
    }    
}

function changeAmount($type, $this, $recalcIt)
{
    var val = parseInt($this.parent().parent().children("input[name='amount']").val());
    var newVal = val;
    if( $type === 'up' )
    {
          newVal++;
    }
    else if( $type === 'down' )
    {
        if( val !== 1)
        {
            newVal--;
        }
    }
    $this.parent().parent().children("input[name='amount']").val(newVal);
    if( $recalcIt )
    {
        var uniKey = $this.parent().parent().children("input[name='uniKey']").val();
        $.ajax({
            type: "POST",
            data: 'uniKey='+uniKey+'&amount='+newVal,
            url: rootPath + "checkout/recalculate",
            async: false,
            success: function(resp)
            {
                if(resp === 'ok')
                {
//                    alert('Ваше сообщение успешно отправленно! Спасибо!');
                    setTimeout('window.location.reload()', 500);   
                }
                else{
                    alert(resp);
                }
            }
        });        
    }
}  

function changeAmountBlur($this, $recalcIt)
{
    if( parseInt($this.val()) < 1)
    {
        $this.val(1); 
    }
    if( $recalcIt )
    {
        var uniKey = $this.parent().children("input[name='uniKey']").val();
        $.ajax({
            type: "POST",
            data: 'uniKey='+uniKey+'&amount='+$this.val(),
            url: rootPath + "checkout/recalculate",
            async: false,
            success: function(resp)
            {
                if(resp === 'ok')
                {
                    window.location.reload();   
                }
                else{
                    alert(resp);
                }
            }
        });        
    }    
}

function order()
{
    var send = true;
    
    $('.orderForm input:visible').each(function(i,v)
    {
        var jQ = $(v);
        
        if ( jQ.attr('valid') && !validate(jQ.val(), jQ.attr('content-type')) )
        {
            send = false;
            jQ.css('background-color', 'red');
            $('#registry_message').html('');
            $('#registry_message').addClass('error').removeClass('done').html('Поля, отмеченные звездочкой, обязательны для заполнения.');
        } else {
            jQ.css('background-color', 'white');
        }        
    });
    
    if( send )
    {    
        $('#registry_message').removeClass('error').removeClass('done').html('');        
        $.ajax({
            type: "POST",
            data: $('.orderForm :input').serializeArray(),
            url: rootPath + "checkout/order",
            async: false,
            success: function(resp)
            {
                if(resp === 'ok')
                {
                    $('#registry_message').removeClass('error').addClass('done').html('Ваш заказ успешно отправлен на обработку. Мы с Вами свяжемся. Спасибо!'); 
                    redirect('#');  
                }
                else{
                    $('#registry_message').addClass('error').removeClass('done').html(resp); 
                }
            }
        });
    }
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
    window.location.href = rootPath + 'search/index/searchKey/'+key;
}

function mapLoad() 
{
    var centerLatLng = new google.maps.LatLng(44.5598486,33.4956265);
    var mapOptions = {
        zoom: 17,
        center: centerLatLng,
        mapTypeId: google.maps.MapTypeId.SATELLITE
    };
    
    var companyLogo = new google.maps.MarkerImage('http://ace-hookah.com/i/ace_logo_icon.png');
    new google.maps.Size(60,60);
    new google.maps.Point(0,0);
    new google.maps.Point(50,60);
    
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    var companyMarker = new google.maps.Marker({
        position: centerLatLng,
        map: map,
        icon: companyLogo,
        title: 'Ace Hookah'
    });
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