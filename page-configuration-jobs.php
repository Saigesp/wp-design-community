<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_jobs' || is_user_role('administrator')) {

  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_type' => 'jobs',
  );
  $jobs_query = new wp_query( $args );

  $pageoptions = [
    "joblist" => "Ofertas de trabajo",
    "newjob" => "Nueva oferta",
    "managejob" => "Gestionar ofertas",
  ];


  ?>

  <!-- flexboxer -->
    <div class="flexboxer flexboxer--configuration flexboxer--configuration__jobs flexboxer--full">

      <!-- admin options -->
      <?php wpdc_the_pageoptions($pageoptions);?>

      <!-- new job -->
      <?php include(locate_template('templates/sections/job-create.php')); ?>

      <!-- config job -->
      <?php
      $job_query = $jobs_query;
      include(locate_template('templates/sections/job-config.php')); ?>

      <!-- job list -->
      <?php
      $job_query = $jobs_query;
      include(locate_template('templates/sections/listing-jobs.php')); ?>

      
  </div><!-- end of flexboxer -->

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>