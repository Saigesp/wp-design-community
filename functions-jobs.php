<?php


if (!post_type_exists('jobs')) {
	add_action( 'init', 'jobs_post_type', 0 );
}

/**
 * CREATING A FUNCTION TO CREATE FEES CPT
 ***********************************/
function jobs_post_type() {

	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Trabajos', 'Post Type General Name', 'wp-design-community' ),
		'singular_name'       => _x( 'trabajo', 'Post Type Singular Name', 'wp-design-community' ),
		'menu_name'           => __( 'Trabajos', 'wp-design-community' ),
		'parent_item_colon'   => __( 'Trabajo padre', 'wp-design-community' ),
		'all_items'           => __( 'Trabajos', 'wp-design-community' ),
		'view_item'           => __( 'Ver trabajo', 'wp-design-community' ),
		'add_new_item'        => __( 'Nuevo trabajo', 'wp-design-community' ),
		'add_new'             => __( 'Añadir trabajo', 'wp-design-community' ),
		'edit_item'           => __( 'Editar trabajo', 'wp-design-community' ),
		'update_item'         => __( 'Actualizar trabajo', 'wp-design-community' ),
		'search_items'        => __( 'Burcar trabajo', 'wp-design-community' ),
		'not_found'           => __( 'No se encontraron trabajos', 'wp-design-community' ),
		'not_found_in_trash'  => __( 'No se encontraron trabajos en la papelera', 'wp-design-community' ),
	);
	
	// Set other options for Custom Post Type
	$args = array(
		'label'               => __( 'jobs', 'wp-design-community' ),
		'description'         => __( 'jobs', 'wp-design-community' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);

	// Registering your Custom Post Type
	register_post_type( 'jobs', $args );
	flush_rewrite_rules();
}

?>