<?php


if (!post_type_exists('concursos')) {
	add_action( 'init', 'concursos_post_type', 0 );
}
if (post_type_exists('concurso')) {
	unregister_post_type( 'concurso' );
}

/**
 * CREATING A FUNCTION TO CREATE FEES CPT
 ***********************************/
function concursos_post_type() {

	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Concursos', 'Post Type General Name', 'wp-design-community' ),
		'singular_name'       => _x( 'Concurso', 'Post Type Singular Name', 'wp-design-community' ),
		'menu_name'           => __( 'Concursos', 'wp-design-community' ),
		'parent_item_colon'   => __( 'Concurso padre', 'wp-design-community' ),
		'all_items'           => __( 'Concursos', 'wp-design-community' ),
		'view_item'           => __( 'Ver concurso', 'wp-design-community' ),
		'add_new_item'        => __( 'Nuevo concurso', 'wp-design-community' ),
		'add_new'             => __( 'Añadir concurso', 'wp-design-community' ),
		'edit_item'           => __( 'Editar concurso', 'wp-design-community' ),
		'update_item'         => __( 'Actualizar concurso', 'wp-design-community' ),
		'search_items'        => __( 'Burcar concurso', 'wp-design-community' ),
		'not_found'           => __( 'No se encontraron concursos', 'wp-design-community' ),
		'not_found_in_trash'  => __( 'No se encontraron concursos en la papelera', 'wp-design-community' ),
	);
	
	// Set other options for Custom Post Type
	$args = array(
		'label'               => __( 'concursos', 'wp-design-community' ),
		'description'         => __( 'Concursos', 'wp-design-community' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail' ),
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
		'capability_type'     => 'page',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'concursos', $args );
	flush_rewrite_rules();
}

?>