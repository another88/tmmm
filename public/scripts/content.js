$(document).ready(function()
{
    if( loadMap )
    {
        mapLoad();
    }        
});

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

function addFeedback()
{
    var send = true;
    var checkInp = $('#feedback').find('.feedBackInner').find('input[name="phoneNumber"]').val();
    if( empty(checkInp) )
    {    
        $('#feedback input:visible, #feedback textarea').each(function(i,v)
        {
            var jQ = $(v);

            if ( jQ.attr('valid') && !validate(jQ.val(), jQ.attr('content-type')) )
            {
                send = false;
                jQ.css('background-color', 'red');
                $('#feedback_message').html('');
    //            $('#comment_message').addClass('error').removeClass('done').html('Поля, отмеченные звездочкой, обязательны для заполнения.');
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
                        $('.feedbackButton').hide();
                        $('#feedback_message').removeClass('error').addClass('done').css('width', '230px').html('Ваше сообщение успешно отправленно! Спасибо!');  
                        setTimeout('window.location.reload()', 1500);   
                    }
                    else{
                        $('#feedback_message').addClass('error').removeClass('done').html(resp);  
                    }
                }
            });
        }   
    }
}