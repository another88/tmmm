$(document).ready(function()
{});

function openModalTestimonial()
{
    $.popup('testimonial', 715, 0);
    window.scroll(0,0);
}

function popupEnterTestimonial(e, $this)
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

function testimonialSend()
{
    var send = true;
    var errorText = '';
    $('#testimonial_message').html('');    
    
    var commentText = $('.testimonialTextarea').val();
    
    var checkInp = $('#testimonialForm').find('input[name="phoneNumber"]').val();
    if( empty(checkInp) )
    {    
        if ( (/(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?/).test(commentText) )
        {
            if ( (/234532198/).test(commentText) || (/ace-hookah.com/).test(commentText) )
            {
                send = true;
            }
            else
            {
                send = false;
                $('.testimonialTextarea').css('background-color', 'red');
                var currentErrorText = 'В отзыве нельзя использовать ссылки на стороние ресурсы.';
                if( errorText !== '' )
                    errorText += '<br/>'+currentErrorText;
                else
                    errorText += currentErrorText;              
            }
        }    

        $('#testimonialForm input:visible').each(function(i,v)
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

        if( commentText == '' || $.trim(commentText) == '' )
        {
            send = false;
            $('.testimonialTextarea').css('background-color', 'red');
            var currentErrorText = $('.testimonialTextarea').attr('errortext');
            if( errorText !== '' )
                errorText += '<br/>'+currentErrorText;
            else
                errorText += currentErrorText;      
        } 
        else 
        {
            $('.testimonialTextarea').css('background-color', 'white');
        }    

        if( send )
        {    
            $('#testimonialForm').submit();     
        }
        else
        {
            $('#testimonial_message').addClass('error').removeClass('done').html(errorText);
        }
    }
}