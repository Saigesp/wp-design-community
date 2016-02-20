<!DOCTYPE html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<!-- Google Chrome Frame for IE -->
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <base href="">
  <meta name="keywords" content="">
  <meta name="robots" content="INDEX,follow">
  <meta name="copyright" content="">
  <meta name="revisit-after" content="7 days">
  <meta property="og:locale" content="es_ES">
  <meta name="twitter:card" content="summary"> 
  <meta name="twitter:site" content="@"> 
  <meta name="twitter:creator" content="@"> 
  <meta name="google-site-verification" content="" />
  
	<?php if (is_single()) { ?>
	 	<title><?php wp_title(''); ?> | <?php bloginfo('sitename'); ?></title>
  	<meta name="twitter:title" content="<?php wp_title(''); ?> | <?php bloginfo('sitename'); ?>"> 
  <?php }else{ ?>
   	<title><?php bloginfo('sitename'); ?></title>
  	<meta name="twitter:title" content="<?php bloginfo('sitename'); ?>"> 
  <?php } ?>
  <?php if (is_single()) { ?>  
    <meta name="description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>"/>
  	<meta name="author" content="<?php global $post; $author_id=$post->post_author; the_author_meta('display_name', $author_id); ?>">
    <meta property="article:author" content="<?php the_author_meta('display_name', 1); ?>">
    <meta property="og:url" content="<?php the_permalink() ?>"/>  
    <meta property="og:title" content="<?php single_post_title(''); ?>" />  
    <meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />  
    <meta property="og:type" content="article" />   
  <?php } else { ?>  
    <meta name="description" content="<?php bloginfo('description'); ?>"/>
  	<meta name="author" content="Talk&Code">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />  
    <meta property="og:description" content="<?php bloginfo('description'); ?>" />  
    <meta property="og:type" content="website" />  
  <?php } ?>

  <!-- favicon -->
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico" />
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-180x180.png">
  <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-194x194.png" sizes="194x194">
  <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/android-chrome-192x192.png" sizes="192x192">
  <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#00aba9">
  <meta name="msapplication-TileImage" content="/mstile-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <!-- estilos -->
  <?php if(is_single()){?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/selection.sharer.css">
  <?php } ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css" />
	<link href='http://fonts.googleapis.com/css?family=Merriweather:400italic,400,900,300,700,700italic|Merriweather+Sans:400,700,800|Open+Sans:400italic,400,300,700,800,600' rel='stylesheet' type='text/css'>
  
  <!-- scripts -->
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.ias.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/masonry.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.imagesloaded.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.imagefill.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/selection.sharer.js"></script>

  <script>
$(document).ready(function() {
  //Analytics
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
 
  ga('create', 'XXXXXXX', 'auto');
  ga('send', 'pageview');

});
  </script>
		
  <?php
  wp_head();
  include_once(locate_template('functions-svg.php'));
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  ?>  
  
</head>

<body>
  <div id="wrapper">
    <?php include( locate_template(  'menu-header.php' )); ?>