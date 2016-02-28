/**
 *  DOCUMENT READY
 ***********************************/
jQuery(document).ready(function($) {

    imageresize($);

});









/**
 *  CUSTOM FUNCTIONS
 ***********************************/

function imageresize($) {
    // Altura imágenes
    if ($(".js-thumbfull").length > 0) {
        $('.js-thumbfull').css("height", $(window).height() - $('#headertop').outerHeight());
    }

    // Imagefill
    if ($(".thumbmasonry").length > 0) $('.thumbmasonry').imagefill();
    if ($(".thumbarch").length > 0) $('.thumbarch').imagefill();
    if ($(".js-thumbfull").length > 0) $('.js-thumbfull').imagefill();

}
