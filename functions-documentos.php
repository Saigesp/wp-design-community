<?php


if (!post_type_exists('documentos')) {
	add_action( 'init', 'documentos_post_type', 0 );
}

/**
 * CREATING A FUNCTION TO CREATE FEES CPT
 ***********************************/
function documentos_post_type() {

	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Documentos', 'Post Type General Name', 'wp-design-community' ),
		'singular_name'       => _x( 'documento', 'Post Type Singular Name', 'wp-design-community' ),
		'menu_name'           => __( 'Documentos', 'wp-design-community' ),
		'parent_item_colon'   => __( 'Documento padre', 'wp-design-community' ),
		'all_items'           => __( 'Documentos', 'wp-design-community' ),
		'view_item'           => __( 'Ver documento', 'wp-design-community' ),
		'add_new_item'        => __( 'Nuevo documento', 'wp-design-community' ),
		'add_new'             => __( 'Añadir documento', 'wp-design-community' ),
		'edit_item'           => __( 'Editar documento', 'wp-design-community' ),
		'update_item'         => __( 'Actualizar documento', 'wp-design-community' ),
		'search_items'        => __( 'Burcar documento', 'wp-design-community' ),
		'not_found'           => __( 'No se encontraron documentos', 'wp-design-community' ),
		'not_found_in_trash'  => __( 'No se encontraron documentos en la papelera', 'wp-design-community' ),
	);
	
	// Set other options for Custom Post Type
	$args = array(
		'label'               => __( 'documentos', 'wp-design-community' ),
		'description'         => __( 'documentos', 'wp-design-community' ),
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
	register_post_type( 'documentos', $args );
	flush_rewrite_rules();
}

?>