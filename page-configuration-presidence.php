<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_position', true) == 'presidente' || is_user_role('administrator')) {

    include(locate_template('templates/functions/functions-validation.php'));

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
        "capacities"        => "Configurar permisos",
        "gobteam"           => "Configurar gobierno",
        "byemrpresident"    => "Ceder la presidencia",
    ];

    ?>

    <!-- flexboxer -->
    <form method="POST" action="">
        <div class="flexboxer flexboxer--event">

            <?php //include(locate_template('templates/harry/harry.php')); ?>

            <!-- admin options -->
            <?php wpdc_the_pageoptions($pageoptions);?>

            <!-- permisos -->
            <?php include(locate_template('templates/sections/config-capacities.php')); ?>

            <!-- gobierno section -->
            <?php include(locate_template('templates/sections/config-govern.php')); ?>

            <!-- dimitir section -->
            <?php include(locate_template('templates/sections/config-changegovern.php')); ?>
          
        </div><!-- end of flexboxer -->
    </form>

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>