$(document).ready(function()
{
    if( constructorIsset )
    {
        if( $(".cartJsonInput") )
        {
            $(".cartJsonInput").each(function(i)
            {
                drawConstructorBlock($(this).attr('id'));         
            });    
        }

        if( $('input[name="jsonData"]') )
        {
            var jsonData = $.parseJSON($('input[name="jsonData"]').val());

            var choiceBlockHtml = '';
            $.each(jsonData, function(i,val)
            {
                choiceBlockHtml += '<div id="popup_constructor_'+val.code+'" class="popup"><input type="hidden" name="choiceElementUnikey" />';
                choiceBlockHtml += '<div class="feedbackHeader">'+val.title+'<div class="clr"></div></div><div class="clr"></div>';
                choiceBlockHtml += '<div class="popupContentCheckout">';
                $.each(val.data, function(i2,val2)
                {
                    choiceBlockHtml += '<div class="choiceBlockItemElement" onclick="setElementInCartModal(\''+val.code+'\', \''+val2.elementId+'\');">';
                    choiceBlockHtml += '<div class="elementImage"><img src="images/'+val2.imageDir+'/'+val2.elementId+'/'+val2.imageSmall+'" width="170px"/><div class="clr"></div></div>';
                    choiceBlockHtml += '<div class="elementText"><strong>'+val2.title+'</strong><div class="clr"></div>'+val2.description+'<div class="clr"></div><strong>'+val2.price+' руб.</strong><div class="clr"></div></div>';
                    choiceBlockHtml += '<div class="clr"></div></div>';
                }); 
                choiceBlockHtml += '<div class="clr"></div></div><div class="clr"></div></div><div class="clr"></div>';
            });    
            $('#cartConsModals').html(choiceBlockHtml);  
        }   
    }    
    
//    $('#prLke').scrollbox({
//        linear: true,
//        step: 1,
//        delay: 0,
//        speed: 40,        
//        direction: 'h'
////        distance: 140
//    });  
});

function drawConstructorBlock(uniKey)
{
    var jsonData = $.parseJSON($('input[id="'+uniKey+'"]').val());
    var consBlockHtml = '<div class="conLeftPart">\n\
                            <div class="conShaxta conElement conMain_shaxta" onclick="setChoiceElementInCart(\'shaxta\', \''+uniKey+'\');">\n\
                            </div>\n\
                            <div class="clr"></div>\n\
                            <div class="conKolba conElement conMain_kolba" onclick="setChoiceElementInCart(\'kolba\', \''+uniKey+'\');">\n\
                            </div>\n\
                            <div class="clr"></div>\n\
                        </div>\n\
                        <div class="consRightPart">\n\
                            <div class="conTrybka conElement conMain_trybka" onclick="setChoiceElementInCart(\'trybka\', \''+uniKey+'\');">\n\
                            </div>\n\
                            <div class="clr"></div>\n\
                            <div class="conBowl conElement conMain_bowl" onclick="setChoiceElementInCart(\'bowl\', \''+uniKey+'\');">\n\
                            </div>\n\
                            <div class="conBludce conElement conMain_bludce" onclick="setChoiceElementInCart(\'bludce\', \''+uniKey+'\');">\n\
                            </div>\n\
                            <div class="clr"></div>\n\
                            <div class="conShipci conElement conMain_shipci" onclick="setChoiceElementInCart(\'shipci\', \''+uniKey+'\');">\n\
                            </div>\n\
                            <div class="clr"></div>\n\
                        </div>';  
    $('#consPreviewBlock_'+uniKey).html(consBlockHtml); 
    $.each(jsonData, function(i,val)
    {
        var imageDir = 'images/'+val.imageDir+'/'+val.elementId+'/'+val.imageSmall;
        if( val.consShaxtaId )
        {
            $('#consPreviewBlock_'+uniKey).find('.conShaxta').html('<img src="'+imageDir+'" width="79px" />');
        }
        else if( val.consKolbaId )
        {
            $('#consPreviewBlock_'+uniKey).find('.conKolba').html('<img src="'+imageDir+'" width="79px" />');            
        }
        else if( val.consTrybkaId )
        {
            $('#consPreviewBlock_'+uniKey).find('.conTrybka').html('<img src="'+imageDir+'" width="106px" />');            
        }
        else if( val.consBowlId )
        {
            $('#consPreviewBlock_'+uniKey).find('.conBowl').html('<img src="'+imageDir+'" width="50px" />');            
        }
        else if( val.consBludceId )
        {
            $('#consPreviewBlock_'+uniKey).find('.conBludce').html('<img src="'+imageDir+'" width="50px" />');            
        }
        else if( val.consShipciId )
        {
            $('#consPreviewBlock_'+uniKey).find('.conShipci').html('<img src="'+imageDir+'" width="50px" />');            
        }        
    });      
}

function setChoiceElementInCart(code, uniKey)
{
    $.popup('constructor_'+code, 640, 0);
    window.scroll(0,0);    
    $('#popup_constructor_'+code).find('input[name="choiceElementUnikey"]').val(uniKey);
}

function setElementInCartModal(code, elementId)
{
    var send = true;
    var uniKey = $('#popup_constructor_'+code).find('input[name="choiceElementUnikey"]').val();
    if( send )
    {
        $.ajax({
            type: "POST",
            data: 'code='+code+'&id='+elementId+'&unikey='+uniKey,
            url: rootPath + "checkout/changeconselement",
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

function order()
{
    var send = true;
    
    var checkInp = $('.orderForm').find('input[name="phoneNumber"]').val();
    if( empty(checkInp) )
    {        
        var errorText = '';
        $('#checkout_message').html('');

        $('.orderForm input:visible').each(function(i,v)
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
            $('#checkout_message').removeClass('error').removeClass('done').html('');        
            $.ajax({
                type: "POST",
                data: $('.orderForm :input').serializeArray(),
                url: rootPath + "checkout/order",
                async: false,
                success: function(resp)
                {
                    if(resp === 'ok')
                    {
    //                    ga('send', 'event', 'buy', 'buyadd');
                        $('#checkout_message').removeClass('error').addClass('done').html('Ваш заказ успешно отправлен на обработку. Мы с Вами свяжемся. Спасибо!'); 
                        setTimeout('window.location.reload()', 1500);  
                    }
                    else{
                        $('#checkout_message').addClass('error').removeClass('done').html(resp); 
                    }
                }
            });
        }
        else
        {
           $('#checkout_message').addClass('error').removeClass('done').html(errorText);
        }
    }
}