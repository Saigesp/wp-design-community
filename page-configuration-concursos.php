<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_concursos' || is_user_role('administrator')) {

  if(is_user_role('administrator') || is_user_role('editor')) {

    $pageoptions = [
      "concursolist" => $concursos->post_count." Concursos",
      "newconcurso" => "Crear concurso",
      "manageconcursos" => "Gestionar concursos",
    ];
  }

  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_type' => 'concursos',
    //'orderby' => 'meta_value',
    //'meta_key'  => '_start_ts',
  );
  $concursos = new wp_query( $args );



  ?>

  <!-- flexboxer -->
    <div class="flexboxer flexboxer--configuration flexboxer--configuration__concursos flexboxer--full">

      <!-- admin options -->
      <?php if(is_user_role('administrator') || is_user_role('editor')) wpdc_the_pageoptions($pageoptions);?>

      <!-- new concurso -->
      <?php include(locate_template('templates/sections/concurso-create.php')); ?>

      <!-- concursos mng -->
      <?php
      $concurso_query = $concursos;
      include(locate_template('templates/sections/concurso-config.php')); ?>

      <!-- concursos list -->
      <?php
      $concurso_query = $concursos;
      include(locate_template('templates/sections/listing-concurso.php')); ?>

    
  </div><!-- end of flexboxer -->

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>