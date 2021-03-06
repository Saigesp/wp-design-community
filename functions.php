<?php

/**
 * GENERAL FUNCTIONS
 ***********************************/
// Add more functions
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
include_once(locate_template('templates/functions/functions-scripts.php'));
include_once(locate_template('templates/components.php'));
include_once(locate_template('templates/functions/functions-options.php'));
include_once(locate_template('templates/functions/functions-twitter.php')); // TODO Poner si está activada opción de twitter
include_once(locate_template('templates/functions/functions-fees.php'));
include_once(locate_template('templates/functions/functions-jobs.php'));
include_once(locate_template('templates/functions/functions-concursos.php'));
include_once(locate_template('templates/functions/functions-documentos.php'));

// Notificaciones https://timersys.com/create-bootstraps-style-alert-boxes-theme
include_once(locate_template('plugins/frontend-notifications/class-frontend-box.php'));

//AJAX
function ajax_script_FTW() {
  wp_enqueue_script( 'ajax', get_template_directory_uri() . '/plugins/ajax.js', array( 'jquery' ), '1.0.0', true );
  wp_localize_script( 'ajax', 'Ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'ajax_script_FTW' );


// Hide admin bar
add_filter('show_admin_bar', '__return_false');

// Active thumbnails
add_theme_support( 'post-thumbnails' );

function wpdc_widgets_init() {
  register_sidebar(array(
    'name' => __( 'Calendar', 'wpdc' ),
    'id' => 'sidebar-1',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
  ));
}
add_action( 'init', 'wpdc_widgets_init' );

// Active menus
register_nav_menus( array(
  'menutop' => 'Top Menu',
  'menuheader' => 'Header Menu',
  'menumiddle' => 'Menu medio',
	'menufooter' => 'Menu inferior',
) );

// Create pages to extend theme
new_page_title('Edit Event');
new_page_title('Edit Profile');
new_page_title('Edit Concursos');
new_page_title('Edit Jobs');
new_page_title('Edit Posts');
new_page_title('Control Users');
new_page_title('Configuration admin');
new_page_title('Configuration presidence');
new_page_title('Configuration treasury');
new_page_title('Configuration secretary');
new_page_title('Configuration concursos');
new_page_title('Configuration jobs');
new_page_title('Configuration posts');
new_page_title('Configuration events');
new_page_title('Invitar');
new_page_title('Upgrade');

new_page_title('Disenadores');

// Create pages
function new_page_title($post_title){
  if(get_page_by_title($post_title) == NULL){
    global $user_ID;
    $new_post = array(
      'post_title' => $post_title,
      'post_content' => '[WP-Design-Community-Page]',
      'post_status' => 'publish',
      'post_date' => date('Y-m-d H:i:s'),
      'post_author' => $user_ID,
      'post_type' => 'page',
      'post_category' => array(0)
    );
    $post_id = wp_insert_post($new_post);
  }
}

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/default/logo600x600.png);
            background-size: 80px 80px;
        }
        #nav { display: none; }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Configure meta title
function filter_wp_title($title) {
  if (is_author()){
    $filtered_title = get_the_author_meta('first_name', 1) . ' '. get_the_author_meta('last_name', 1);
    return $filtered_title;
  }elseif(is_search()){
    $filtered_title = 'Búsqueda';
    return $filtered_title;
  }else{
    return $title;
  }
}
add_filter( 'wp_title', 'filter_wp_title' );

// Get current url
function current_url() {
    global $wp;
    $current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
    return $current_url;
}

// Get current page url
function current_page_url() {
    global $wp;
    $current_url = $wp->request;
    return $current_url;
}

// Check user role
function is_user_role( $role, $user_id = null ) {
    if (is_numeric($user_id)) $user = get_userdata($user_id);
    else $user = wp_get_current_user();
    if (empty($user)) return false;
    return in_array( $role, (array) $user->roles );
}

// Check if post ID exist
function post_id_exists( $id ) {
  return is_string( get_post_status( $id ) );
}

// Actions when user is validated
function user_confirmed($user_id) {
   //user_confirmed_email($user_id);
   $op_user = get_user_meta($user_id, 'op_user', true );
   $op_user['validate_date'] = current_time('mysql');
   update_user_meta($user_id, 'op_user', $op_user );
   //tweet_confirmed_user( $user_id, 'author' );
}

// Register last login
function reg_last_login($login) {
    global $user_ID;
    $user = get_userdatabylogin($login);
    update_usermeta($user->ID, 'last_login', current_time('mysql'));
}
function get_last_login($user_id) {
    $last_login = get_user_meta($user_id, 'last_login', true);
    return $last_login;
}
// Echo last login
function the_last_login($user_id) {
    $last_login = get_user_meta($user_id, 'last_login', true);
    echo $last_login;
}
add_action('wp_login','reg_last_login');

// Random user query
function wp_user_query_random_enable($query) {
    if($query->query_vars["orderby"] == 'rand') {
        $query->query_orderby = 'ORDER by RAND()';
    }
}
add_filter('pre_user_query', 'wp_user_query_random_enable');

// Add theme user meta
function add_op_user_meta($user_id) {
  $user_meta = get_user_meta($user_id);
  $validate_date = 0;
  $last_fee = 0;
  $op_user = array(
    'karma' => 10,
    'invitations' => 0,
    'likes' => array( 0 ),
    'has_invited' => array( 0 ),
    'has_validate' => array( 0 ),
    'validated_by' => array( 0 ),
    'has_denunced' => array( 0 ),
    'denunced_by' => array( 0 ),
    'has_upvote' => array( 0 ),
    'upvotedby' => array( 0 ),
  );
  update_user_meta( $user_id, 'op_user', $op_user );
  update_user_meta( $user_id, 'validate_date', $validate_date );
  update_user_meta( $user_id, 'last_fee', $last_fee );
}
add_action( 'user_register', 'add_op_user_meta', 10, 1 );

// Update theme user meta
function update_op_user_meta($user_id, $field, $input){
  $op_user = get_user_meta($user_id, 'op_user', true );
  if(isset($op_user)){
    foreach ($op_user as $key => $value) {
      if($key == $field) $value = $input;
    }
    update_user_meta($user_id, 'op_user', $op_user ); 
  } 
}


/**
 * USER NOTIFICATIONS
 ***********************************/
// Add user notifications track
function add_user_notification_track($user_id, $type = 'notification', $msg = ''){
  if($user_id > 0){
    $user_notification_track = get_user_meta($user_id, 'user_notification_track', true );
    if(!is_array($user_notification_track)) $user_notification_track = array();
    $newtrack = [
      'type' => $type,
      'date' => current_time('mysql'),
      'status' => 'new',
      'changeby' => get_current_user_id(),
      'msg' => $msg
    ];
    array_push($user_notification_track, $newtrack);
    update_user_meta($user_id, 'user_notification_track', $user_notification_track );
  }
} 
// Update user notifications track
function update_user_notification_track($user_id, $date, $key, $value){
  if($user_id > 0 && validateDate($date)){
    $user_notification_track = get_user_meta($user_id, 'user_notification_track', true );
    if(is_array($user_notification_track)){
      foreach ($user_notification_track as $track) {
        if($track['date'] == $date) {
          $track[$key] = $value;
          break;
        }
      }
      update_user_meta($user_id, 'user_notification_track', $user_notification_track );
    }
  }
} 

// Get user notifications track
function get_user_notification_track($user_id, $filterkey = '', $filtervalue = ''){
  if($user_id > 0){
    $user_notification_track = get_user_meta($user_id, 'user_notification_track', true );
    if(!is_array($user_notification_track)) $user_notification_track = [];
    if($filterkey != '' && $filtervalue != ''){
      $output = [];
      foreach ($user_notification_track as $track) {
        if($track[$filterkey] == $filtervalue) array_push($output, $track);
      }
      $user_notification_track = $output;
    }

    return $user_notification_track;
  }
}  

// Clean user notifications track
function clean_user_notification_track($user_id, $date = '', $type = ''){
  if(validateDate($date) && $user_id > 0){
/* ¿Es necesario volver a ordenar los elementos?
    $user_notification_track = get_user_meta($user_id, 'user_notification_track', true );
    if(is_array($user_notification_track)){
      $ntf_i = 0;
      $ntf_s = -1;
      foreach ($user_notification_track as $track) {
        if($track['date'] == $date) {
          $ntf_s = $ntf_i++;
          break;
        }
      }
      if($ntf_s > -1){
        unset($user_notification_track[$ntf_s]);
      }

    }
    array_push($user_notification_track, $newtrack);
    update_user_meta($user_id, 'user_notification_track', $user_notification_track );
    */
  }elseif($user_id > 0 && $date == 'all'){
    if($type == 'all'){
      $user_notification_track = [];
      update_user_meta($user_id, 'user_notification_track', $user_notification_track );
    }else{
      $user_notification_track = get_user_meta($user_id, 'user_notification_track', true );
      if(is_array($user_notification_track)){
        $output = [];
        foreach ($user_notification_track as $track) {
          if($track['type'] != $type) array_push($output, $track);
        }
        $user_notification_track = $output;
        update_user_meta($user_id, 'user_notification_track', $user_notification_track );
      }
    }
  }
} 

/**
 * USER REGISTRY TRACK
 ***********************************/
// Update user registry process track
function update_user_registry_track($user_id, $status){
  if($user_id > 0){
    
    $user_registry_track = get_user_meta($user_id, 'user_registry_track', true );
    
    if(!is_array($user_registry_track)) $user_registry_track = [];

    $newtrack = [
      'date' => current_time('mysql'),
      'status' => $status,
      'changeby' => get_current_user_id(),
    ];
    
    array_push($user_registry_track, $newtrack);
    update_user_meta($user_id, 'user_registry_track', $user_registry_track );
  }

} 
// Get user registry process track
function get_user_registry_track($user_id){
  if($user_id > 0){
    $user_registry_track = get_user_meta($user_id, 'user_registry_track', true );
    if(!is_array($user_registry_track)) $user_registry_track = [];
    return $user_registry_track;
  }

} 


/**
 * REQUIRE WP PLUGINS
 ***********************************/
// Require & recommend plugins for WP
// http://tgmpluginactivation.com/
require_once dirname( __FILE__ ) . '/plugins/tgm-plugin-activation/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'mytheme_require_plugins' );

function mytheme_require_plugins() {
    $plugins = array(
      array(
        'name'      => 'WP Subtitle',
        'slug'      => 'wp-subtitle',
        'required'  => false,
      ),
      array(
        'name'      => 'Disqus Comment System',
        'slug'      => 'disqus-comment-system',
        'required'  => false, 
      ),
      array(
        'name'      => 'Events Manager',
        'slug'      => 'events-manager',
        'required'  => false, 
      ),
      array(
        'name'      => 'WP User Avatar',
        'slug'      => 'wp-user-avatar',
        'required'  => false, 
      )
    );
    $config = array();
    tgmpa( $plugins, $config );
}


/**
 * THEME CUSTOMIZATION FUNCTIONS
 ***********************************/
// Add section
function wpdcom_customize_register($wp_customize) {
  /* Colores */
  $wp_customize->add_section("colors", array(
    "title" => __("Colores", "customizer_colors_sections"),
    "priority" => 30,
  ));

  $wp_customize->add_setting("colors_code", array(
    "default" => "#7c6d6f",
    "transport" => "refresh",
  ));
  $wp_customize->add_control(
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'first_color', 
    array(
      'label'      => __( 'Color principal', 'wp-design-community' ),
      'section'    => 'colors',
      'settings'   => 'colors_code',
    ) ) 
  );

  $wp_customize->add_setting("colors_code_hover", array(
    "default" => "#c1312c",
    "transport" => "refresh",
  ));
  $wp_customize->add_control(
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'hover_color', 
    array(
      'label'      => __( 'Hover Color', 'wp-design-community' ),
      'section'    => 'colors',
      'settings'   => 'colors_code_hover',
    ) ) 
  );

  $wp_customize->add_setting("colors_code_back", array(
    "default" => "#f7f7f7",
    "transport" => "refresh",
  ));
  $wp_customize->add_control(
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'background_color', 
    array(
      'label'      => __( 'Color de fondo', 'wp-design-community' ),
      'section'    => 'colors',
      'settings'   => 'colors_code_back',
    ) ) 
  );

  $wp_customize->add_setting("colors_code_head", array(
    "default" => "#7c6d6f",
    "transport" => "refresh",
  ));
  $wp_customize->add_control(
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'head_color', 
    array(
      'label'      => __( 'Head y Footer', 'wp-design-community' ),
      'section'    => 'colors',
      'settings'   => 'colors_code_head',
    ) ) 
  );

  $wp_customize->add_setting("colors_code_head_c", array(
    "default" => "#ffffff",
    "transport" => "refresh",
  ));
  $wp_customize->add_control(
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'head_c_color', 
    array(
      'label'      => __( 'Head y Footer Texto', 'wp-design-community' ),
      'section'    => 'colors',
      'settings'   => 'colors_code_head_c',
    ) ) 
  );

  /* Logo */
  $wp_customize->add_section("logo", array(
    "title" => __("Logo", "customizer_logo_sections"),
    "priority" => 10,
  ));

  $wp_customize->add_setting("logo_file", array(
    "default" => "",
    "transport" => "refresh",
  ));
  $wp_customize->add_control(
    new WP_Customize_Media_Control( 
    $wp_customize, 
    'basic_logo_file', 
    array(
      'label'      => __( 'Logo medio 240x80 px', 'wp-design-community' ),
      'section'    => 'logo',
      'settings'   => 'logo_file',
      'mime_type' => 'image'
    ) ) 
  );

}

add_action("customize_register","wpdcom_customize_register");

function customizer_css() {
    ?>
    <style type="text/css">
        /* Color principal */
        a, .menumiddlenav > ul > li > a, .titletextarch a, .categoryarch a, .articlearch--nothumb .authorarch a,
        .articlearch--nothumb .datearch {
          color: <?php echo get_theme_mod( 'colors_code' ); ?>;
        }
        .menumiddlenav ul > li.has-sub > a:before, .menumiddlenav ul > li.has-sub > a:after {
          background-color: <?php echo get_theme_mod( 'colors_code' ); ?>;
        }
        /* Hover color */
        .titletextarch a:hover, .titletextarch a:focus, .titletextarch a:active, .footerback p a:hover {
          color: <?php echo get_theme_mod( 'colors_code_hover' ); ?>;
        }
        #hamburguer:hover, .sharecontainer svg:hover, .footerback svg:hover {
          fill: <?php echo get_theme_mod( 'colors_code_hover' ); ?>;
        }
        /* Color de fondo */
        body, #wrapper, .menumiddlenav > ul > li > a {
          background-color: <?php echo get_theme_mod( 'colors_code_back' ); ?>;
        }
        /* Color de cabecera y footer */
        .headertop, .footerback {
          background-color: <?php echo get_theme_mod( 'colors_code_head' ); ?>;
        }
        /* Color de cabecera y footer texto */
        .footerback p, .footerback p a {
          color: <?php echo get_theme_mod( 'colors_code_head_c' ); ?>;
        }
        #hamburguer, .sharecontainer svg, .footerback svg {
          fill: <?php echo get_theme_mod( 'colors_code_head_c' ); ?>;
        }
        @media only screen and (min-width: 550px){
          .authorarch a {
            color: <?php echo get_theme_mod( 'colors_code' ); ?>;
          }
          /* Hover color */
          .articlearch .titletextarch a:hover, .articlearch .categoryarch a:hover {
            color: <?php echo get_theme_mod( 'colors_code_hover' ); ?>;
          }
        }
    </style>
    <?php
}
//add_action( 'wp_head', 'customizer_css' );







/**
 * PUBLISH FUNCTIONS
 ***********************************/
// Add character counter on excerpt
function excerpt_count_js(){
    $limite = 100;
    if ('page' != get_post_type()) {
        echo '<script>
            jQuery(document).ready(function(){
              if(jQuery("#postexcerpt .handlediv").length > 0){
                jQuery("#postexcerpt .handlediv").after("<div style=\"position:absolute;top:12px;right:34px;color:#666;\"><small>Excerpt length: </small><span id=\"excerpt_counter\"></span><span style=\"font-weight:bold; padding-left:7px;\">/ '.$limite.'</span><small><span style=\"font-weight:bold; padding-left:7px;\">character(s).</span></small></div>");
                jQuery("span#excerpt_counter").text(jQuery("#excerpt").val().length);
                jQuery("#excerpt").keyup( function() {
                    if(jQuery(this).val().length > '.$limite.'){
                        jQuery(this).val(jQuery(this).val().substr(0, '.$limite.'));
                    }
                    jQuery("span#excerpt_counter").text(jQuery("#excerpt").val().length);
                });
              }
            });
        </script>';
    }
}
add_action( 'admin_head-post.php', 'excerpt_count_js');
add_action( 'admin_head-post-new.php', 'excerpt_count_js');

// Add style select on WYSIWYG
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

// Add styles on WYSIWYG
function wpdcom_editor_styles() {
   // add_editor_style( get_stylesheet_directory_uri().'/css/custom-editor-style.css' );
}
add_action( 'admin_init', 'wpdcom_editor_styles' );

// Add typography on WYSIWYG
function my_theme_add_editor_styles() {
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Merriweather:400italic,400,900,300,700,700italic|Merriweather+Sans:400,700,800|Open+Sans:400italic,400,300,700,800,600' );
    add_editor_style( $font_url );
}
//add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );





/**
 * MANAGE COMMENTS IN AJAX
 ***********************************/

function delete_post(){
  $permission = check_ajax_referer( 'my_delete_post_nonce', 'nonce', false );
  if( $permission == false ) die();
  else wp_delete_comment($_REQUEST['id'], false);
  die();
}
add_action( 'wp_ajax_delete_post', 'delete_post' );

function delete_post_FTW(){
  $permission = check_ajax_referer( 'my_delete_post_nonce', 'nonce', false );
  if( $permission == false ) die();
  else wp_delete_comment($_REQUEST['id'], true);
  die();
}
add_action( 'wp_ajax_delete_post_FTW', 'delete_post_FTW' );

function aprove_post_FTW(){
  $permission = check_ajax_referer( 'my_delete_post_nonce', 'nonce', false );
  if( $permission == false ) die();
  else wp_set_comment_status( $_REQUEST['id'],'approve');
  die();
}
add_action( 'wp_ajax_approve_post_FTW', 'aprove_post_FTW' );




/**
 * FUNCIONES DE IMÁGENES Y VÍDEO
 ***********************************/

// Quitar wrap <p> de imágenes
function filter_ptags_on_images($content){
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    $content = preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
  	return $content;
}
add_filter('the_content', 'filter_ptags_on_images');

// Poner wrap <figure> de captions
function jk_img_caption_shortcode_filter($val, $attr, $content = null){
    extract(shortcode_atts(array(
        'id'      => '',
        'align'   => 'aligncenter',
        'width'   => '',
        'caption' => ''
    ), $attr));
    if ( 1 > (int) $width || empty($caption) ) return $val;
    if ( $id ) $id = esc_attr( $id );
    $content = str_replace('<img', '<img itemprop="contentURL"', $content);
    return '<figure id="'.$id.'" class="wp-caption '.esc_attr($align).'" itemscope itemtype="http://schema.org/ImageObject" style="width: ' . (0 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption id="figcaption_'. $id . '" class="wp-caption-text" itemprop="description">' . $caption . '</figcaption></figure>';
}
add_filter( 'img_caption_shortcode', 'jk_img_caption_shortcode_filter', 10, 3 );

// Añadir <figure> a imágenes en el editor
function html5_insert_image($html, $id, $caption, $title, $align, $url) {
    if(!$caption){
        $html5 = '<figure id="post-'.$id.'" class="align-img'.$align.'">';
        $html5 .= $html;//'<img src="'.$url.'" alt="'.$title.'"/>';
        $html5 .= "</figure>";
        return $html5;
    }else{
        return $html;
    }
}
add_filter( 'image_send_to_editor', 'html5_insert_image', 10, 9 );

// Poner wrap en video
function my_embed_oembed_html($html, $url, $attr, $post_id) {
  return '<div class="video-wrap"><div class="video-container">' . $html . '</div></div>';
}
add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);

// Quitar link automático de imágenes
function rkv_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	
	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'rkv_imagelink_setup', 10);

// Añadir propiedad og:image:url para compartir thumbnail
function insert_image_src_rel_in_head() {
  global $post;
  if ( !is_singular()) return;
  if(!has_post_thumbnail( $post->ID )) { 
    $default_image="http://blog.talkandcode.com/wp-content/themes/tandc/img/favicon.png"; 
    echo '<meta property="og:image" content="' . $default_image . '"/>';
  }else{
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
    echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
    echo '<meta property="og:image:url" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
  }
  echo "";
}
add_action( 'wp_head', 'insert_image_src_rel_in_head', 5 );






/**
 * FUNCIONES DE TAXONOMÍA
 ***********************************/

// Quitar <p> de categorías y etiquetas
remove_filter('term_description','wpautop');

// Añadir taxonomía de idioma
function add_custom_taxonomies() {
  register_taxonomy('customlanguage', 'post', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x( 'Idiomas', 'taxonomy general name' ),
      'singular_name' => _x( 'Idioma', 'taxonomy singular name' ),
      'search_items' =>  __( 'Buscar idioma' ),
      'all_items' => __( 'Idiomas' ),
      'parent_item' => __( 'Idioma padre' ),
      'parent_item_colon' => __( 'Idioma padre:' ),
      'edit_item' => __( 'Editar idioma' ),
      'update_item' => __( 'Actualizar idioma' ),
      'add_new_item' => __( 'Añadir nuevo idioma' ),
      'new_item_name' => __( 'Nombre del nuevo idioma' ),
      'menu_name' => __( 'Idiomas' ),
    ),
    'rewrite' => array(
      'slug' => 'languages',
      'with_front' => false, 
      'hierarchical' => true
    ),
  ));
}
add_action( 'init', 'add_custom_taxonomies', 0 );

// Ocultar botón nuevos idiomas
function hide_newtax_languages(){
echo "\n" . '<script type="text/javascript">
jQuery(document).ready(function($) {
    $(\'#customlanguage-adder\').hide();  
});
</script>' . "\n";
}
add_action('admin_head','hide_newtax_languages');

// Ocultar link de taxonomía en el admin
function remove_menu_item() {
 remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=customlanguage' );
}
add_action( 'admin_menu', 'remove_menu_item' );








/**
 * FUNCIONES DE USUARIO
 ***********************************/

// Crear usuario
if (!function_exists('create_new_member')) {
  function create_new_member($email_address, $username){
    if ($username == '' || $username == null) $username = $email_address;
    if ( null == username_exists( $email_address ) && $email_address!= '') {
      $password = wp_generate_password( 12, false );
      $user_id = wp_create_user( $username, $password, $email_address );
      wp_update_user(array( 'ID' => $user_id, 'nickname' => $username));    
    }
  }
}


// Añadir meta de usuario
if (!function_exists('cb_contact_data')) {  
    function cb_contact_data($contactmethods) {
        unset($contactmethods['aim']);
        unset($contactmethods['yim']);
        unset($contactmethods['jabber']);
        if ( is_admin() == true ) {
            $contactmethods['publicemail'] = 'Public Email';
            $contactmethods['position'] = 'Position'; 
        }
        $contactmethods['twitter'] = 'Twitter (sin @)';
        $contactmethods['googleplus'] = 'Google+ (url entera)';
        $contactmethods['linkedin'] = 'Linkedin (url entera)';
         
        return $contactmethods;
    }
}
add_filter('user_contactmethods', 'cb_contact_data');

// Ocultar opciones de color de usuario
remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');

// Ocultar otras opciones de usuario
function hide_personal_options(){
echo "\n" . '<script type="text/javascript">
jQuery(document).ready(function($) {
    $(\'form#your-profile > h3:first\').hide();
    $(\'form#your-profile > table:first\').hide();
    $(\'form#your-profile\').show();
  
});
</script>' . "\n";
}
add_action('admin_head','hide_personal_options');

// Ocultar TinyMCE
if( !is_admin() ){
  add_filter( 'user_can_richedit' , '__return_false', 50 );
}

// Add charge in organization
function wpdc_add_custom_user_profile_fields( $user ) {
?>
  <h3>Información sobre el socio</h3>
  <table class="form-table">
    <tr>
      <th><label for="dbem_phone">DNI</label></th>
      <td><input type="text" name="dbem_dnie" value="<?php echo esc_attr(get_the_author_meta('dbem_dnie', $user->ID));?>"/></td>
    </tr>
    <?php if (!is_plugin_active('events-manager/events-manager.php')){ ?> 
    <tr>
      <th><label for="dbem_address">Dirección</label></th>
      <td><input type="text" name="dbem_address" value="<?php echo esc_attr(get_the_author_meta('dbem_address', $user->ID));?>"/></td>
    </tr>
    <tr>
      <th><label for="dbem_phone">Teléfono</label></th>
      <td><input type="text" name="dbem_phone" value="<?php echo esc_attr(get_the_author_meta('dbem_phone', $user->ID));?>"/></td>
    </tr>
    <?php } ?>
  </table>

  <h3>Información organizativa</h3>
  <table class="form-table">
    <tr>
      <th><label for="asociation_position">Rol organizativo</label></th>
      <td>
        <select name="asociation_position">
              <option value="" <?php if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == '') echo 'selected';?>>Ninguno</option>
              <option value="presidente" <?php if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == 'presidente') echo 'selected';?>>Presidente</option>
              <option value="vicepresidente" <?php if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == 'vicepresidente') echo 'selected';?>>Vicepresidente</option>
              <option value="tesorero" <?php if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == 'tesorero') echo 'selected';?>>Tesorero</option>
              <option value="secretario" <?php if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == 'secretario') echo 'selected';?>>Secretario</option>
              <option value="vocal" <?php if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == 'vocal') echo 'selected';?>>Vocal</option>
        </select>
      </td>
    </tr>
    <tr>
      <th><label for="asociation_responsability">Responsabilidad organizativa</label></th>
      <td>
        <select name="asociation_responsability[]" multiple="multiple">
              <option value="" <?php if (esc_attr(get_the_author_meta('asociation_responsability', $user->ID)) == '') echo 'selected';?>>Ninguno</option>
              <option value="rp_posts" <?php if (esc_attr(get_the_author_meta('asociation_responsability', $user->ID)) == 'rp_posts') echo 'selected';?>>Responsable de artículos</option>
              <option value="rp_events" <?php if (esc_attr(get_the_author_meta('asociation_responsability', $user->ID)) == 'rp_events') echo 'selected';?>>Responsable de eventos</option>
              <option value="rp_concursos" <?php if (esc_attr(get_the_author_meta('asociation_responsability', $user->ID)) == 'rp_concursos') echo 'selected';?>>Responsable de concursos</option>
              <option value="rp_jobs" <?php if (esc_attr(get_the_author_meta('asociation_responsability', $user->ID)) == 'rp_jobs') echo 'selected';?>>Responsable de ofertas laborales</option>
        </select>
      </td>
    </tr>
  </table>
<?php }

function wpdc_save_custom_user_profile_fields( $user_id ) {
  if (!current_user_can('edit_user',$user_id)) return FALSE;
  update_usermeta( $user->ID, 'asociation_position', $_POST['asociation_position'] );
}

add_action( 'show_user_profile', 'wpdc_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'wpdc_add_custom_user_profile_fields' );
//add_action( 'personal_options_update', 'wpdc_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'wpdc_save_custom_user_profile_fields' );





/*
* FUNCIONES DE LOGIN
*********************************************/
/* redirect users after login */

function no_admin_init() {      
    // Is this the admin interface?
    if (stripos($_SERVER['REQUEST_URI'],'/wp-admin/') !== false // Look for the presence of /wp-admin/ in the url
        &&
        stripos($_SERVER['REQUEST_URI'],'async-upload.php') == false // Allow calls to async-upload.php
        &&
        stripos($_SERVER['REQUEST_URI'],'admin-ajax.php') == false // Allow calls to admin-ajax.php
        ) {

        if (!current_user_can('manage_options')){ 
          wp_redirect(get_option('home').'?action=login&success=true', 302);
        }
    }
}
// Add the action with maximum priority
add_action('init','no_admin_init',0);

// redirect all users after logout
function go_home(){
  wp_redirect( home_url() );
  exit();
}
add_action('wp_logout','go_home');

// redirect after fail login 
function my_front_end_login_fail($username){
    $referrer = $_SERVER['HTTP_REFERER'];
    if(!empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin')){
        wp_redirect(get_bloginfo('url').'?action=login&success=false'); 
    exit;
    }
}
add_action('wp_login_failed', 'my_front_end_login_fail'); 


/*
* SEND INVITATIONS (REGISTER) from frontend
* http://wordpress.stackexchange.com/questions/7134/front-end-register-form/7151#7151
*********************************************/
function register_a_user(){
  if(isset($_GET['do']) && $_GET['do'] == 'register'):

    $msg = '';
    if(empty($_POST['user_login']) || empty($_POST['user_email'])) $msg .= '<p>Campos incorrectos</p>';
    if(!empty($_POST['spam'])) $msg .= 'gtfo spammer';

    $user_login = esc_attr($_POST['user_login']);
    $user_email = esc_attr($_POST['user_email']);
    require_once(ABSPATH.WPINC.'/registration.php');

    $sanitized_user_login = sanitize_user($user_login);
    $user_email = apply_filters('user_registration_email', $user_email);

    if(!is_email($user_email)) $msg .= '<p>Email inválido</p>';
    elseif(email_exists($user_email)) $msg .= '<p>Email ya en uso</p>';

    if(empty($sanitized_user_login) || !validate_username($user_login)) $msg .= '<p>Nombre de usuario no válido</p>';
    elseif(username_exists($sanitized_user_login)) $msg .= '<p>Nombre de usuario ya existente</p>';

    if(!$msg){
      $user_pass = wp_generate_password();
      $user_id = wp_create_user($sanitized_user_login, $user_pass, $user_email);
      if(!$user_id){
        $msg .= 'Algo falló :(';
      }else{
        update_user_option($user_id, 'default_password_nag', true, true);
        wp_new_user_notification($user_id, $user_pass);
      }
    }
    if($msg){
      $args = array(
        'type'          => 'error', //success, info, warning
        'where'         => 'login',
        'auto_close'    => true,
        'delay'         => '5', // s
      );
    }
    else {
      $msg = 'Usuario creado y email envidado a '.$user_email;
      $args = array(
        'type'          => 'success', //success, info, warning
        'where'         => 'login',
        'auto_close'    => true,
        'delay'         => '5', // s
      );
    }
    new Frontend_box( $msg, $args);

  endif;
}
add_action('template_redirect', 'register_a_user');





// Translate role names
function change_role_name($rolename){
  if($rolename == 'subscriber') return 'Suscriptor';
  elseif($rolename == 'author') return 'Socio';
  elseif($rolename == 'editor') return 'Junta Directiva';
  elseif($rolename == 'administrator') return 'Informático';
  elseif($rolename == 'presidente') return 'Presidente';
  elseif($rolename == 'vicepresidente') return 'Vicepresidente';
  elseif($rolename == 'tesorero') return 'Tesorero';
  elseif($rolename == 'secretario') return 'Secretario';
  elseif($rolename == 'vocal') return 'Vocal';
  elseif($rolename == 'rp_events') return 'Resp. Eventos';
  elseif($rolename == 'rp_concursos') return 'Resp. Concursos';
  elseif($rolename == 'rp_jobs') return 'Resp. Ofertas laborales';
  elseif($rolename == 'rp_posts') return 'Resp. Noticias';
  elseif($rolename == '') return null;
  else return $rolename;
}
// Translate field names
function change_field_name($fieldname){
  if($fieldname == 'dbem_dnie')       return "DNI";
  elseif($fieldname == 'bornday')         return "Fecha de nacimiento";
  elseif($fieldname == 'dbem_phone')      return "Teléfono";
  elseif($fieldname == 'dbem_address')      return "Dirección";
  elseif($fieldname == 'titulacion')      return "Titulacíón";
  elseif($fieldname == 'centro_de_estudios')  return "Centro de estudios";
  elseif($fieldname == 'first_name')      return "Nombre";
  elseif($fieldname == 'last_name')      return "Apellidos";
  elseif($fieldname == 'email')         return "Email";
  else return $fieldname;
}

if(!function_exists('get_my_editable_roles')){
  function get_my_editable_roles() {
      global $wp_roles;
      $all_roles = $wp_roles->roles;
      $editable_roles = apply_filters('editable_roles', $all_roles);
      return $editable_roles;
  }
}




/* FUNCTION ADD/UPDATE OPTION */
if(!function_exists('change_options')){
  function change_options($option_name, $new_value, $load){
    if (get_option($option_name) !== false) {
      update_option( $option_name, $new_value );
    }else{
      $deprecated = null;
      $autoload = $load == null ? 'no' : $load;
      add_option( $option_name, $new_value, $deprecated, $autoload );
    }
  }
}



if(!function_exists('validateDate')){
  function validateDate($date, $format = 'Y-m-d H:i:s'){
      $d = DateTime::createFromFormat($format, $date);
      return $d && $d->format($format) == $date;
  }
}


?>