
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
  $('.thumbarticle').css( "height", $(window).height() - $('#headertop').outerHeight() );

  // Imagefill
  $('.thumbmasonry').imagefill(); 
  $('.thumbarch').imagefill(); 
  $('.thumbarticle').imagefill(); 

}