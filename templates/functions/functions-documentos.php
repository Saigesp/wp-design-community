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



/* CREAR DOCUMENTOS
*
*****************************************************
*/

/*
add_action('wp_ajax_cvf_upload_files', 'cvf_upload_files');
add_action('wp_ajax_nopriv_cvf_upload_files', 'cvf_upload_files'); // Allow front-end submission 

function cvf_upload_files(){
    
    $parent_post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : 0;  // The parent ID of our attachments
    $valid_formats = array("pdf", "zip"); // Supported file types
    $max_file_size = 1024 * 500; // in kb
    $max_image_upload = 10; // Define how many images can be uploaded to the current post
    $wp_upload_dir = wp_upload_dir();
    $path = $wp_upload_dir['path'] . '/';
    $count = 0;

    // Image upload handler
    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
        
        // Check if user is trying to upload more than the allowed number of images for the current post
        if( count($_FILES['files']['name']) > $max_image_upload) {

            $upload_message[] = "Sorry you can only upload " . $max_image_upload . " images for each Ad";

        } else {

          $publish_status = 'publish';
          $publish_type = 'documentos';

          $post_information = array(
              'post_title' => wp_strip_all_tags( $_POST['doc_name'] ),
              'post_content' => 'Ey',
              'post_type' => $publish_type,
              'post_status' => $publish_status,
          );

          $post_id = wp_insert_post( $post_information );

            
            foreach ( $_FILES['files']['name'] as $f => $name ) {
                $extension = pathinfo( $name, PATHINFO_EXTENSION );
                $new_filename = $name;
                
                if ( $_FILES['files']['error'][$f] == 4 ) {
                    continue; 
                }
                
                if ( $_FILES['files']['error'][$f] == 0 ) {
                    // Check if image size is larger than the allowed file size
                    if ( $_FILES['files']['size'][$f] > $max_file_size ) {
                        $upload_message[] = "$name is too large!.";
                        continue;
                    
                    // Check if the file being uploaded is in the allowed file types
                    } elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
                        $upload_message[] = "$name is not a valid format";
                        continue; 
                    
                    } else{ 
                        // If no errors, upload the file...
                        if( move_uploaded_file( $_FILES["files"]["tmp_name"][$f], $path.$new_filename ) ) {
                            
                            $count++; 

                            $filename = $path.$new_filename;
                            $filetype = wp_check_filetype( basename( $filename ), null );
                            $wp_upload_dir = wp_upload_dir();
                            $attachment = array(
                                'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
                                'post_mime_type' => $filetype['type'],
                                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                                'post_content'   => '',
                                'post_status'    => 'inherit'
                            );
                            // Insert attachment to the database
                            $attach_id = wp_insert_attachment( $attachment, $filename, $post_id );

                            require_once( ABSPATH . 'wp-admin/includes/image.php' );
                            
                            // Generate meta data
                            $attach_data = wp_generate_attachment_metadata( $attach_id, $filename ); 
                            wp_update_attachment_metadata( $attach_id, $attach_data );

                            $msg = "ey";
                            $args   = array(
                                'type'          => 'success', //success, info, warning
                                'where'         => 'meeseeks',
                                'auto_close'    => true,
                                'delay'         => '5', // s
                                );
                            new Frontend_box( $msg, $args);
                            
                        }
                    }
                }
            }
        }
    }
    // Loop through each error then output it to the screen
    if ( isset( $upload_message ) ) :
        foreach ( $upload_message as $msg ){        
            printf( __('<p class="bg-danger">%s</p>', 'wp-trade'), $msg );
        }
    endif;
    
    // If no error, show success message
    if( $count != 0 ){
        printf( __('<p class = "bg-success">%d files added successfully!</p>', 'wp-trade'), $count );   
    }
    
    exit();
}
*/

?>