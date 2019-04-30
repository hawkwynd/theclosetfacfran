jQuery(document).ready(function( $ ) {

    $('iframe').each(function() {
        var url = $(this).attr("src");
        if ($(this).attr("src").indexOf("?") > 0) {
            $(this).attr({
                "src" : url + "&wmode=transparent",
                "wmode" : "transparent"
            });
        }
        else {
            $(this).attr({
                "src" : url + "?wmode=transparent",
                "wmode" : "transparent"
            });
        }
    });

    $("ul.menu > li").addClass("primary-nav-main"); 

    $("ul.sub-menu li").addClass("primary-nav-sub"); 
});