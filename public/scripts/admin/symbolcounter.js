$(document).ready(function(){
    //  Counting the counter start state
    var value = $('input[id="metaTitle"]').attr('value') || '';
    var initLength = Math.max((value ? (250 - value.length) : 250),0);
    $('#metaTitle-counter').css('color', 'rgb('+(1*value.length)+', 0, 0)');
    $('#metaTitle-counter').html(initLength.toString());

    $('input[id="metaTitle"]').keyup(function(){
        var value = $(this).attr('value') || '';
        var lengthToGo = Math.max((250 - value.length),0);
        $('#metaTitle-counter').css('color', 'rgb('+(1*value.length)+', 0, 0)');
        $('#metaTitle-counter').html(lengthToGo.toString());
    });

    var value2 = $('input[id="keywords"]').attr('value') || '';
    var initLength2 = Math.max((value2 ? (250 - value2.length) : 250),0);
    $('#keywords-counter').css('color', 'rgb('+(1*value2.length)+', 0, 0)');
    $('#keywords-counter').html(initLength2.toString());

    $('input[id="keywords"]').keyup(function(){
        var value = $(this).attr('value') || '';
        var lengthToGo = Math.max((250 - value.length),0);
        $('#keywords-counter').css('color', 'rgb('+(1*value.length)+', 0, 0)');
        $('#keywords-counter').html(lengthToGo.toString());
    });

    var value3 = $('textarea[id="metadescription"]').attr('value') || '';
    var initLength3 = Math.max((value3 ? (500 - value3.length) : 500),0);
    $('#metadescription-counter').css('color', 'rgb('+(1*value3.length)+', 0, 0)');
    $('#metadescription-counter').html(initLength3.toString());

    $('textarea[id="metadescription"]').keyup(function(){
        var value = $(this).attr('value') || '';
        var lengthToGo = Math.max((500 - value.length),0);
        $('#metadescription-counter').css('color', 'rgb('+(1*value.length)+', 0, 0)');
        $('#metadescription-counter').html(lengthToGo.toString());
    });
});