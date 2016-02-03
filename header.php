<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
  
  <?php if (!is_home()) { ?>
  <title><?php wp_title(''); ?> | <?php bloginfo('sitename'); ?></title>
  <?php }else{ ?>
  <title><?php bloginfo('sitename'); ?></title>
  <?php } ?>
  <meta name="description" content="<?php bloginfo('description'); ?>"/>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
  
  <meta property="og:url" content="<?php the_permalink() ?>"/>
  <?php if (is_single()) { ?>    
		<meta property="og:title" content="<?php single_post_title(''); ?>" />  
		<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />  
		<meta property="og:type" content="article" />  
	<?php } else { ?>  
  	<meta property="og:title" content="<?php wp_title(''); ?>" />
		<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />  
		<meta property="og:description" content="<?php bloginfo('description'); ?>" />  
		<meta property="og:type" content="website" />  
	<?php } ?>
  <?php if (is_author()) { ?>  
	  <meta property="og:image" content="<?php $author = get_queried_object(); $img_src = wp_get_attachment_image_src(get_the_author_meta('foto_personal', $author->ID ), 'full');; echo $img_src[0]; ?>" />
  <?php } ?>
  
  <meta name="twitter:card" content="summary"> 
  <meta name="twitter:site" content="@DisIndEs"> 
  <meta name="twitter:title" content="<?php wp_title(''); ?>"> 
  <meta name="twitter:creator" content="@DisIndEs"> 

  <link rel="icon" type="image/png" href="/favicon.png" />
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css"/> 
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:700,400' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/gallery.theme.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/gallery.min.css">
  
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ias.min.js" type="text/javascript"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/masonry.pkgd.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/imagesloaded.pkgd.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.scrollUp.min.js"></script>
  
  <script> 
  $(function() {
    $( ".accordion" ).accordion({
      collapsible: true,
      heightStyle: "content",
      active: false,
      animate: 0
    });
  }); 
  </script>
  
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
  
<!-- menu -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58427545-1', 'auto');
  ga('send', 'pageview');

</script>  
  
<script> 
$(function() {
  var navsup = $('#navsup');
  var butt = $('#menubuton');
  var pull = $('#pull');
  var sear = $('#search');
  var idiom = $('#idiomas');  
  var perfil = $('#perfil');  
  var lastScrollTop = 0;
  menu 		= $('#menu-menu-superior');
  searchmenu 		= $('#searchmenusup');
  idiomasmenu 		= $('#idiomasmenusup');
  perfilmenu 		= $('#menu-profile-menu');
  
  $(pull).on('click', function(e) {
    e.preventDefault();
    idiomasmenu.slideUp();
    searchmenu.slideUp();
    menu.slideToggle();
    perfilmenu.slideUp();
    if (sear.hasClass("menuselected")) sear.removeClass("menuselected");
    if (idiom.hasClass("menuselected")) idiom.removeClass("menuselected");
    if (perfil.hasClass("menuselected")) perfil.removeClass("menuselected");
    if (pull.hasClass("menuselected")) { pull.removeClass("menuselected");
    } else { pull.addClass("menuselected"); }
  });
    
  $(sear).on('click', function(e) {
    e.preventDefault();
    idiomasmenu.slideUp();
    menu.slideUp();
    searchmenu.slideToggle();
    perfilmenu.slideUp();
    if (pull.hasClass("menuselected")) pull.removeClass("menuselected");
    if (idiom.hasClass("menuselected")) idiom.removeClass("menuselected");
    if (perfil.hasClass("menuselected")) perfil.removeClass("menuselected");
    if (sear.hasClass("menuselected")) { sear.removeClass("menuselected");
    } else { sear.addClass("menuselected"); }
  });
    
  $(idiom).on('click', function(e) {
    e.preventDefault();
    menu.slideUp();
    searchmenu.slideUp();
    idiomasmenu.slideToggle()
    perfilmenu.slideUp();
    if (sear.hasClass("menuselected")) sear.removeClass("menuselected");
    if (pull.hasClass("menuselected")) pull.removeClass("menuselected");
    if (perfil.hasClass("menuselected")) perfil.removeClass("menuselected");
    if (idiom.hasClass("menuselected")) { idiom.removeClass("menuselected");
    } else { idiom.addClass("menuselected"); }
  });
    
  $(perfil).on('click', function(e) {
    e.preventDefault();
    menu.slideUp();
    searchmenu.slideUp();
    perfilmenu.slideToggle();
    idiomasmenu.slideUp();
    if (sear.hasClass("menuselected")) sear.removeClass("menuselected");
    if (idiom.hasClass("menuselected")) idiom.removeClass("menuselected");
    if (pull.hasClass("menuselected")) pull.removeClass("menuselected");
    if (perfil.hasClass("menuselected")) { perfil.removeClass("menuselected");
    } else { perfil.addClass("menuselected"); }
  });
  
  $(window).resize(function(){
    menu.removeAttr('style');
    searchmenu.removeAttr('style');  
    idiomasmenu.removeAttr('style'); 
    perfilmenu.removeAttr('style'); 
  });

  $(window).scroll(function(event){
     var st = $(this).scrollTop();
     menu.slideUp();
     searchmenu.slideUp(); 
     idiomasmenu.slideUp();
     perfilmenu.slideUp();
  });    
});

$(function() {
	$.scrollUp({
 		scrollName:        'scrollUp',
 		topDistance:       '300',
 		topSpeed:          300,
 		animation:         'fade',
 		animationInSpeed:  200,
 		animationOutSpeed: 200,
 		scrollText:        '',
 		activeOverlay:     false,
	});
	$( window ).on( 'scroll', function() {
		if ( $( document ).height() - $( window ).height() === $( window ).scrollTop() ) {
			$('#scrollUp').css( 'bottom', '80px' );
		} else {
			$('#scrollUp').css( 'bottom', '30px' );
		}
	});
});
</script>
  
<?php if (is_search() || is_page('disenadores')){?>
<script type="text/javascript">    
$(document).ready(function() {
    var container = document.querySelector('#usermain');
    var msnry = new Masonry( container, {
      columnWidth: 5,
      itemSelector: '.masonry',
      isAnimated: true,
      animationOptions: {
        duration: 400,
        easing: 'linear',
        queue: false
  		}
    });
    var ias = $.ias({
      container: "#usermain",
      item: ".masonry",
      pagination: ".navigation",
      next: "a.next",
      delay: 1200
    }); 

    ias.on('render', function(items) { $(items).css({ opacity: 0 });});

    ias.on('rendered', function(items) {
      msnry.appended(items);
      msnry.layout();
     	$(items).css({ opacity: 1 });
    });

ias.extension(new IASSpinnerExtension({
    src: 'http://xn--diseadoresindustriales-nec.es/wp-content/themes/disindu/img/ajax-loader.gif', // optionally
}));
ias.extension(new IASTriggerExtension({
    text: 'Ver más', // optionally
  	offset: <?php echo get_option("users_per_page");?>,
}));
ias.extension(new IASNoneLeftExtension({
  <?php if(is_page(disenadores) && $_GET['order'] == 'rand'){ ?>
  text: "<a href='http://xn--diseadoresindustriales-nec.es/disenadores/?order=rand'>Recargar vista aleatoria</a>",
  <?php }else{ ?>
	text: "No hay más resultados",
	<?php } ?>
})); 

});
</script>
<?php } ?>
  
<?php if (is_post_type_archive('preguntas')){?>
<script type="text/javascript">    

  $(document).ready(function() {
    var ias = $.ias({
      container: "#mainloop",
      item: ".archive",
      pagination: ".navigation",
      next: "a.next",
      delay: 1200
    }); 

    ias.on('render', function(items) { $(items).css({ opacity: 0 });});
    ias.on('rendered', function(items) { $(items).css({ opacity: 1 });});

		ias.extension(new IASSpinnerExtension({ src: 'http://xn--diseadoresindustriales-nec.es/wp-content/themes/disindu/img/ajax-loader.gif',}));
		ias.extension(new IASTriggerExtension({ text: 'Ver más', offset: <?php echo get_option("pubs_per_page");?>,}));
    ias.extension(new IASNoneLeftExtension({ text: "No hay más resultados", })); 

}); 
</script>
<?php } ?>

  
  
</head>
<?php include( locate_template(  'functions-svg.php' )); ?>   
<body>
<?php
$user = wp_get_current_user();
$allowed_roles = array('editor', 'administrator', 'author');  ?> 

<header>
 
<div id="logo">
<a href="http://xn--diseadoresindustriales-nec.es">
  <svg version="1.1" id="svg-logo-disind" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="45px" height="45px" viewBox="0 0 45 45" enable-background="new 0 0 45 45" xml:space="preserve">
  <path d="M39.907,10.115L22.017,4.883c-0.069-0.02-0.142-0.021-0.21-0.001L6.956,8.957C6.801,9,6.688,9.134,6.674,9.295
    s0.073,0.313,0.218,0.382l3.856,1.85c0.085,0.041,0.183,0.049,0.274,0.022l11.228-3.27l14.011,4.545L34.582,27.38L21.792,37.571
    L9.51,27.497L8.294,14.798l11.824,6.278l-0.054,14.047c0,0.104,0.042,0.205,0.118,0.278l1.423,1.377
    c0.145,0.141,0.373,0.145,0.523,0.012l1.439-1.271c0.082-0.071,0.13-0.177,0.13-0.287l0.062-16.103c0-0.147-0.083-0.282-0.216-0.348
    L5.372,9.826C5.247,9.764,5.097,9.775,4.981,9.855c-0.115,0.081-0.178,0.216-0.165,0.355l1.921,18.98
    c0.01,0.099,0.057,0.189,0.131,0.253L21.511,42.04c0.072,0.063,0.162,0.093,0.251,0.093c0.085,0,0.17-0.028,0.241-0.084
    l15.893-12.663c0.081-0.064,0.132-0.156,0.144-0.258l2.143-18.599C40.204,10.343,40.088,10.168,39.907,10.115"/>
  </svg>
</a>
</div>
  
		<nav class="clearfix" id="navsup">
      			<div class="menu-menu-superior-container">
              <ul id="menu-menu-superior" class="clearfix">
                <div id="menu-sup-dir" class="menudivicon">
                    <li id="menu-item-dir" class="menu-item menu-item-type-post_type menu-item-object-page">
                        <a href="http://xn--diseadoresindustriales-nec.es/disenadores/"><?php the_svg_icon('directorio');?><span>Directorio</span></a>
                    </li>
                </div>
                <div id="menu-sup-info" class="menudivicon">
                    <li id="menu-item-info" class="menu-item menu-item-type-post_type menu-item-object-page">
                        <a href="http://xn--diseadoresindustriales-nec.es/faqs/"><?php the_svg_icon('info');?><span>Información</span></a>
                    </li>
                </div>
                <div id="menu-sup-blog" class="menudivicon">
                    <li id="menu-item-blog" class="menu-item menu-item-type-post_type menu-item-object-page">
                        <a href="http://xn--diseadoresindustriales-nec.es/blog/"><?php the_svg_icon('disind');?><span>Blog</span></a>
                    </li>
                </div>
                <div id="menu-sup-contact" class="menudivicon">
                    <li id="menu-item-contact" class="menu-item menu-item-type-post_type menu-item-object-page">
                        <a href="http://xn--diseadoresindustriales-nec.es/contacto/"><?php the_svg_icon('email');?><span>Contacto</span></a>
                    </li>
                </div>
      
              </ul>
            </div> 
						<div id="searchmenu">
								<ul id="searchmenusup" >
                		<li>
                      	<a href="#" id="searchbox">
												<?php get_search_form(); ?>
												</a>
                  	</li>
              	</ul>
						</div>
        		<div id="idiomasmenu" class="menu-idiomas-menu-container">
								<ul id="idiomasmenusup" >
										<?  $languages = icl_get_languages('skip_missing=1');
								 		 if(1 < count($languages)){
    										foreach($languages as $l){
      										if(!$l['active']){ ?>
  														<div id="langicon-<?php echo $l['language_code'];?>" class="menudivicon">
  																<li class="menu-item menu-item-type-post_type menu-item-object-page">
																			<?php echo '<a href="'.$l['url'].'"><span>'.$l['translated_name'].'</span></a>';?>
         	 												</li>
    													</div>
   												<?php }?>
												<?php } ?>
        						<?php }?>
								</ul>
						</div>
    <?php if ( is_user_logged_in()) {?>  
      <div class="menu-profile-menu-container">
        <ul id="menu-profile-menu" class="clearfix">
          <div id="myprofile" class="menudivicon">
          		<li id="menu-item-123" class="menu-item menu-item-type-post_type menu-item-object-page">
                	<?php if(get_the_author_meta( 'perfil_publico', $user->ID ) == 1){?>
                       		<a href="<?php echo get_author_posts_url(get_current_user_id( ));?>"><?php the_svg_icon('nombre');?><span>Mi perfil</span></a>
                      <?php }else{
                       		echo '<a href="http://xn--diseadoresindustriales-nec.es/perfil-incompleto/">'; the_svg_icon("nombre"); echo '<span>Mi perfil</span></a>';
                       	} ?>
          		</li>
          </div>
          <div id="menu-sup--edit-profile" class="menudivicon">
          		<li id="menu-item-123" class="menu-item menu-item-type-post_type menu-item-object-page">
									<a href="http://xn--diseadoresindustriales-nec.es/modificar-perfil/"><?php the_svg_icon('editarperfil');?><span>Editar perfil</span></a>
          		</li>
          </div>
          <div id="menu-sup-config" class="menudivicon">
          		<li id="menu-item-123" class="menu-item menu-item-type-post_type menu-item-object-page">
									<a href="http://xn--diseadoresindustriales-nec.es/configuracion/"><?php the_svg_icon('configuracion');?><span>Configuración</span></a>
          		</li>
          </div>
          <?php if(is_user_role('editor') || is_user_role('administrator')|| is_user_role('editor')){?>
          <div id="configprofile" class="menudivicon">
          		<li id="menu-item-123" class="menu-item menu-item-type-post_type menu-item-object-page">
									<a href="http://xn--diseadoresindustriales-nec.es/control-usuarios/"><?php the_svg_icon('control');?><span>Control de usuarios</span></a>
          		</li>
          </div>
          <?php } ?>
          <?php if (get_option("invitation_op") == true || is_user_role("administrator")){ ?>
          <div id="newusermenusup" class="menudivicon">
          		<li id="menu-item-123" class="menu-item menu-item-type-post_type menu-item-object-page">
									<a href="http://xn--diseadoresindustriales-nec.es/invitar"><?php the_svg_icon('apellidos');?><span>Enviar invitación</span></a>
          		</li>
          </div>
          <?php } ?>
        	<div id="logoutmenusup" class="menudivicon">
							<li id="menu-item-129" class="menu-item menu-item-type-custom menu-item-object-custom">
            			<a href="<?php echo wp_logout_url();?>"><?php the_svg_icon('logout');?><span>Cerrar sesión</span></a>
          </li>
          </div>
				</ul>
      </div>
      
    <?php }else{ ?>
      
      <div class="menu-profile-menu-container">
        <ul id="menu-profile-menu" class="clearfix">
          <div id="loginmenusup" class="menudivicon">
   					<li id="menu-item-129" class="menu-item menu-item-type-custom menu-item-object-custom">
            	<a href="http://xn--diseadoresindustriales-nec.es/iniciar-sesion"><?php the_svg_icon('login');?><span>Iniciar sesión</span></a>            
          	</li>
          </div>
			  </ul>
      </div>   
          <?php } ?>  
     <div id="menubuton">
						<a href="http://xn--diseadoresindustriales-nec.es" id="logores" class="menuboton">
  <svg version="1.1" id="svg-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="45px" height="45px" viewBox="0 0 45 45" enable-background="new 0 0 45 45" xml:space="preserve">
  <path d="M39.907,10.115L22.017,4.883c-0.069-0.02-0.142-0.021-0.21-0.001L6.956,8.957C6.801,9,6.688,9.134,6.674,9.295
    s0.073,0.313,0.218,0.382l3.856,1.85c0.085,0.041,0.183,0.049,0.274,0.022l11.228-3.27l14.011,4.545L34.582,27.38L21.792,37.571
    L9.51,27.497L8.294,14.798l11.824,6.278l-0.054,14.047c0,0.104,0.042,0.205,0.118,0.278l1.423,1.377
    c0.145,0.141,0.373,0.145,0.523,0.012l1.439-1.271c0.082-0.071,0.13-0.177,0.13-0.287l0.062-16.103c0-0.147-0.083-0.282-0.216-0.348
    L5.372,9.826C5.247,9.764,5.097,9.775,4.981,9.855c-0.115,0.081-0.178,0.216-0.165,0.355l1.921,18.98
    c0.01,0.099,0.057,0.189,0.131,0.253L21.511,42.04c0.072,0.063,0.162,0.093,0.251,0.093c0.085,0,0.17-0.028,0.241-0.084
    l15.893-12.663c0.081-0.064,0.132-0.156,0.144-0.258l2.143-18.599C40.204,10.343,40.088,10.168,39.907,10.115"/>
  </svg>
      			</a> 
						<a href="#" id="pull" class="menuboton">
              	<svg version="1.1" id="svg-burguer" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="18px" viewBox="0 0 128 128" enable-background="new 0 0 128 128" xml:space="preserve">
                  <path d="M114,8H14C7.4,8,2,13.4,2,20s5.4,12,12,12h100c6.6,0,12-5.4,12-12S120.6,8,114,8z"/>
<path d="M114,52H14C7.4,52,2,57.4,2,64s5.4,12,12,12h100c6.6,0,12-5.4,12-12S120.6,52,114,52z"/><path d="M114,96H14c-6.6,0-12,5.4-12,12s5.4,12,12,12h100c6.6,0,12-5.4,12-12S120.6,96,114,96z"/>
              	</svg>
              <span class="text">Menu</span>
      			</a> 
						<a href="#" id="search" class="menuboton">
              <svg version="1.1" id="svg-search" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="18px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve">
                <path d="M62.188,54.356L47.225,38.898c-1.073-1.109-2.414-1.553-2.995-0.986c-0.583,0.563-1.925,0.12-2.998-0.989l-0.214-0.222
	c6.697-8.808,6.047-21.419-1.995-29.461c-8.777-8.777-23.008-8.777-31.784,0c-8.777,8.777-8.777,23.006,0,31.783
	c8.179,8.18,21.088,8.728,29.914,1.663l0.094,0.098c1.071,1.109,1.47,2.464,0.885,3.028c-0.582,0.564-0.186,1.92,0.888,3.027
	l14.955,15.464c1.073,1.106,2.841,1.139,3.951,0.065l4.197-4.061C63.229,57.236,63.259,55.469,62.188,54.356z M34.084,34.084
	c-6.04,6.041-15.869,6.041-21.908,0.002c-6.04-6.04-6.039-15.87,0-21.909c6.039-6.04,15.868-6.039,21.906,0.001
	C40.123,18.217,40.123,28.045,34.084,34.084z"/>
              </svg>
              <span class="text">Buscar</span>
      			</a>
						<a href="#" id="idiomas" class="menuboton"<?php if(count(icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str')) < 2) echo 'style="visibility:hidden;"';?>>
								<svg version="1.1" id="svg-idiomas" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="26px" viewBox="0 -2 24 24" enable-background="new 0 0 26 26" xml:space="preserve">
									<g>
                    	<path d="M11.166,14.121v-0.649c-0.362-0.246-0.704-0.539-1.02-0.887c-0.914,0.883-1.789,1.442-1.888,1.505l-0.083,0.052
		l-0.504-0.805l0.082-0.052c0.01-0.007,0.901-0.572,1.8-1.453c-0.825-1.204-1.142-2.417-1.155-2.47L8.374,9.269l0.92-0.236
		l0.024,0.094c0.002,0.01,0.264,0.981,0.901,1.98c0.63-0.766,0.997-1.504,1.091-2.2H7.445V7.873h2.13V7.299h0.993v0.574h2.13v1.034
		H12.27c-0.1,0.967-0.591,1.969-1.464,2.982c0.117,0.132,0.237,0.252,0.36,0.367v-0.067V11.77c0-0.345,0.28-0.625,0.625-0.625h2.781
		V6.226c0-0.086-0.069-0.156-0.156-0.156H5.427c-0.086,0-0.156,0.07-0.156,0.156v8.988c0,0.087,0.07,0.156,0.156,0.156h5.739V14.121
		z"/>
											<path d="M16.3,14.396h-0.017c-0.086,0.342-0.171,0.776-0.265,1.108l-0.341,1.22h1.271l-0.358-1.22
		C16.487,15.163,16.385,14.737,16.3,14.396z"/>
											<path d="M20.849,11.647h-8.988c-0.086,0-0.156,0.07-0.156,0.156v8.989c0,0.086,0.07,0.155,0.156,0.155h8.988
		c0.087,0,0.156-0.069,0.156-0.155v-8.989C21.005,11.717,20.936,11.647,20.849,11.647z M17.579,19.171l-0.443-1.476H15.49
		l-0.41,1.476h-1.347l1.757-5.747h1.705l1.782,5.747H17.579z"/>
											<polygon points="9.317,15.764 8.067,15.764 8.067,17.841 9.102,18.865 11.425,18.865 11.425,17.616 9.317,17.616 	"/>
									</g>
								</svg>
              <span class="text">Idioma</span>
						</a>
						<a href="#" id="perfil" class="menuboton">
								<svg version="1.1" id="svg-profile" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="24px" viewBox="0 -4 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
				<circle cx="50.59" cy="31.191" r="14.691"/>
				<path d="M56.821,46.884H44.356c-10.372,0-18.811,8.438-18.811,18.811V80.94l0.039,0.239l1.05,0.328
				c9.899,3.093,18.499,4.124,25.578,4.124c13.824,0,21.838-3.942,22.332-4.193l0.981-0.497h0.105V65.694
				C75.632,55.322,67.193,46.884,56.821,46.884z"/>
								</svg>
              <span class="text">Perfil</span>
						</a>
      </div>
			</nav>
   
	</header>

	<div id="main">