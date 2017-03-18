$(document).ready(function(){
    

});

function quickChangeInput(address, value, field)
{
//    alert(address+' '+value+' '+field);
    $.ajax({
        type: "POST",
        data: 'value='+value+'&field='+field,
        url: address,
        async: false,
        success:function(resp){}
    });
    return false;
}

function deleteRecord(address, recordId)
{
    $.ajax({
        type: "POST",
        url: address,
        async: false,
        success:function(resp){
            $('#record'+recordId).fadeOut(300);
        }
    });
    return false;
}
function approveRecord(address, recordId, field)
{
//    $('#approve'+recordId+field).html('<img src="icon/ajaxload.gif">');
    $.ajax({
        type: "POST",
        data: 'id='+recordId,
        url: address,
        async: false,
        success:function(resp){
//            if (resp == 'ok')
                window.location.reload();
//            else
//                alert(resp);
        }
    });
    return false;
}

function metaDeleteRecord(address, recordId)
{
    if(!confirm('Confirm delete!'))
        return;
    $.ajax({
        type: "POST",
        url: address,
        data: 'id='+recordId,
        async: false,
        success:function(resp){
            $('#record'+recordId).replaceWith('');
            if(resp == 'reload' || resp == 'Complete')
                location.href = location.href;
        }
    });
    return false;
}
function getCount(address)
{
    var count = $('tbody tr').size();
    if(count == 0) {
        address = address.split('/');
        location.href = address[0]+'/'+address[1];
    }
}

function approveAdditionalFields(recordId, address)
{
    $('#approve_'+recordId).html('<img src="styles/src/admin/ajaxload.gif">');
    $.ajax({
        type: "POST",
        data: 'id='+recordId+'&address='+address,
        url: rootPath+address,
        async: false,
        success:function(resp){
            if(resp == 'reload')
                window.location.reload();
            else
                $('#approve_'+recordId).html(resp);
        }
    });
    return false;
}

function filter(key, id, i)
{
  //  var split = id.split('_');
    $.ajax({
        type: "POST",
        data: 'key='+key+'&id='+id+'&i='+i,
        url: rootPath+"admin/metadata/filter",
        async: false,
        success: function(resp){
            var leftPx = 44 + 200 * i;
            $('#autocomplete_'+i).css('display', 'block');
            $('#autocomplete_'+i).css('left', leftPx);
            $('#contentVariant_'+i).html(resp);
        }
    });
}

function changeSelect(address, value, field)
{
    $.ajax({
        type: "POST",
        data: 'value='+value+'&field='+field,
        url: address,
        async: false,
        success:function(resp){
        }
    });
    return false;
}

function textChange(val, type, count)
{
     var lenght = val.length;
     if ( lenght > count ) {
         $('[name="'+type+'_text"]').val(val.substring(0,count));
         $('[name="count_'+type+'"]').val(0);
     } else 
        $('[name="count_'+type+'"]').val(count - lenght);
}

function textPageForm(val)
{
    if(val){
        $('.textPage').show();
        $('[name="link"]').attr('readonly', 'true');
        $('[name="createPage"]').attr('checked', 'true');
    } else {
        $('.textPage').hide();
        $('[name="link"]').removeAttr('readonly');
        $('[name="createPage"]').removeAttr('checked');
    }
}

function createNewTextPage()
{
    $('[name="textPageTitle"]').val('');
    $('[name="textPageUrl"]').val('');
    $('[name="textMetaTitle"]').val('');
    $('[name="textMetaDescription"]').val('');
    $('[name="textMetaKeywords"]').val('');
    $('#textPageText').html('');
    if (typeof(CKEDITOR.instances['textPageText']) == 'undefined') { 
        CKEDITOR.replace('textPageText', {"height":"150","width":"765px"});  
    } else {
        CKEDITOR.instances['textPageText'].destroy(true);
        CKEDITOR.replace('textPageText', {"height":"150","width":"765px"});  
    } 
    $('[name="textBlockId"]').val('');
    $('[name="textPageUrl"]').removeAttr('readonly');
}

function addProductToOrder()
{
    var productId = $('#selectProduct').val();
    $.ajax({
        type: "POST",
        data: 'productId='+productId,
        url: rootPath + "admin/order/addproduct",
        async: false,
        success:function(resp){
            window.location.reload();
        }
    });
}

function addAdminOrder()
{
    $.ajax({
        type: "POST",
        data: $('.adminTable :input').serializeArray(),
        url: rootPath + "admin/order/saveproduct",
        async: false,
        success: function(resp)
        {
            if(resp === 'ok')
            {
                alert('Заказ успешно добавлен!');
                location.href=rootPath+'admin/order'  
            }
            else{
                alert(resp);
            }
        }
    });    
}

function findGuest(type)
{
    var data = $('.findBlock').find('input[name="'+type+'"]').val();
    $.ajax({
        type: "POST",
        data: 'type='+type+'&val='+data,
        url: rootPath + "guest/findguest",
        async: false,
        success: function(resp)
        {
            $('.guestSearchRes').html(resp);
        }
    });    
}

function guestEnter(gId)
{
    $.ajax({
        type: "POST",
        data: 'guestId='+gId,
        url: rootPath + "guest/guestenter",
        async: false,
        success: function(resp)
        {
            $('#g_'+gId).fadeOut();
            $(".guestInside").append(resp);
        }
    });    
}

function guestOut(gId)
{
    $.ajax({
        type: "POST",
        data: 'guestId='+gId,
        url: rootPath + "guest/guestout",
        async: false,
        success: function(resp)
        {
            $('#gs_'+gId).fadeOut();
            $('#git_'+gId).fadeOut();
        }
    });    
}

function popupEnterAdmin(e, $this)
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
         $this.parent('div').parent('div').find('.findButtonActive').click();   
     }
}

function findGuestActive()
{
    var data = $('.findBlock').find('.findInputActive').find('input').val();
    if( jQuery.trim(data) )
    {
        $.ajax({
            type: "POST",
            data: 'val='+data,
            url: rootPath + "guest/findguestactive",
            async: false,
            success: function(resp)
            {
                $('.guestSearchRes').html(resp);
            }
        });    
    }   
    else
    {
        alert('Поле поиска пустое!');
    }
}

function editGuest(gId)
{
    $this = $('#gs_'+gId).find('.guestSetup').find('.editButtonActive');
    
    var oldData = {
        'remark' : $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestEditRemark').html(),
        'cardNumber' : $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestCardNumber').html(),
        'name' : jQuery.trim($this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestName').html()),
        'birth' : $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestBirth').html(),
        'phone' : $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestPhone').html(),
        'email' : $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestEmail').html(),
        'country' : $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestCountry').html(),
        'city' : $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestCity').html()
    };
    
    if( oldData['remark'] == '')
    {
        var guestRemarkInput = '<input type="text" name="remark" value="" oldval="" />';
        $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestEditRemark').html(guestRemarkInput).css('padding', '0');        
    }
    var guestCardNumberInput = '<input type="text" name="cardNumber" value="'+oldData['cardNumber']+'" oldval="'+oldData['cardNumber']+'" valid="1" validtype="int" />';
    $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestCardNumber').html(guestCardNumberInput).css('padding', '0');
    var guestNameInput = '<input type="text" name="name" value="'+oldData['name']+'" oldval="'+oldData['name']+'" valid="1" validtype="text" />';
    $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestName').html(guestNameInput).css('padding', '0');
    var guestBirthInput = '<input type="text" name="birthday" value="'+oldData['birth']+'" oldval="'+oldData['birth']+'" valid="1" validtype="text" />';
    $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestBirth').html(guestBirthInput).css('padding', '0');
    var guestPhoneInput = '<input type="text" name="phone" value="'+oldData['phone']+'" oldval="'+oldData['phone']+'" valid="1" validtype="text" />';
    $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestPhone').html(guestPhoneInput).css('padding', '0');
    var guestEmailInput = '<input type="text" name="email" value="'+oldData['email']+'" oldval="'+oldData['email']+'" valid="1" validtype="email" />';
    $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestEmail').html(guestEmailInput).css('padding', '0');
    var guestCountryInput = '<input type="text" name="country" value="'+oldData['country']+'" oldval="'+oldData['country']+'" valid="1" validtype="text" />';
    $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestCountry').html(guestCountryInput).css('padding', '0');
    var guestCityInput = '<input type="text" name="city" value="'+oldData['city']+'" oldval="'+oldData['city']+'" valid="1" validtype="text" />';
    $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestDesc').find('.guestCity').html(guestCityInput).css('padding', '0');    
    
    $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestSetup').hide();
    $this.parent('.guestSetup').parent('.guestCardBlock').find('.guestSetupEdit').show();
}

function cancelGuestChanges($this)
{
    var oldData = {
        'cardNumber' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestCardNumber').find('input').attr('oldval'),
        'name' : jQuery.trim($this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestName').find('input').attr('oldval')),
        'birth' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestBirth').find('input').attr('oldval'),
        'phone' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestPhone').find('input').attr('oldval'),
        'email' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestEmail').find('input').attr('oldval'),
        'country' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestCountry').find('input').attr('oldval'),
        'city' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestCity').find('input').attr('oldval')
    };
    
    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestEditRemark').html('').css('padding', '5px 0');
    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestCardNumber').html(oldData['cardNumber']).css('padding', '5px 0');
    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestName').html(oldData['name']).css('padding', '0');
    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestBirth').html(oldData['birth']).css('padding', '0');
    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestPhone').html(oldData['phone']).css('padding', '0');
    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestEmail').html(oldData['email']).css('padding', '0');
    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestCountry').html(oldData['country']).css('padding', '0');
    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestCity').html(oldData['city']).css('padding', '0');   
    
    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestSetup').show();
    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestSetupEdit').hide();    
}

function saveGuestChanges(gId, $this)
{
    var send = true;

    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('input').each(function(i)
    {
        if( $(this).attr('valid') === '1' )
        {
            if( $(this).attr('validtype') === 'int' )
            {
                if ( !$.isNumeric($(this).val()) )
                {
                    $(this).css('border-color', 'red');
                    send = false;
                }
                else
                {
                    $(this).css('border-color', '#dfdfdf');
                }
            }     
            else if( $(this).attr('validtype') === 'email')
            {
                if( $(this).val() != '' )
                {
                    if ( !(/^(?:[a-z0-9]+[-._]?)*[a-z0-9]+\@(?:[a-z0-9]+[-._]?)*[a-z0-9]+\.[a-z]{2,5}$/i).test($(this).val()) )
                    {
                        $(this).css('border-color', 'red');
                        send = false;
                    }      
                    else
                    {
                        $(this).css('border-color', '#dfdfdf');
                    }                
                }
            }
            else
            {
                if ( !(/^[a-zA-Zа-яА-Я0-9.+ _-]{1,200}$/i).test($(this).val()) )
                {
                    $(this).css('border-color', 'red');
                    send = false;
                }     
                else
                {
                    $(this).css('border-color', '#dfdfdf');
                }           
            }
        }
    });     
    
    if(send)
    {
        $.ajax({
            type: "POST",
            data: $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc :input').serializeArray(),
            url: rootPath + "guest/savechanges",
            async: false,
            success: function(resp)
            {
                if(resp === 'ok')
                {
                    var oldData = {
                        'remark' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestEditRemark').find('input').val(),
                        'cardNumber' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestCardNumber').find('input').val(),
                        'name' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestName').find('input').val(),
                        'birth' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestBirth').find('input').val(),
                        'phone' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestPhone').find('input').val(),
                        'email' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestEmail').find('input').val(),
                        'country' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestCountry').find('input').val(),
                        'city' : $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestCity').find('input').val()
                    };

                    if( jQuery.trim(oldData['remark']) != '' )
                    {
                        var remarkTitle = 'Проблема:<img src="icon/active.png" style="cursor: pointer;" title="Устранена" onclick="deleteRemark(\''+gId+'\', \'inside\');"/><div class="clear"></div>';
                        $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestEditRemark').html(oldData['remark']).css('padding', '5px 0').css('color', 'red').addClass('guestRemark');
                        $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestTitleRemark').html(remarkTitle).css('padding', '5px 0').css('color', 'red').addClass('guestRemark');
                    }
                    else
                    {
                        $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestEditRemark').html('').css('padding', '5px 0');
                    }
                    
                    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestCardNumber').html(oldData['cardNumber']).css('padding', '5px 0');
                    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestName').html(oldData['name']).css('padding', '0');
                    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestBirth').html(oldData['birth']).css('padding', '0');
                    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestPhone').html(oldData['phone']).css('padding', '0');
                    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestEmail').html(oldData['email']).css('padding', '0');
                    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestCountry').html(oldData['country']).css('padding', '0');
                    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestDesc').find('.guestCity').html(oldData['city']).css('padding', '0');   

                    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestSetup').show();
                    $this.parent('.guestSetupEdit').parent('.guestCardBlock').find('.guestSetupEdit').hide();  
                    
                    alert('Запись успешно отредактирована!');
                }
                else{
                    alert(resp);
                }
            }
        });  
    }
}

function guestCardClick(gId)
{
    var cpz = $('#gs_'+gId).css('width');
    
    $('.insideBlockG').css('width', '330px');
    $('.insideBlockG').find('.guestInsideQuick').show();
    if( cpz == '330px' )
    {
        $('#gs_'+gId).css('width', '1028px');
        $('#gs_'+gId).find('.guestInsideQuick').hide();
        $('#gs_'+gId).find('.tableChoose').hide();
        $("#gs_"+gId).find('.guestDesc').show();
        $("#gs_"+gId).find('.guestSetup').show();        
    }
    else
    {
        if( $("#gs_"+gId).find('.guestSetupEdit').is(':visible') )
        {
            $("#gs_"+gId).find('.guestSetupEdit').find('.setupButtonCancel').click();
        }
        $('#gs_'+gId).css('width', '330px');
        $('#gs_'+gId).find('.guestInsideQuick').show();
        $("#gs_"+gId).find('.guestDesc').hide();
        $("#gs_"+gId).find('.guestSetup').hide();        
        $('#gs_'+gId).find('.tableChoose').hide();
    }
}

function guestCardClickBday(gId)
{
    var cpz = $('#gb_'+gId).css('width');
    
    $('.insideBlockGB').css('width', '330px');
//    alert($('#gs_'+gId).find('.guestPhotoSmall').css('width'));
    if( cpz == '330px' )
        $('#gb_'+gId).css('width', '790px');
    else
        $('#gb_'+gId).css('width', '330px');
}

function newTable()
{
    var html = '<div class="tableCrBlock tableCreateInput">\n\
                    Стол №:<input type="text" name="title" /><div class="clear"></div>\n\
                </div>\n\
                <div class="tableCrBlock">\n\
                    <div class="createTableButton" onclick="createTable();">Создать</div>\n\
                    <div class="clear"></div>\n\
                </div>\n\
                <div class="tableCrBlock">\n\
                    <div class="cancelTableButton" onclick="cancelCreateTable();">Отмена</div>\n\
                    <div class="clear"></div>\n\
                </div>\n\
                <div class="clear"></div>';
    
    $('.opensTable').html(html);
}

function createTable()
{
    var tableNum = $('.tableCreateInput').find('input').val();
    tableNum = jQuery.trim(tableNum);
    if( tableNum )
    {
        $.ajax({
            type: "POST",
            data: 'table='+tableNum,
            url: rootPath + "guest/createtable",
            async: false,
            success: function(resp)
            {
                if(resp == 'ok')
                {
                    window.location.reload();
                }
                else
                {
                    alert('Ошибка создания стола');
                }
            }
        });      
    }
    else
    {
        alert('Введи номер стола');
    }

}

function cancelCreateTable()
{
    var html = '<div class="findButtonActive" onclick="newTable();">Новый стол</div><div class="clear"></div>';
    $('.opensTable').html(html);
}



function toTableAll()
{
    $.ajax({
        type: "POST",
//        data: 'gId='+gId,
        url: rootPath + "guest/gettableall",
        async: false,
        success: function(resp)
        {
            if(resp)
            {
                $('.forCheckboxBlock').html(resp);
            }
        }
    });     
}

function guestToTable(tId, gId)
{
    $.ajax({
        type: "POST",
        data: 'tId='+tId+'&gId='+gId,
        url: rootPath + "guest/guesttotable",
        async: false,
        success: function(resp)
        {
            if(resp == 'ok')
            {
                window.location.reload();
//                var gImgSrc = $("#gs_"+gId).find('.guestPhoto').find('img').attr('src');
//                var gImg = '<div class="gInTabImg">\n\
//                                <img src="'+gImgSrc+'" style="max-width: 120px; max-height: 120px;" />\n\
//                                <div class="guestInTableSet">\n\
//                                    <img src="icon/replace.png" style="cursor: pointer;" title="Перенос" onclick="getTableForReplace(\''+tId+'\', 0, \''+gId+'\', \'guest\', $(this));"/>\n\
//                                    <img src="icon/view.png" style="cursor: pointer;" title="Детали" onclick="toGuestDet(\''+gId+'\');"/>\n\
//\n\                                 <div class="clear"></div>\n\
//                                </div>\n\
//                            <div class="clear"></div>\n\
//                            </div>';
//                $("#o_"+tId).find('.guestInThisTable').append(gImg);
//                var retHtml = '<div class="setupButtonActive" onclick="editGuest('+gId+');">Редактировать</div>\n\
//                                <div class="clear"></div>\n\
//                                <div class="setupButtonActive" onclick="findGuestActive();">Добавить баллы</div>\n\
//                                <div class="clear"></div>\n\
//                                <div class="setupButtonActive" onclick="findGuestActive();">Списать баллы</div>\n\
//                                <div class="clear"></div>\n\
//                                <div class="setupButtonActive" onclick="findGuestActive();">История баллов</div>\n\
//                                <div class="clear"></div>\n\
//                                <div class="setupButtonActive" onclick="guestOut('+gId+');">Гость ушел</div>\n\
//                                <div class="clear"></div>';
//                $("#gs_"+gId).find('.tableChoose').html(retHtml);
//                
//                $('#gs_'+gId).find('.guestInsideQuick').find('.toTableQuickIcon').hide();
//                guestCardClick(gId);
//                
//                $("#gs_"+gId).addClass('inTableGuestBlock');
            }
            else
            {
                alert(resp);
            }
        }
    });     
}

function guestToTableAll(tableId)
{
    $('.onlyInsideGuests').each(function(i)
    {
        var curVal = $(this).find('.guestInsideQuick').find('input').attr('checked');
        if( curVal == 'checked' )
        {
            var curGuestId = $(this).find('.guestDesc').find('input[name="guestId"]').val();
            guestToTable(tableId, curGuestId);
            window.location.reload();
        }
    });        
}

//function productToTable(tableId, productId)
//{
//    $.ajax({
//        type: "POST",
//        data: 'tableId='+tableId+'&productId='+productId,
//        url: rootPath + "guest/producttotable",
//        async: false,
//        success: function(resp)
//        {
//            if( resp == 'ok' )
//            {
//                window.location.reload();
//            }
//            else
//            {
//                alert(resp);
//            }
//        }
//    });     
//}

function quickChangeAmount(amount, tableId, productId, currentAmount)
{
    amount = amount.replace(',', '.');
    amount = parseFloat(amount);

    var checkAm = amount/0.5;
    
    if( checkAm == parseInt(checkAm) )
    {
        if( amount > 0 )
        {
            $.ajax({
                type: "POST",
                data: 'tableId='+tableId+'&productId='+productId+'&amount='+amount+'&currentAmount='+currentAmount,
                url: rootPath + "guest/changeamount",
                async: false,
                success: function(resp)
                {
                    if( resp == 'ok' )
                    {
                        window.location.reload();
                    }
                    else
                    {
                        alert(resp);
                    }
                }
            });  
        }
        else
        {
            alert('Нельзя <= 0!');
        }
    }
    else
    {
        alert('Можно только кратное 0.5');
    }
}

function dotablesale(code, tableId)
{
    if(!confirm('Подтверди применение скидки!'))
        return;       
    $.ajax({
        type: "POST",
        data: 'tableId='+tableId+'&code='+code,
        url: rootPath + "guest/dotablesale",
        async: false,
        success: function(resp)
        {
            if( resp == 'ok' )
            {
                window.location.reload();
            }
            else
            {
                alert(resp);
            }
        }
    });  
}

function closesTable(tableId)
{
    if(!confirm('Подтверди закрытие стола!'))
        return;    
    $.ajax({
        type: "POST",
        data: 'tableId='+tableId,
        url: rootPath + "guest/closetable",
        async: false,
        success: function(resp)
        {
            if( resp == 'ok' )
            {
                window.location.reload();
            }
            else
            {
                alert(resp);
            }
        }
    });  
}

function deleteGuestProduct(tableId, productId)
{   
    if(!confirm('Подтверди удаление!'))
        return;       
    $.ajax({
        type: "POST",
        data: 'productId='+productId+'&tableId='+tableId,
        url: rootPath + "guest/deletetableproduct",
        async: false,
        success: function(resp)
        {
            if( resp == 'ok' )
            {
                window.location.reload();
            }
            else
            {
                alert(resp);
                window.location.reload();
            }
        }
    });  
}

function getTableForReplace(tableId, productId, guestId, type, $this, amount)
{
    $.ajax({
        type: "POST",
        data: 'productId='+productId+'&tableId='+tableId+'&guestId='+guestId+'&type='+type+'&amount='+amount,
        url: rootPath + "guest/gettableforreplace",
        async: false,
        success: function(resp)
        {
            if( type == 'product' )
            {
                $this.parent('td').html(resp);
            }
            else
            {
                $this.parent('.guestInTableSet').parent('.gInTabImg').css('width', '213px');
                $this.parent('.guestInTableSet').css('width', '93px');
                $this.parent('.guestInTableSet').html(resp);
            }
        }
    });    
}

function productToTableReplace(tableId, oldTableId, productId)
{
    if(!confirm('Подтверди перенос позиции!'))
        return;    
    
    var newAmount = $('#atr_'+oldTableId+'_'+productId).val();
    
    $.ajax({
        type: "POST",
        data: 'oldTableId='+oldTableId+'&tableId='+tableId+'&productId='+productId+'&amount='+newAmount,
        url: rootPath + "guest/replaceproduct",
        async: false,
        success: function(resp)
        {
            if( resp == 'ok' )
            {
                window.location.reload();
            }
            else
            {
                alert(resp);
            }
        }
    });  
}

function guestToTableReplace(tableId, oldTableId, guestId)
{
    if(!confirm('Подтверди перенос гостя!'))
        return;    
    $.ajax({
        type: "POST",
        data: 'oldTableId='+oldTableId+'&tableId='+tableId+'&guestId='+guestId,
        url: rootPath + "guest/replaceguest",
        async: false,
        success: function(resp)
        {
            if( resp == 'ok' )
            {
                window.location.reload();
            }
            else
            {
                alert(resp);
            }
        }
    });  
}

function showQuickAdd()
{
    if( $(".quickAddGuest").is(":visible") )
    {
        $('.quickAddGuest').hide();
    }
    else
    {
        $('.quickAddGuest').show();
    }
}

function quickAdd()
{
    var cardNumber = $('.quickAddGuest').find('form').find('input[name="cardNumber"]').val();
    var send = true;
    
    if( !parseInt(cardNumber) )
    {
        alert('Можно только цифры!');
        send = false;
    }
    
    if( !jQuery.trim(cardNumber) )
    {
        alert('Введи номер карты!');
        send = false;
    }    
    
    if( send )
    {
        $.ajax({
            type: "POST",
            data: 'cardNumber='+cardNumber,
            url: rootPath + "guest/cardcheck",
            async: false,
            success: function(resp)
            {
                if( resp == 'ok' ){
                    $('.quickAddGuest').find('form').submit();
                }
                else{
                    alert(resp);
                }
            }
        });    
    }
}

function getCheck(tableId)
{
    if(!confirm('Подтверди распечатку чека!'))
        return;       
    window.open(rootPath + "guest/printcheck/id/"+tableId, 'Счет', "width=550,height=500");
    window.location.reload();
}

function cancelCheck(tableId)
{
    if(!confirm('Подтверди отмену предчека!'))
        return;    
        
    $.ajax({
        type: "POST",
        data: 'tableId='+tableId,
        url: rootPath + "guest/cancelcheck",
        async: false,
        success: function(resp)
        {
            if( resp == 'ok' ){
                window.location.reload();
            }
            else{
                alert(resp);
            }
        }
    });    
}

function loungeclose()
{
    if(!confirm('Подтверди закрытие смены!'))
        return;    
    
    $.ajax({
        type: "POST",
        url: rootPath + "guest/checkemptyguest",
        async: false,
        success: function(resp)
        {
            if( resp == 'ok' )
            {
                window.open(rootPath + "guest/loungeclose/", 'Балланс', "width=550,height=500");
                window.location.reload();                
            }
            else
            {
                if( resp == 'guest' )
                {
                    alert('Заполни анкеты "бысродобавленных" гостей!');
                    location.href=rootPath+'guest/list/sort/empty';
                }
                if( resp == 'table' )
                {
                    alert('Не все столы закрыты');
                }                
            }
        }
    });      
}

function toGuestDet(gId)
{
    guestCardClick(gId);
    var destination = $('#gs_'+gId).offset().top;
    $("html:not(:animated),body:not(:animated)").animate({scrollTop: destination}, 1100);
    return false;        
}

function editGuestQuick(gId)
{
    guestCardClick(gId);
    editGuest(gId);
}

function toTable(gId)
{
    $.ajax({
        type: "POST",
        data: 'gId='+gId,
        url: rootPath + "guest/gettable",
        async: false,
        success: function(resp)
        {
            if(resp)
            {
                $("#gs_"+gId).find('.guestDesc').hide();
                $("#gs_"+gId).find('.guestSetup').hide();
                $("#gs_"+gId).find('.guestSetupEdit').hide();
                $('#gs_'+gId).css('width', '365px');
                $('#gs_'+gId).find('.guestInsideQuick').hide();                
                $("#gs_"+gId).find('.tableChoose').show();
                $("#gs_"+gId).find('.tableChoose').html(resp);
            }
        }
    });     
}

function addPoints(gId)
{
    alert('В разработке!');
}

function deletePoints(gId)
{
    alert('В разработке!');
}

function pointsHistory(gId, $this)
{
    alert('В разработке!');
}

function checkboxClick()
{
    if( !$(".afterChekbox").is(":visible") )
    {
        $('.afterChekbox').show();
    }
}

function guestsOut()
{
    $('.onlyInsideGuests').each(function(i)
    {
        var curVal = $(this).find('.guestInsideQuick').find('input').attr('checked');
        if( curVal == 'checked' )
        {
            var curGuestId = $(this).find('.guestDesc').find('input[name="guestId"]').val();
            guestOut(curGuestId);
        }
    });      
}

function getGuestPoints(tableId, totalPrice)
{
    $.ajax({
        type: "POST",
        data: 'tableId='+tableId+'&totalPrice='+totalPrice,
        url: rootPath + "guest/gettableguestpoints",
        async: false,
        success: function(resp)
        {
            $('#tpl_'+tableId).html(resp);
        }
    });     
}

function getBDGuest(tableId)
{
    $.ajax({
        type: "POST",
        data: 'tableId='+tableId,
        url: rootPath + "guest/gettablebdguest",
        async: false,
        success: function(resp)
        {
            $('#tbl_'+tableId).html(resp);
        }
    });     
}

function doBDHookah(tableId, guestId)
{
    if(!confirm('Подтверди пробитие кальяна ДР!'))
        return; 
    
    $.ajax({
        type: "POST",
        data: 'tableId='+tableId+'&guestId='+guestId,
        url: rootPath + "guest/dobdhookah",
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

function doGuestPoints(tableId)
{
    if(!confirm('Подтверди списание баллов!'))
        return;    
    
    var send = true;
    
    var totalPrice = parseInt($('#tpl_'+tableId).find('input[name="totalPrice"]').attr('value'));
    var totalPonitsSale = 0;
    
    $('#tpl_'+tableId).find('.guestPointInp').each(function(i)
    {
        var curVal = parseInt($(this).attr('value'));
        var oldVal = parseInt($(this).attr('oldval'));
        
        if( curVal < 0 )
        {
            alert('Нельзя < 0');
            $(this).css('background-color', 'red');
            send = false;
        }
        else if( curVal > oldVal )
        {
            alert('Нельзя списать боьльше, чем есть');
            $(this).css('background-color', 'red');
            send = false;            
        }        
        else
        {
            $(this).css('background-color', 'white');
            totalPonitsSale += curVal;
        }
    });      
    
    if( totalPonitsSale > totalPrice )
    {
        send = false;
        $('.guestPointInp').css('background-color', 'red');
        alert('Списаных баллов больше, чем счет!');
    }
    
    if (send)
    {
        $.ajax({
            type: "POST",
            data: $('#tpl_'+tableId+' :input').serializeArray(),
            url: rootPath + "guest/doguestpoints",
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

function cancelGuestPoints(tableId)
{
    $('#tpl_'+tableId).html('');
}

function deleteRemark(guestId, type)
{
    if(!confirm('Подтверди устранение проблемы!'))
        return;    
    
    $.ajax({
        type: "POST",
        data: 'guestId='+guestId,
        url: rootPath + "guest/deleteremark",
        async: false,
        success: function(resp)
        {
            if( resp == 'ok' )
            {
                if( type == 'search' )
                {
                    $('#g_'+guestId).find('.guestRemark').remove();
                }
                else
                {
                    $('#gs_'+guestId).find('.guestRemark').remove();
                }
            }
            else
            {
                alert(resp);
            }
        }
    });     
}

function tableRemark(tableId)
{
    $('#o_'+tableId).find('.tableRemarkInp').show();
    $('#o_'+tableId).find('.tableRemark').hide();
}

function cancelTableRemark(tableId)
{
    $('#o_'+tableId).find('.tableRemarkInp').hide();
    $('#o_'+tableId).find('.tableRemark').show();
}

function saveTableRemark(tableId)
{
    var inpVal = $('#o_'+tableId).find('.tableRemarkInp').find('input').val();
    
    $.ajax({
        type: "POST",
        data: 'tableId='+tableId+'&remark='+inpVal,
        url: rootPath + "guest/addtableremark",
        async: false,
        success: function(resp)
        {
            if( resp == 'ok' )
            {
                window.location.reload();
            }
            else
            {
                alert(resp);
            }
        }
    });     
}

function productToPrevTable(productId, title, price, tableId)
{
    var isPrevTable = $('#prevOrder_'+tableId).attr('isset');
    if( isPrevTable == '1' ) // если уже создана таблице предзаказа
    {
        var sameTr = $('#prevOrder_'+tableId).find('table').find('tbody').find('#prevTr_'+productId);
        if( sameTr.length == 0 )
        {
            var addHtml = '<tr id="prevTr_'+productId+'" class="prevProductTr"><td>'+title+'</td>\n\
                                <td class="prevAmount"><input type="text" name="amount" value="1" oldval="1" onblur="prevChangeAmount(\''+productId+'\', \''+tableId+'\');"/>\n\
                                    <input type="hidden" name="productId" value="'+productId+'"/></td>\n\
                                <td class="prevPrice">'+price+'</td>\n\
                                <td><img src="icon/101.png" style="cursor: pointer;" title="Удалить" onclick="deletePrevProduct(\''+productId+'\', \''+tableId+'\');"/></td>\n\
                            </tr>';
            $('#prevOrder_'+tableId).find('table').find('tbody').append(addHtml);
        }
        else
        {
            var oldAmount = $('#prevOrder_'+tableId).find('table').find('tbody').find('#prevTr_'+productId).find('.prevAmount').find('input[name="amount"]').val();
            oldAmount = oldAmount.replace(',', '.');
            oldAmount = parseFloat(oldAmount);
    
            var newAmount = oldAmount + 1;
    
            $('#prevOrder_'+tableId).find('table').find('tbody').find('#prevTr_'+productId).find('.prevAmount').find('input[name="amount"]').val(newAmount);
            $('#prevOrder_'+tableId).find('table').find('tbody').find('#prevTr_'+productId).find('.prevAmount').find('input[name="amount"]').attr('oldval', newAmount);
        }
        recalcPrev(tableId);
    }
    else
    {
        var html = '<div class="prevTitle">Предзаказ</div><div class="clear"></div>\n\
                    <table class="tableProductTable"><thead>\n\
                    <tr><td>Наименование</td>\n\
                        <td>Кол-ство</td>\n\
                        <td>Цена</td>\n\
                        <td>Уд.</td>\n\
                    </tr></thead><tbody>';
        html += '<tr id="prevTr_'+productId+'" class="prevProductTr"><td>'+title+'</td>\n\
                        <td class="prevAmount"><input type="text" name="amount" value="1" oldval="1" onblur="prevChangeAmount(\''+productId+'\', \''+tableId+'\');"/>\n\
                            <input type="hidden" name="productId" value="'+productId+'"/></td>\n\
                        <td class="prevPrice">'+price+'</td>\n\
                        <td><img src="icon/101.png" style="cursor: pointer;" title="Удалить" onclick="deletePrevProduct(\''+productId+'\', \''+tableId+'\');"/></td>\n\
                </tr>';
        html += '</tbody></table><div class="clear"></div>';
//        html += '<div class="tableTotalPrice"><b>Итого:</b> 0 руб.<div class="clear"></div></div><div class="clear"></div>';
    
        html += '<div class="prevOrderSubmit" onclick="prevOrderSumbit('+tableId+');">Подтвердить заказ</div><div class="clear"></div>';
            
        $('#prevOrder_'+tableId).html(html);
        $('#prevOrder_'+tableId).attr('isset', 1);
        recalcPrev(tableId);
    }
}

function prevChangeAmount(productId, tableId)
{
    var newAmount = $('#prevOrder_'+tableId).find('table').find('tbody').find('#prevTr_'+productId).find('.prevAmount').find('input[name="amount"]').val();
    newAmount = newAmount.replace(',', '.');
    newAmount = parseFloat(newAmount);

    var checkAm = newAmount/0.5;
    
    var oldAmount = $('#prevOrder_'+tableId).find('table').find('tbody').find('#prevTr_'+productId).find('.prevAmount').find('input[name="amount"]').attr('oldval');

    if( checkAm == parseInt(checkAm) )
    {
        if( newAmount > 0 )
        {
            $('#prevOrder_'+tableId).find('table').find('tbody').find('#prevTr_'+productId).find('.prevAmount').find('input[name="amount"]').val(newAmount);
            $('#prevOrder_'+tableId).find('table').find('tbody').find('#prevTr_'+productId).find('.prevAmount').find('input[name="amount"]').attr('oldval', newAmount);
            recalcPrev(tableId);
        }
        else
        {
            alert('Нельзя <= 0!');
            $('#prevOrder_'+tableId).find('table').find('tbody').find('#prevTr_'+productId).find('.prevAmount').find('input[name="amount"]').val(oldAmount);
            
        }
    }
    else
    {
        alert('Можно только кратное 0.5');
        $('#prevOrder_'+tableId).find('table').find('tbody').find('#prevTr_'+productId).find('.prevAmount').find('input[name="amount"]').val(oldAmount);
    }
}

function deletePrevProduct(productId, tableId)
{
    $('#prevOrder_'+tableId).find('table').find('tbody').find('#prevTr_'+productId).remove();
    if( !$('#prevOrder_'+tableId).find('table').find('tbody').html() )
    {
        $('#prevOrder_'+tableId).html('');
        $('#prevOrder_'+tableId).attr('isset', 0);
    }
    recalcPrev(tableId);
}

function recalcPrev(tableId)
{
    return true;
    var orderPrice = 0;
    $('#prevOrder_'+tableId).find('table').find('tbody').find('tr').each(function(i)
    {
        var curPrice = parseInt($(this).find('.prevPrice').html());
        var curAmount = parseFloat($(this).find('.prevAmount').find('input[name="amount"]').val());
        var newTotalPrice = curAmount*curPrice;
        $(this).find('.prevTotalPrice').html(newTotalPrice);     
        
        orderPrice += newTotalPrice;
    });    
    
    var orderPriceHtml = '<b>Итого к добавлению:</b> '+orderPrice+' руб.<div class="clear"></div>';
    $('#prevOrder_'+tableId).find('.tableTotalPrice').html(orderPriceHtml);
}

function prevOrderSumbit(tableId)
{
    if(!confirm('Подтверди заказ!'))
        return;    
    
    var orderData = {
        'guestTableId': tableId,
        'products': {}
    };
    
    $('#prevOrder_'+tableId).find('table').find('tbody').find('tr').each(function(i)
    {
        var curAmount = parseFloat($(this).find('.prevAmount').find('input[name="amount"]').val());
        var curId = parseInt($(this).find('.prevAmount').find('input[name="productId"]').val());
        
        orderData.products[curId] = curAmount;
    });     
    
    var orderDataJSON = $.toJSON(orderData);
    $.ajax({
        type: "POST",
        data: 'data='+orderDataJSON,
        url: rootPath + "guest/productstotable",
        async: false,
        success: function(resp)
        {
            if( resp == 'ok' )
            {
                window.location.reload();
            }
            else
            {
                alert(resp);
            }
        }
    });        
}

function showReportDet(type)
{
    $('.dayReportBlock').hide();
    $('.dayReportButton').removeClass('activeReport');
    $('.tableReport_'+type).show();
    $('.report_'+type).addClass('activeReport');
}

function tableTitleChange(tableId)
{
    $('#o_'+tableId).find('.numberOfTables').hide();
    $('#o_'+tableId).find('.numberOfTablesEdit').hide();
    $('#o_'+tableId).find('.tableTitleInp').show();
}

function cancelTableTitle(tableId)
{
    $('#o_'+tableId).find('.numberOfTables').show();
    $('#o_'+tableId).find('.numberOfTablesEdit').show();
    $('#o_'+tableId).find('.tableTitleInp').hide();
}

function saveTableTitle(tableId)
{
    var inpVal = $('#o_'+tableId).find('.tableTitleInp').find('input').val();
    
    $.ajax({
        type: "POST",
        data: 'tableId='+tableId+'&title='+inpVal,
        url: rootPath + "guest/changetabletitle",
        async: false,
        success: function(resp)
        {
            if( resp == 'ok' )
            {
                window.location.reload();
            }
            else
            {
                alert(resp);
            }
        }
    });     
}

function changeAmountToReplaceValid(tableId, productId)
{
    var newAmount = $('#atr_'+tableId+'_'+productId).val();
    newAmount = newAmount.replace(',', '.');
    newAmount = parseFloat(newAmount);

    var checkAm = newAmount/0.5;
    
    var oldAmount = $('#atr_'+tableId+'_'+productId).attr('oldval');
    oldAmount = parseFloat(oldAmount);
    
    if( checkAm == parseInt(checkAm) )
    {
        if( newAmount > 0 )
        {
            if( newAmount > oldAmount )
            {
                alert('Нельзя больше, чем было!');
                $('#atr_'+tableId+'_'+productId).val(oldAmount);                
            }
            else
            {
                $('#atr_'+tableId+'_'+productId).val(newAmount);
                $('#atr_'+tableId+'_'+productId).attr('oldval', newAmount);
            }            
        }
        else
        {
            alert('Нельзя <= 0!');
            $('#atr_'+tableId+'_'+productId).val(oldAmount);
            
        }
    }
    else
    {
        alert('Можно только кратное 0.5');
        $('#atr_'+tableId+'_'+productId).val(oldAmount);
    }
}