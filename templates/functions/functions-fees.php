<?php


if (!post_type_exists('fee')) {
	add_action( 'init', 'fees_post_type', 0 );
}
if (post_type_exists('fees')) {
	//unregister_post_type( 'fees' );
}

/**
 * CREATING A FUNCTION TO CREATE FEES CPT
 ***********************************/
function fees_post_type() {

	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Fees', 'Post Type General Name', 'wp-design-community' ),
		'singular_name'       => _x( 'Fee', 'Post Type Singular Name', 'wp-design-community' ),
		'menu_name'           => __( 'Fees', 'wp-design-community' ),
		'parent_item_colon'   => __( 'Parent Fee', 'wp-design-community' ),
		'all_items'           => __( 'All Fees', 'wp-design-community' ),
		'view_item'           => __( 'View Fee', 'wp-design-community' ),
		'add_new_item'        => __( 'Add New Fee', 'wp-design-community' ),
		'add_new'             => __( 'Add New', 'wp-design-community' ),
		'edit_item'           => __( 'Edit Fee', 'wp-design-community' ),
		'update_item'         => __( 'Update Fee', 'wp-design-community' ),
		'search_items'        => __( 'Search Fee', 'wp-design-community' ),
		'not_found'           => __( 'Not Found', 'wp-design-community' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'wp-design-community' ),
	);
	
	// Set other options for Custom Post Type
	$args = array(
		'label'               => __( 'fee', 'wp-design-community' ),
		'description'         => __( 'Fees', 'wp-design-community' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', ),
		'hierarchical'        => true,
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
	register_post_type( 'fee', $args );
	flush_rewrite_rules();
}

?>