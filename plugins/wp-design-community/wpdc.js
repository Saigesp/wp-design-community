/**
 *  DOCUMENT READY
 ***********************************/
jQuery(document).ready(function($) {

    imageresize($);

});









/**
 *  CUSTOM FUNCTIONS
 ***********************************/

(function ($) {
    $.fn.inlineStyle = function (prop) {
         var styles = this.attr("style"),
             value;
         styles && styles.split(";").forEach(function (e) {
             var style = e.split(":");
             if ($.trim(style[0]) === prop) {
                 value = style[1];           
             }                    
         });   
         return value;
    };
}(jQuery));

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
