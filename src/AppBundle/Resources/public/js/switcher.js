
if($.cookie("beatsmusic")) {
    $("link#link").attr("href",$.cookie("beatsmusic"));
}
$(document).ready(function() { 
    $("#style-switcher li a").click(function() { 
        $("link#link").attr("href",$(this).attr('id'));
        $.cookie("beatsmusic",$(this).attr('id'), { path: '/'});
        return false;
    });
    // show-hide color pallete
    $('#style-switcher-container span.switcher-toggle').click(function(e){
        e.preventDefault();
        var div = $('#style-switcher-container');
        console.log(div.css('left'));
        if (div.css('left') === '-120px') {
            $('#style-switcher-container').animate({
                left: '0px'
            }); 
        } else {
            $('#style-switcher-container').animate({
                left: '-120px'
            });
        }
    })
});
    