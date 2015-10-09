 jQuery(document).ready(function($) {
    "use strict";

    // Jquery Player Close/Open Button Homepage
    var sectionTop = $(".slideUp");
    $(".button-section").toggle(function(){
        $(this).addClass('rotated');
        sectionTop.slideUp('200');
        return false;
    },function(){
        sectionTop.slideDown('200');
        $(this).removeClass('rotated');
        return false;
    });

    // Sidebar tabs
    $('#myTab li:eq(2) a').tab('show');

    // Shop Tabs
    $('#productTab li:eq(2) a').tab('show');

    // Shop Items Count
    $(".numbers-row").append('<div class="inc button">+</div><div class="dec button">-</div>');
    $(".button").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() == "+") {
          var newVal = parseFloat(oldValue) + 1;
        } else {
           // Don't allow decrementing below zero
          if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
            } else {
            newVal = 0;
          }
        }
        $button.parent().find("input").val(newVal);
    }); // End Click
});



$(window).on("load", function() {
    "use strict";
    
    // Masonry blog posts
    var triggerM = $('.masonry-trigger');
    var container = $('#blog-masonry');
    function startMasonry(){
        container.masonry({
            gutter: 0,
            itemSelector: '.article',
            columnWidth: '.article',
            isInitLayout: true
        }); 
    }    
    if(triggerM.css("display") == "block") {
        startMasonry();
    }  
    $(window).resize(function(){
        if(triggerM.css("display") == "block") {
            startMasonry();
        } else if(triggerM.css("display") == "none") {
            startMasonry();
            container.masonry('destroy');
        }
    });

    // Page Load Animation
    $("#loadanimation").delay(150).fadeOut("fast");
    $("#preloader").delay(200).fadeOut("slow");
});