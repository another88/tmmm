$(document).ready(function()
{});

function exclusiveSend()
{
    var send = true;
    
    var checkInp = $('#exclForm').find('input[name="phoneNumber"]').val();
    if( empty(checkInp) )
    {    
        $('#exclForm input:visible').each(function(i,v)
        {
            var jQ = $(v);

            if ( jQ.attr('valid') && !validate(jQ.val(), jQ.attr('content-type')) )
            {
                send = false;
                jQ.css('background-color', 'red');
                $('#excl_message').html('');
                $('#excl_message').addClass('error').removeClass('done').html('Поля, отмеченные звездочкой, обязательны для заполнения.');
            } else {
                jQ.css('background-color', 'white');
            }        
        });

        if( send )
        {    
            $('#exclForm').submit();     
        }
    }
}