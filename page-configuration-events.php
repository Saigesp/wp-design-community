<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_events' || is_user_role('administrator')) {

  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_type' => 'event',
    'orderby' => 'meta_value',
    'meta_key'  => '_start_ts',
  );
  $wp_query = new wp_query( $args );

  $pageoptions = [
    "eventlist" => "Eventos",
    site_url('edit-event') => "Crear evento",
    "seteventoptions" => "Gestionar eventos",
    "manageevents" => "Gestionar reservas",
  ];

  ?>

  <!-- flexboxer -->
  <div class="flexboxer flexboxer--configuration flexboxer--configuration__event flexboxer--full">

  		<!-- admin options -->
      <?php wpdc_the_pageoptions($pageoptions);?>

      <?php include(locate_template('templates/sections/events-config.php')); ?> 

      <?php include(locate_template('templates/sections/listing-events.php')); ?> 

    
  </div><!-- end of flexboxer -->

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>