/**
 *  DOCUMENT READY
 ***********************************/
jQuery(document).ready(function($) {

    imageresize($);

    if ($(".js-imagefill").length > 0){
		var imgLoad = imagesLoaded('.js-imagefill img');
		imgLoad.on( 'always', function( instance ) {
			$('.js-imagefill').imagefill();
		});
	}
	$(".js-showonload").removeClass("js-showonload-active");

});









/**
 *  CUSTOM FUNCTIONS
 ***********************************/

/**
 *  SET STYLES
 ***********************************/
function imageresize($) {
    // Altura imágenes
    if ($(".js-thumbfull").length > 0) $('.js-thumbfull').css("height", $(window).height() - $('#headertop').outerHeight());

    // Imagefill
    if ($(".thumbmasonry").length > 0) $('.thumbmasonry').imagefill();
    if ($(".thumbarch").length > 0) $('.thumbarch').imagefill();
    if ($(".js-thumbfull").length > 0) $('.js-thumbfull').imagefill();
    if ($(".js-imagefill").length > 0) $('.js-imagefill').imagefill();

}

/* SUBIR IMÁGENES
 *
 *********************************************************/


