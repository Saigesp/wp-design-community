<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_position', true) == 'presidente' || is_user_role('administrator')) {

    global $wpdb;
    $blog_id = get_current_blog_id();

    $users = new WP_User_Query(
        array(
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => $wpdb->get_blog_prefix( $blog_id ) . 'capabilities',
                    'value' => 'author',
                    'compare' => 'like'
                ),
                array(
                    'key' => $wpdb->get_blog_prefix( $blog_id ) . 'capabilities',
                    'value' => 'editor',
                    'compare' => 'like'
                )
            )
        )
    );

    $pageoptions = [
        "gobteam"           => "Configurar gobierno",
        "capacities"        => "Configurar permisos",
        "byemrpresident"    => "Ceder la presidencia",
    ];

    ?>

    <!-- flexboxer -->
    <div class="flexboxer flexboxer--configuration flexboxer--configuration__presidence flexboxer--full">

        <!-- admin options -->
        <?php wpdc_the_pageoptions($pageoptions);?>

        <!-- gobierno section -->
        <?php
        $users = $users->results;
        include(locate_template('templates/sections/config-govern.php')); ?>

        <!-- permisos -->
        <?php include(locate_template('templates/sections/config-capacities.php')); ?>

        <!-- dimitir section -->
        <?php include(locate_template('templates/sections/config-changegovern.php')); ?>
      
    </div><!-- end of flexboxer -->

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>