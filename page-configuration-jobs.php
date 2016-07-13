<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_jobs' || is_user_role('administrator')) {

  include(locate_template('templates/functions/functions-validation.php'));

  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_type' => 'jobs',
  );
  $job_query = new wp_query( $args );

  $pageoptions = [
    "joblist" => "Ofertas de trabajo",
    "newjob" => "Nueva oferta",
    "managejob" => "Configurar trabajos",
  ];


  ?>

  <!-- flexboxer -->
    <div class="flexboxer flexboxer--configuration flexboxer--configuration__jobs">

      <?php include(locate_template('templates/sections/meeseeks.php')); ?>

      <!-- admin options -->
      <?php wpdc_the_pageoptions($pageoptions);?>

      <!-- new job -->
      <?php include(locate_template('templates/sections/job-create.php')); ?>

      <!-- config job -->
      <?php include(locate_template('templates/sections/job-config.php')); ?>

      <!-- job list -->
      <?php
      include(locate_template('templates/sections/listing-jobs.php')); ?>

      
  </div><!-- end of flexboxer -->

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>