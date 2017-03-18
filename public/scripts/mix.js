$(document).ready(function()
{
    if( mid !== 0 )
    {
        $.popup('current_mix', 485);
        window.scroll(0,0);        
        
        drawDiagram('popup');

        (function($){$(function(){$('div.share42initVert').each(function(idx){var el=$(this),u=el.attr('data-url'),t=el.attr('data-title'),i=el.attr('data-image'),d=el.attr('data-description'),f=el.attr('data-path'),fn=el.attr('data-icons-file'),z=el.attr("data-zero-counter"),m1=el.attr('data-top1'),m2=el.attr('data-top2')*1,m3=el.attr('data-margin');if(!u)u=location.href;if(!fn)fn='icons.png';if(!z)z=0;if(!f){function path(name){var sc=document.getElementsByTagName('script'),sr=new RegExp('^(.*/|)('+name+')([#?]|$)');for(var p=0,scL=sc.length;p<scL;p++){var m=String(sc[p].src).match(sr);if(m){if(m[1].match(/^((https?|file)\:\/{2,}|\w:[\/\\])/))return m[1];if(m[1].indexOf("/")==0)return m[1];b=document.getElementsByTagName('base');if(b[0]&&b[0].href)return b[0].href+m[1];else return document.location.pathname.match(/(.*[\/\\])/)[0]+m[1];}}return null;}f=path('share42_vert.js');}if(!t)t=document.title;if(!d){var meta=$('meta[name="description"]').attr('content');if(meta!==undefined)d=meta;else d='';}if(!m1)m1=150;if(!m2)m2=20;if(!m3)m3=0;u=encodeURIComponent(u);t=encodeURIComponent(t);t=t.replace(/\'/g,'%27');i=encodeURIComponent(i);d=encodeURIComponent(d);d=d.replace(/\'/g,'%27');var fbQuery='u='+u;if(i!='null'&&i!='')fbQuery='s=100&p[url]='+u+'&p[title]='+t+'&p[summary]='+d+'&p[images][0]='+i;var vkImage='';if(i!='null'&&i!='')vkImage='&image='+i;var s=new Array(
                    '"#" data-count="vk" onmouseover="hoverSocialImage($(this));" onmouseout="outSocialImage($(this));" onclick="window.open(\'http://vk.com/share.php?url='+u+'&title='+t+vkImage+'&description='+d+'\', \'_blank\', \'scrollbars=0, resizable=1, menubar=0, left=100, top=100, width=550, height=440, toolbar=0, status=0\');return false" title="Поделиться В Контакте"',
                    '"#" data-count="fb" onmouseover="hoverSocialImage($(this));" onmouseout="outSocialImage($(this));" onclick="window.open(\'http://www.facebook.com/sharer.php?m2w&'+fbQuery+'\', \'_blank\', \'scrollbars=0, resizable=1, menubar=0, left=100, top=100, width=550, height=440, toolbar=0, status=0\');return false" title="Поделиться в Facebook"',
                    '"#" data-count="twi" onmouseover="hoverSocialImage($(this));" onmouseout="outSocialImage($(this));" onclick="window.open(\'https://twitter.com/intent/tweet?text='+t+'&url='+u+'\', \'_blank\', \'scrollbars=0, resizable=1, menubar=0, left=100, top=100, width=550, height=440, toolbar=0, status=0\');return false" title="Добавить в Twitter"');
                var l='';for(j=0;j<s.length;j++){var s42s='';l+='<span class="share42-item-hover" style="display:block;white-space:no-wrap;margin:0 0 18px 0;height:32px;"><a rel="nofollow" style="display:inline-block;vertical-align:top;width:32px;height:32px;margin:0;padding:0;outline:none;background:url('+'http://ace-hookah.com/share42/'+fn+') -'+32*j+'px 0 no-repeat" href='+s[j]+' target="_blank"></a></span>'+s42s;};el.html('<span id="share42_vert" style="z-index:9999;margin-left:'+m3+'px">'+l+'</span>'+'');var p=$('#share42_vert');function m(){var top=$(window).scrollTop();if(top+m2<m1){p.css({top:m1-top});}else{p.css({top:m2});}}m();$(window).scroll(function(){m();})});})})(jQuery);           
    }
});

function selectTabacCategory(id)
{
    $('.tabacCategoryList').hide();
    if(id)
    {
        $('#tabacCategory_'+id).show();      
    }
}

function selectTabacCategorySearch(id)
{
    $('.tabacCategoryListSearch').hide();
    if(id)
    {
        $('#tabacCategorySearch_'+id).show();      
    }
}

function selectTabac(tabacId, tabacTitle, categoryId, categoryTitle)
{
    var html = '';
    html += '<div class="createTabacSelected tabacSelected_'+tabacId+'_'+categoryId+'">\n\
                <div class="createMixInputTitle" onclick="deleteTabac('+tabacId+', '+categoryId+');">'+categoryTitle+' - '+tabacTitle+', %</div>\n\
                <input type="text" name="tabac_'+tabacId+'_'+categoryId+'" class="mixPercentInp" value="0"/>\n\
                <div class="createDeleteTabac" onclick="deleteTabac('+tabacId+', '+categoryId+');"></div>\n\
                <div class="clr"></div>\n\
            </div>\n\
            <div class="clr"></div>';
    $('.tabacSelected').append(html);
    $('#tabac_'+tabacId+'_'+categoryId).fadeOut();
}

function selectTabacSearch(tabacId, tabacTitle, categoryId, categoryTitle)
{
    var html = '';
    html += '<div class="tabacSelectedSearchBlock tabacSelectedSearch_'+tabacId+'_'+categoryId+'"\n\
                    onclick="deleteTabacSearch('+tabacId+', '+categoryId+');">\n\
                <input type="hidden" name="selectedTabacList[]" value="'+tabacId+'" />\n\
                '+categoryTitle+'-'+tabacTitle+'<div class="clr"></div></div>';
    $('.tabacSelectedSearch').append(html);
    $('#tabacSearch_'+tabacId+'_'+categoryId).fadeOut();
}

function deleteTabac(tabacId, categoryId)
{
    $('#tabac_'+tabacId+'_'+categoryId).fadeIn();
    $('.tabacSelected_'+tabacId+'_'+categoryId).remove();
}

function deleteTabacSearch(tabacId, categoryId)
{
    $('#tabacSearch_'+tabacId+'_'+categoryId).fadeIn();
    $('.tabacSelectedSearch_'+tabacId+'_'+categoryId).remove();
}

function saveMix()
{
    var checkInp = $('#popup_mix').find('.popupContent').find('.mixInputField').find('input[name="phoneNumber"]').val();
    if( empty(checkInp) )
    {    
        $.ajax({
            type: "POST",
            data: $('#popup_mix :input').serializeArray(),
            url: rootPath + "mix/addmix",
            async: false,
            success: function(resp)
            {
                if(resp === 'ok')
                {
                    $('#mix_message').css('color', 'green').html('Ваш микс успешно сохранен.');
                    setTimeout('window.location.reload()', 1000);   
                }
                else{
                    $('#mix_message').html(resp);
                }
            }
        });    
    }
}

function searchMix()
{
    $.ajax({
        type: "POST",
        data: $('.mixMain :input').serializeArray(),
        url: rootPath + "mix/searchmix",
        async: false,
        success: function(resp)
        {
            if( resp == 'Выбирите вкусы табаков для поиска' )
            {
                $('#mixSearchResultError').html(resp);
                $('#mixSearchResultError').show();   
                $('#mixSearchResult').hide();
            }
            else
            {
                $('#mixSearchResultError').hide();  
                $('#mixSearchResult').html(resp);
                $('#mixSearchResult').show();
                scrollTo('mixSearchResult');
                drawDiagram('norm');
                
                (function($){$(function(){$('div.share42initVert').each(function(idx){var el=$(this),u=el.attr('data-url'),t=el.attr('data-title'),i=el.attr('data-image'),d=el.attr('data-description'),f=el.attr('data-path'),fn=el.attr('data-icons-file'),z=el.attr("data-zero-counter"),m1=el.attr('data-top1'),m2=el.attr('data-top2')*1,m3=el.attr('data-margin');if(!u)u=location.href;if(!fn)fn='icons.png';if(!z)z=0;if(!f){function path(name){var sc=document.getElementsByTagName('script'),sr=new RegExp('^(.*/|)('+name+')([#?]|$)');for(var p=0,scL=sc.length;p<scL;p++){var m=String(sc[p].src).match(sr);if(m){if(m[1].match(/^((https?|file)\:\/{2,}|\w:[\/\\])/))return m[1];if(m[1].indexOf("/")==0)return m[1];b=document.getElementsByTagName('base');if(b[0]&&b[0].href)return b[0].href+m[1];else return document.location.pathname.match(/(.*[\/\\])/)[0]+m[1];}}return null;}f=path('share42_vert.js');}if(!t)t=document.title;if(!d){var meta=$('meta[name="description"]').attr('content');if(meta!==undefined)d=meta;else d='';}if(!m1)m1=150;if(!m2)m2=20;if(!m3)m3=0;u=encodeURIComponent(u);t=encodeURIComponent(t);t=t.replace(/\'/g,'%27');i=encodeURIComponent(i);d=encodeURIComponent(d);d=d.replace(/\'/g,'%27');var fbQuery='u='+u;if(i!='null'&&i!='')fbQuery='s=100&p[url]='+u+'&p[title]='+t+'&p[summary]='+d+'&p[images][0]='+i;var vkImage='';if(i!='null'&&i!='')vkImage='&image='+i;var s=new Array(
                            '"#" data-count="vk" onmouseover="hoverSocialImage($(this));" onmouseout="outSocialImage($(this));" onclick="window.open(\'http://vk.com/share.php?url='+u+'&title='+t+vkImage+'&description='+d+'\', \'_blank\', \'scrollbars=0, resizable=1, menubar=0, left=100, top=100, width=550, height=440, toolbar=0, status=0\');return false" title="Поделиться В Контакте"',
                            '"#" data-count="fb" onmouseover="hoverSocialImage($(this));" onmouseout="outSocialImage($(this));" onclick="window.open(\'http://www.facebook.com/sharer.php?m2w&'+fbQuery+'\', \'_blank\', \'scrollbars=0, resizable=1, menubar=0, left=100, top=100, width=550, height=440, toolbar=0, status=0\');return false" title="Поделиться в Facebook"',
                            '"#" data-count="twi" onmouseover="hoverSocialImage($(this));" onmouseout="outSocialImage($(this));" onclick="window.open(\'https://twitter.com/intent/tweet?text='+t+'&url='+u+'\', \'_blank\', \'scrollbars=0, resizable=1, menubar=0, left=100, top=100, width=550, height=440, toolbar=0, status=0\');return false" title="Добавить в Twitter"');
                        var l='';for(j=0;j<s.length;j++){var s42s='';l+='<span class="share42-item-hover" style="display:block;white-space:no-wrap;margin:0 0 18px 0;height:32px;"><a rel="nofollow" style="display:inline-block;vertical-align:top;width:32px;height:32px;margin:0;padding:0;outline:none;background:url('+'http://ace-hookah.com/share42/'+fn+') -'+32*j+'px 0 no-repeat" href='+s[j]+' target="_blank"></a></span>'+s42s;};el.html('<span id="share42_vert" style="z-index:9999;margin-left:'+m3+'px">'+l+'</span>'+'');var p=$('#share42_vert');function m(){var top=$(window).scrollTop();if(top+m2<m1){p.css({top:m1-top});}else{p.css({top:m2});}}m();$(window).scroll(function(){m();})});})})(jQuery);                
            }
        }
    });       
}

function hoverSocialImage($this)
{
    $this.css('background-image', 'url(share42/icons_hover.png)');
}

function outSocialImage($this)
{
    $this.css('background-image', 'url(share42/icons.png)');
}

function drawDiagram(type)
{
    var options = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke : true,
        //String - The colour of each segment stroke
        segmentStrokeColor : "#000",
        //Number - The width of each segment stroke
        segmentStrokeWidth : 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout : 40, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps : 100,
        //String - Animation easing effect
        animationEasing : "easeOutBounce",
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate : true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale : false
    };
    
    if( type === 'popup' )
    {
        var mixId = $('#popup_current_mix').find('input[name="pop_mixId"]').val();
        var diaData = $.parseJSON($('#popup_current_mix').find('input[name="pop_diaData"]').val());
        $.each(diaData, function(i,val)
        {
            if( val.color == '' )
                val.color = '#ef9a20';
            else
                val.color = '#'+val.color;
        });          
        var ctx = document.getElementById("pop_dia_"+mixId).getContext("2d");
        window.myPie = new Chart(ctx).Doughnut(diaData,options);           
    }
    else
    {
        $('#popup_current_mix').html('');
        $('.diagramBlock').each(function(i,elem) 
        {
            var mixId = $(this).find('input[name="mixId"]').val();
            var diaData = $.parseJSON($(this).find('input[name="diaData"]').val());
            $.each(diaData, function(i,val)
            {
                if( val.color == '' )
                    val.color = '#ef9a20';
                else
                    val.color = '#'+val.color;
            });          
            var ctx = document.getElementById("dia_"+mixId).getContext("2d");
            window.myPie = new Chart(ctx).Doughnut(diaData,options);        
        });   
    }
}

function addMixModal()
{
    $.popup('mix', 440, 0);
    window.scroll(0,0);
}

function saveImg(mixId)
{
    html2canvas($('#mix_'+mixId), 
    {
        onrendered: function(canvas) 
        {
            var img = canvas.toDataURL();
            $.ajax({
                type: "POST",
                data: 'img='+img+'&mixId='+mixId,
                url: rootPath + "mix/saveimg",
                async: false,
                success: function(resp)
                {
                    if( resp === 'ok' )
                    {
                        window.open(rootPath + 'mix/takeimg/id/'+mixId,'Сохранение микса','width=300,height=300');
                    }
                    else
                    {
                        alert(resp);
                    }
                }
            });                        
        }
    });       
}