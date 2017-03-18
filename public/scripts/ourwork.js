$(document).ready(function()
{
    if( pid !== 0 )
    {
        scrollTo('pid_'+pid);
    }
    
    $('.imageFancy').fancybox({
                margin:0,
                padding:0,
                cyclic:true
    });        
});

function likeHover($this)
{
    $this.attr('src', 'i/like_active.png');
}

function likeOut($this)
{
    $this.attr('src', 'i/like.png');
}

function like(pid)
{
    $.ajax({
        type: "POST",
        data: 'pid='+pid,
        url: rootPath + "ourwork/dolike",
        async: false,
        success: function(resp)
        {
            $('#pid_'+pid).find('.ourWorkShare').find('.likeCount').html(resp);
            $('#pid_'+pid).find('.ourWorkShare').find('.likeImg').html('<img src="i/like_active.png" class="activeLike" />');
        }
    });    
}