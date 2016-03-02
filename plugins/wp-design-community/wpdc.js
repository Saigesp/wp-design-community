/**
 *  SET STYLES
 ***********************************/
function imageresize($) {
    if ($(".js-thumbfull").length > 0) $('.js-thumbfull').css("height", $(window).height() - $('#headertop').outerHeight());
    if ($(".js-thumbfull").length > 0) $('.js-thumbfull').imagefill();
}



