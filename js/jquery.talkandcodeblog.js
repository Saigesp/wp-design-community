
/**
*  DOCUMENT READY
***********************************/

// Select tipo Bootstrap
//  $('.selectpicker').selectpicker();

var wHeight = $(window).height();
var wWidth = $(window).width();

$(document).ready(function() {

  //Masonry
  var container = document.querySelector('#masonrywrap');
  var msnry = new Masonry( container, {
    percentPosition: true,
    columnWidth: '.masonrysizer',
    itemSelector: '.masonryitem',
  });

  //Ajuste de imágenes
  imageresize();

  //Infinite Ajax Scroll
  var ias = $.ias({
    container: ".iascontainer",
    item: ".iasitem",
    pagination: ".navigation",
    next: "a.next",
    delay: 1200
  }); 
  ias.on('render', function(items) {
    $(items).css({ opacity: 0 });
  });
  ias.on('rendered', function(items) {
    $(items).css({ opacity: 1 });
    $('.thumbarch').resizetowindowheight();
    $('.thumbarch').imagefill(); 
  });
  ias.extension(new IASSpinnerExtension({
    src: window.location.protocol+'//'+window.location.hostname+window.location.pathname+'wp-content/themes/tandc/img/loader1.svg',
  }));
  ias.extension(new IASTriggerExtension({
    text: 'Ver más', offset: 10,
  }));
  ias.extension(new IASNoneLeftExtension({
    text: 'No hay más artículos',
  }));

});
    

/**
*  ON RESIZE
***********************************/
 $( window ).resize(function() {
  var newHeight = $(window).height();
  var newWidth = $(window).width();
  var absWidth = Math.abs(wWidth - newWidth);
  var absHeight = Math.abs(wHeight - newHeight);
  var abs=Math.abs;
  if ((absWidth >= 60) || (absHeight >= 60)) {
    imageresize();
  }
});




/**
*  CUSTOM FUNCTIONS
***********************************/

// Para móviles (width<500) adjusta la altura del elemento
// seleccionado a la altura de la pantalla, quitando la
// altura del menú
$.fn.resizetowindowheight = function() {
  if ($(window).width() < 550) {
    this.css( "height", $(window).height() - $('#headertop').outerHeight() );
    return this;
  }else{
    this.css( "height", "300px" );
    return this;
  }
};

function imageresize() {

  // Altura imágenes
  $('.thumbarch').resizetowindowheight();
  $('.thumbarticle').css( "height", $(window).height() - $('#headertop').outerHeight() );

  // Imagefill
  $('.thumbmasonry').imagefill(); 
  $('.thumbarch').imagefill(); 
  $('.thumbarticle').imagefill(); 

}