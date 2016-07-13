<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_position', true) == 'secretario' || is_user_role('administrator')) {

    include(locate_template('templates/functions/functions-validation.php'));

    global $wpdb;
    $blog_id = get_current_blog_id();

    $all_users = get_users();

    $socios = new WP_User_Query(
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

    $subscribers = new WP_User_Query(
        array(
            'meta_query' => array(
                array(
                    'key' => $wpdb->get_blog_prefix( $blog_id ) . 'capabilities',
                    'value' => 'subscriber',
                    'compare' => 'like'
                )
            )
        )
    );

    $wpdc_docs = array (
        'post_type' => array('documentos'),
        'posts_per_page' => '-1',
    );
    $documents = new WP_Query( $wpdc_docs );

    $pageoptions = [
        "usuarios" => sizeof($subscribers->results)." Usuarios",
        "socios" => sizeof($socios->results)." Socios",
        //"doclist" => $documents->post_count." Documentos",
        "newuser" => "Crear usuario",
        "changememberstatus" => "Gestionar socios",
        "managedocs" => "Gestionar documentos",
    ];

    ?>

    <!-- flexboxer -->
    <div class="flexboxer flexboxer--full flexboxer--configuration flexboxer--configuration__treasury">

        <!-- Mr Meeseeks -->
        <?php include(locate_template('templates/sections/meeseeks.php')); ?>
    
    </div>
    
    <div class="flexboxer flexboxer--page flexboxer--page__secretary">

        <!-- admin options -->
        <?php wpdc_the_pageoptions($pageoptions);?>

        <!-- change status to members -->
        <?php include(locate_template('templates/sections/config-changememberstatus.php')); ?>

        <!-- doclist -->
        <?php include(locate_template('templates/sections/listing-docs.php')); ?>

        <!-- manage documents -->
        <?php include(locate_template('templates/sections/config-managedocs.php')); ?>

        <!-- new user -->
        <?php include(locate_template('templates/sections/user-create.php')); ?>

        <!-- asociatelist -->
        <?php
        $users = $socios;
        $list_type = 'socios';
        $list_ID = 'asociatelist';
        include(locate_template('templates/sections/listing-user.php'));
        ?>

        <!-- userlist -->
        <?php
        $users = $subscribers;
        $list_type = 'usuarios';
        $list_ID = 'userlist';
        include(locate_template('templates/sections/listing-user.php'));
        ?>

          
    </div>

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>