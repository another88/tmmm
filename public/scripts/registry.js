$(document).ready(function()
{});

function registry()
{
    var send = true;
    
    var checkInp = $('.registryText').find('input[name="phoneNumber"]').val();
    if( empty(checkInp) )
    {        
        $('.registryText input:visible').each(function(i,v)
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
                data: $('.registryText :input').serializeArray(),
                url: rootPath + "user/registry",
                async: false,
                success: function(resp)
                {
                    if(resp === 'ok')
                    {
    //                    ga('send', 'event', 'reg', 'regadd');
                        $('#registry_message').removeClass('error').addClass('done').html('Вы успешно зарегистрировались. Добро Пожаловать!'); 
                        setTimeout('window.location.href = "http://ace-hookah.com"', 1500);   
                    }
                    else{
                        $('#registry_message').addClass('error').removeClass('done').html(resp); 
                    }
                }
            });
        }
    }
}