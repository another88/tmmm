$(document).ready(function()
{
    $('.imageFancy').fancybox({
                margin:0,
                padding:0,
                cyclic:true
    });      
});

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