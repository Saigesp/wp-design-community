<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_concursos' || is_user_role('administrator')) {

  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_type' => 'concursos',
    //'orderby' => 'meta_value',
    //'meta_key'  => '_start_ts',
  );
  $concurso_query = new wp_query( $args );


  if(is_user_role('administrator') || is_user_role('editor')) {

    include(locate_template('templates/functions/functions-validation.php'));

    $pageoptions = [
      "concursolist" => "Concursos",
      "newconcurso" => "Crear concurso",
      "setconcursosoptions" => "Configurar concursos",
    ];
  }

  ?>

  <!-- flexboxer -->
    <div class="flexboxer flexboxer--event">

      <?php include(locate_template('templates/sections/meeseeks.php')); ?>

      <!-- admin options -->
      <?php if(is_user_role('administrator') || is_user_role('editor')) wpdc_the_pageoptions($pageoptions);?>

      <!-- new concurso -->
      <?php include(locate_template('templates/sections/concurso-create.php')); ?>

      <!-- config concursos -->
      <?php include(locate_template('templates/sections/concurso-config.php')); ?>

      <!-- concursos list -->
      <?php include(locate_template('templates/sections/listing-concurso.php')); ?>

    
  </div><!-- end of flexboxer -->

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>