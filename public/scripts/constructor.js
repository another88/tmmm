$(document).ready(function()
{
//    drawMainMenu();
    
    $('.conElement').mouseover(function(){
        var conElId = $(this).attr('id');
        var conElImg = $(this).children('img').attr('src');
        if( conElImg === 'i/'+conElId+'.png' )
        {
            $(this).children('img').attr('src', 'i/'+conElId+'_hover.png');
        }
//        else
//        {
//            $(this).children('.consClearBlockButton').slideDown(200);
//        }
    });    
    
    $('.conElement').mouseout(function(){
        var conElId = $(this).attr('id');
        var conElImg = $(this).children('img').attr('src');
        if( conElImg === 'i/'+conElId+'_hover.png' )
        {
            $(this).children('img').attr('src', 'i/'+conElId+'.png');
        }
//        else
//        {
//            $(this).children('.consClearBlockButton').slideUp(200);
//        }        
    });        
    
    if( $('input[name="jsonData"]') )
    {
        var jsonData = $.parseJSON($('input[name="jsonData"]').val());

        var choiceBlockHtml = '';
        $.each(jsonData, function(i,val)
        {
            choiceBlockHtml += '<div id="popup_constructor_'+val.code+'" class="popup">';
            choiceBlockHtml += '<div class="feedbackHeader">'+val.title+'<div class="clr"></div></div><div class="clr"></div>';
            choiceBlockHtml += '<div class="popupContentCheckout">';
            $.each(val.data, function(i2,val2)
            {
                choiceBlockHtml += '<div class="choiceBlockItemElement" onclick="setElement(\''+val.code+'\', \''+val2.elementId+'\', \''+val2.price+'\', \'images/'+val2.imageDir+'/'+val2.elementId+'/'+val2.imageSmall+'\', true);">';
                choiceBlockHtml += '<div class="elementImage"><img src="images/'+val2.imageDir+'/'+val2.elementId+'/'+val2.imageSmall+'" width="170px"/><div class="clr"></div></div>';
                choiceBlockHtml += '<div class="elementText"><strong>'+val2.title+'</strong><div class="clr"></div>'+val2.description+'<div class="clr"></div><strong>'+val2.price+' руб.</strong><div class="clr"></div></div>';
                choiceBlockHtml += '<div class="clr"></div></div>';
            }); 
            choiceBlockHtml += '<div class="clr"></div></div><div class="clr"></div></div><div class="clr"></div>';
        });    
        $('#consModals').html(choiceBlockHtml);  
    }      
});

function setElement(code, id, price, image, isRecalc)
{
    $.closePopup('#popup_constructor_'+code);
    scrollTo('constructor_top');
//    var newImage = '<img src="'+image+'" />';
    $('.conMain_'+code).children('img').attr('src', image); 
    $('.conMain_'+code).attr('elementprice', price); 
    $('input[name="'+code+'"]').val(id); 
    if( isRecalc )
        recalculate();
    $('#clearButton_'+code).show(); 
}

function drawMainMenu()
{
    var jsonData = $.parseJSON($('input[name="jsonData"]').val());
    var choiceBlockHtml = '';
    $.each(jsonData, function(i,val)
    {
        choiceBlockHtml += '<div class="choiceBlockItem item_'+val.code+'" onclick="setChoiceElement(\''+val.code+'\');">'+val.title+'</div><div class="clr"></div>';
        choiceBlockHtml += '<div class="choiceBlockItemInner itemInner_'+val.code+'" id="itemInner2_'+val.code+'">';
        choiceBlockHtml += '<div class="choiceBlockItemActive">'+val.title+'<span class="deleteButtonChoice" onclick="cleaBlock(\''+val.code+'\');">Очистить блок</span></div><div class="clr"></div>';
//        choiceBlockHtml += '<div class="choiceBlockItemActive">'+val.title+'<span class="deleteButtonChoice" onclick="cleaBlock(\''+val.code+'\');">Очистить блок</span><span class="backButtonChoice" onclick="toMainMenu();">В меню выбора</span></div><div class="clr"></div>';
        $.each(val.data, function(i2,val2)
        {
            choiceBlockHtml += '<div class="choiceBlockItemElement" id="item_'+val.code+'_'+val2.elementId+'" onclick="setElement(\''+val.code+'\', \''+val2.elementId+'\', \''+val2.price+'\', \'images/'+val2.imageDir+'/'+val2.elementId+'/'+val2.imageSmall+'\', true);">';
            choiceBlockHtml += '<div class="elementImage"><img src="images/'+val2.imageDir+'/'+val2.elementId+'/'+val2.imageSmall+'" width="170px"/><div class="clr"></div></div>';
            choiceBlockHtml += '<div class="elementText"><strong>'+val2.title+'</strong><div class="clr"></div>'+val2.description+'<div class="clr"></div><strong>'+val2.price+' руб.</strong><div class="clr"></div></div>';
            choiceBlockHtml += '<div class="clr"></div></div>';
        }); 
        choiceBlockHtml += '<div class="clr"></div></div><div class="clr"></div></div>';
    });    
    $('.constructorRightItem').html(choiceBlockHtml);    
}

function setChoiceElement(code)
{
//    $('.choiceBlockItem').fadeOut(0);
//    $('.choiceBlockItemInner').fadeOut(0);
//    $('.itemInner_'+code).fadeIn(100);
//    scrollTo('itemInner2_'+code);

    $.popup('constructor_'+code, 640, 0);
    window.scroll(0,0);    
//    $('#popup_constructor_'+code).find('input[name="choiceElementUnikey"]').val(uniKey);    
}

function toMainMenu()
{
//    drawMainMenu();
}



function recalculate()
{
    var price = 0;
    var price2 = 0;
    var conElementCount = 0;
    $(".conElement").each(function(i){
        price += parseInt($(this).attr('elementprice'));  
        if( parseInt($(this).attr('elementprice')) != 0 )
            conElementCount += 1;
    });    
    if( conElementCount === 6 )
    {
        price2 = price - 270;
        $('.consDiscount').html('<strong>Со скидкой:</strong> <span class="consPriceDiscount">'+price2+'</span> руб.');
    }
    else
    {
        $('.consDiscount').html('');
    }
    $('.consPrice').html(price);
}

function toCartConstr()
{
    var send = true;
    if( parseInt($('.consPrice').html()) === 0 )
    {
        alert('Для завершения выбирите элементы.');
        send = false;        
    }

//    if( $('input[name="portv"]').val() != 0 ||
//          $('input[name="shlang"]').val() != 0 ||
//          $('input[name="portn"]').val() != 0)
//    {
//        if( $('input[name="portv"]').val() == 0 ||
//              $('input[name="shlang"]').val() == 0 ||
//              $('input[name="portn"]').val() == 0)
//        {     
//            alert('Сборка шланга не завершена.');
//            send = false;
//        }   
//    }
    if( send )
    {
        $.ajax({
            type: "POST",
            data: $('.constructorLeft :input').serializeArray(),
            url: rootPath + "constructor/addtocart",
            async: false,
            success: function(resp)
            {
                $('#basket').html(resp);
                $.popup('to_basket', 500, 1000);
//                scrollTo('top');
            }
        });
    }
}

function constructorClear()
{
    var array = new Array('shaxta','kolba','trybka','bowl','bludce','shipci');
    for(var i = 0; i < array.length; i++)
    {
        var code = array[i];
        $('.conMain_'+code).html('<img src="i/'+code+'.png" />'); 
        $('.conMain_'+code).attr('elementprice', 0); 
        $('input[name="'+code+'"]').val(0);     
        $('#clearButton_'+code).hide(); 
    }
//    drawMainMenu();
    recalculate();
}

function cleaBlock(code)
{
    $('.conMain_'+code).html('<img src="i/'+code+'.png" />'); 
    $('.conMain_'+code).attr('elementprice', 0); 
    $('input[name="'+code+'"]').val(0); 
//    drawMainMenu();
    recalculate();    
    $('#clearButton_'+code).hide(); 
}

function elementsFromBaseShow()
{
    if( $('.constructorBaseItem').css('display') !== 'block' )
        $('.constructorBaseItem').slideDown(500);
    else
        $('.constructorBaseItem').slideUp(500);    
}

function setElementsFromBase(id)
{
    constructorClear();
    var jsonData = $.parseJSON($('input[name="constructorBaseJson"]').val());
    $.each(jsonData.data, function(i,val)
    {
        if( val.constructorId === parseInt(id) )
        {
            $.each(val.elements, function(i2,val2)
            {
                setElement(i2, val2.elementId, val2.price, 'images/'+val2.imageDir+'/'+val2.elementId+'/'+val2.imageSmall, false);
            }); 
        }
    });       
    recalculate();
}

function toConstructorPage(page)
{
    $.ajax({
        type: "POST",
        data: 'page='+page,
        url: rootPath + "constructor/paging",
        async: false,
        success: function(resp)
        {
            $('.constructorBaseContent').html(resp);
            $('.constructorBaseItem').slideDown(500);
        }
    });    
}