<?php

/**
 * GENERAL FUNCTIONS
 ***********************************/
// Hide admin bar
add_filter('show_admin_bar', '__return_false');

// Active thumbnails
add_theme_support( 'post-thumbnails' );

// Active menus
register_nav_menus( array(
	'menutop' => 'Top Menu',
  'menumiddle' => 'Menu medio',
	'menufooter' => 'Menu inferior',
) );




/**
 * THEMING FUNCTIONS
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
        'name'      => 'WP User Avatar',
        'slug'      => 'wp-user-avatar',
        'required'  => false, 
      )
    );
    $config = array();
    tgmpa( $plugins, $config );
}


/**
 * CUSTOMIZE FUNCTIONS
 ***********************************/
// Add section
function wpdcom_customize_register($wp_customize) {
  $wp_customize->add_section("colors", array(
    "title" => __("Colores", "customizer_colors_sections"),
    "priority" => 30,
  ));

  $wp_customize->add_setting("colors_code", array(
    "default" => "",
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
  $wp_customize->add_setting("colors_code_back", array(
    "default" => "",
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
}

add_action("customize_register","wpdcom_customize_register");

function customizer_css() {
    ?>
    <style type="text/css">
        /* Color principal */
        a, .menumiddlenav > ul > li > a {
          color: <?php echo get_theme_mod( 'colors_code' ); ?>;
        }
        .footerback, .menumiddlenav ul > li.has-sub > a:before, .menumiddlenav ul > li.has-sub > a:after {
          background-color: <?php echo get_theme_mod( 'colors_code' ); ?>;
        }
        #hamburguer {
          fill: <?php echo get_theme_mod( 'colors_code' ); ?>;
        }
        /* Color de fondo */
        body, #wraparticle, .menumiddlenav > ul > li > a {
          background-color: <?php echo get_theme_mod( 'colors_code_back' ); ?>;
        }
        @media only screen and (min-width: 550px){
          .authorarch a {
            color: <?php echo get_theme_mod( 'colors_code' ); ?>;
          }
        }
    </style>
    <?php
}
add_action( 'wp_head', 'customizer_css' );




/**
 * PUBLISH FUNCTIONS
 ***********************************/
// Add character counter on excerpt
function excerpt_count_js(){
    $limite = 100;
    if ('page' != get_post_type()) {
        echo '<script>
            jQuery(document).ready(function(){
                jQuery("#postexcerpt .handlediv").after("<div style=\"position:absolute;top:12px;right:34px;color:#666;\"><small>Excerpt length: </small><span id=\"excerpt_counter\"></span><span style=\"font-weight:bold; padding-left:7px;\">/ '.$limite.'</span><small><span style=\"font-weight:bold; padding-left:7px;\">character(s).</span></small></div>");
                jQuery("span#excerpt_counter").text(jQuery("#excerpt").val().length);
                jQuery("#excerpt").keyup( function() {
                    if(jQuery(this).val().length > '.$limite.'){
                        jQuery(this).val(jQuery(this).val().substr(0, '.$limite.'));
                    }
                    jQuery("span#excerpt_counter").text(jQuery("#excerpt").val().length);
                });
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
    add_editor_style( get_stylesheet_directory_uri().'/css/custom-editor-style.css' );
}
add_action( 'admin_init', 'wpdcom_editor_styles' );

// Add typography on WYSIWYG
function my_theme_add_editor_styles() {
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Merriweather:400italic,400,900,300,700,700italic|Merriweather+Sans:400,700,800|Open+Sans:400italic,400,300,700,800,600' );
    add_editor_style( $font_url );
}
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );







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

/* // Bloquear nuevos idiomas
function no_more_languages($term, $taxonomy) {
    if ('customlanguage' === $taxonomy) {
        return new WP_Error('term_addition_blocked', __('Bloqueado por el diseñador. Consulta con un administrador o mira en functions.php.'));
    }
}
add_action( 'pre_insert_term', 'no_more_languages', 1, 2); */

// Ocultar link de taxonomía en el admin
function remove_menu_item() {
 remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=customlanguage' );
}
add_action( 'admin_menu', 'remove_menu_item' );








/**
 * FUNCIONES DE USUARIO
 ***********************************/

// Comprobar rol de usuario
function is_user_role( $role, $user_id = null ) {
    if (is_numeric($user_id))	$user = get_userdata($user_id);
    else $user = wp_get_current_user();
    if (empty($user))	return false;
    return in_array( $role, (array) $user->roles );
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


/**
 * FUNCIONES DE FILTRO DE IDIOMA
 ***********************************/

/* Generar url con $_GET de idioma
*
* El idioma que se le pase será falseado, por ejemplo
* hide_lang_url(ES) generará una url del tipo
* http://www.urlprevia.com/?es=false
*/
function hide_lang_url($hide_lang){
    global $wp;
    $current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
    if (strpos($current_url,'?') === false) $current_url .= '/?';
    if ($hide_lang == 'ES'  || $_GET['es']  == 'false') $current_url .= '&es=false';
    if ($hide_lang == 'EN'  || $_GET['en']  == 'false') $current_url .= '&en=false';
    if ($hide_lang == 'CAT' || $_GET['cat'] == 'false') $current_url .= '&cat=false';
    return $current_url;
}

/* Generar array de idiomas para la query
*
* Se realiza una query de taxonomia de customlanguage
* en función de los parámetros pasados a través de
* $_GET (se excluyen los que aparezcan como false)
*/
function retrieve_languages() {
  $languages = array('relation' => 'OR');
  $languages_reg = get_terms('customlanguage', array(
    'orderby'    => 'name',
    'hide_empty' => true,
  ));
  if (!empty($languages_reg) && !is_wp_error($languages_reg)){
    foreach ($languages_reg as $lang) {
      if ($_GET[strtolower($lang->name)] != 'false'){
        array_push ($languages, array(
          'taxonomy' => 'customlanguage',
          'field' => 'slug',
          'terms' => strtolower($lang->name)
        ));
      }
    }
  }
  return $languages;
}



//Obtener url actual
function current_url() {
    global $wp;
    $current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
    return $current_url;
}

?>