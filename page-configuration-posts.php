<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_posts' || is_user_role('administrator')) {

  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_type' => 'post',
  );
  $post_query = new wp_query( $args );

  $pageoptions = [
    "postslist" => "Artículos",
    "newposts" => "Nuevo artículo",
    "manageposts" => "Gestionar artículos",
  ];
  ?>

  <!-- flexboxer -->
    <div class="flexboxer flexboxer--configuration flexboxer--configuration__posts flexboxer--full">

      <!-- admin options -->
      <?php wpdc_the_pageoptions($pageoptions);?>

      <!-- new job -->
      <?php include(locate_template('templates/sections/posts-create.php')); ?>

      <!-- config job -->
      <?php
      $posts_query = $post_query;
      include(locate_template('templates/sections/posts-config.php')); ?>

      <!-- job list -->
      <?php
      $posts_query = $post_query;
      include(locate_template('templates/sections/listing-posts.php')); ?>

      
  </div><!-- end of flexboxer -->

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>