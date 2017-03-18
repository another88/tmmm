$(document).ready(function()
{
    drawDiagram();
    
    $('.diagramBlock').each(function(i,elem) 
    {
        var mixId = $(this).find('input[name="mixId"]').val();
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
                            setTimeout('window.location.reload()', 500);  
                        }
                        else
                        {
                            alert(resp);
                        }
                    }
                });                        
            }
        });   
    });      
});

function drawDiagram()
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
        animationSteps : 1,
        //String - Animation easing effect
        animationEasing : false,
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate : true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale : false
    };
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