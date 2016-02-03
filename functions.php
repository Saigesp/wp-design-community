<?php



/*
* FUNCIONES ANEXAS
*********************************************/
include(locate_template('functions-twitter.php'));
include(locate_template('functions-options.php'));





/*
* OPCIONES GENERALES DE WORDPRESS
*********************************************/
/* Registro de menus */
register_nav_menus( array(
	'main_menu' => 'Main Menu',
  'profile_menu' => 'Profile Menu',
	'footer_menu' => 'Footer Menu',
) );

/* registro de sidebar */
register_sidebars(2, array('name'=>'Sidebar %d'));

/* Ocultar barra de administración */
add_filter('show_admin_bar', '__return_false');

/* Enable thumbnails */
add_theme_support( 'post-thumbnails' );

//remove_role('contributor');



/*
* LOGIN REDIRECT
*********************************************/
/* redirect nonadmin users after login */
function soi_login_redirect( $redirect_to, $request, $user  ) {
  return ( is_array( $user->roles ) && ( in_array('administrator',$user->roles) || in_array('editor',$user->roles) ) ) ? 'http://xn--diseadoresindustriales-nec.es/wp-admin' : 'http://xn--diseadoresindustriales-nec.es/modificar-perfil/';
} 
add_filter( 'login_redirect', 'soi_login_redirect', 10, 3 );

/* redirect all users after logout */
function go_home(){
  wp_redirect( home_url() );
  exit();
}
add_action('wp_logout','go_home');

/* redirect after fail login */
function my_front_end_login_fail($username){
    $referrer = $_SERVER['HTTP_REFERER'];
    if(!empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin')){
        wp_redirect('http://xn--diseadoresindustriales-nec.es/iniciar-sesion/'); 
    exit;
    }
}
add_action('wp_login_failed', 'my_front_end_login_fail'); 






/*
* CAMBIO DE URL DE USUARIOS
*********************************************/
/* cambiar user url */
add_filter('author_rewrite_rules', 'no_author_base_rewrite_rules');
function no_author_base_rewrite_rules($author_rewrite) { 
    global $wpdb;
    $author_rewrite = array();
    $authors = $wpdb->get_results("SELECT user_nicename AS nicename from $wpdb->users");    
    foreach($authors as $author) {
        $author_rewrite["({$author->nicename})/page/?([0-9]+)/?$"] = 'index.php?author_name=$matches[1]&paged=$matches[2]';
        $author_rewrite["({$author->nicename})/?$"] = 'index.php?author_name=$matches[1]';
    }   
    return $author_rewrite;
}

add_filter('author_link', 'no_author_base', 1000, 2);
function no_author_base($link, $author_id) {
    $link_base = trailingslashit(get_option('home'));
    $link = preg_replace("|^{$link_base}author/|", '', $link);
    return $link_base . $link;
}





/*
* VALIDACION DE USUARIOS MEDIANTE AJAX
*********************************************/
// custom jquery
wp_register_script( 'custom_js', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery' ), '1.0', TRUE );
wp_enqueue_script( 'custom_js' );
 
// validation
wp_register_script( 'validation', get_template_directory_uri() . '/js/jquery.validate.min.js', array( 'jquery' ) );
wp_enqueue_script( 'validation' );

add_action( 'wp_ajax_submit_checkboxes', 'updateCheckboxes' );
add_action('wp_enqueue_scripts', 'checkbox_scripts');
function checkbox_scripts() {
  $parameters = array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('checkbox')
  );
  wp_enqueue_script('checkbox-ajax', get_template_directory_uri().'/js/ajax.js', array('jquery'), null, true);
  wp_localize_script('checkbox-ajax', 'checkbox', $parameters );
}

function updateCheckboxes() {
  if(empty($_POST) || !isset($_POST)) {
  } else {
    $data = $_POST;
    $dataString = $data['post'];
    parse_str($dataString, $dataArray);
    $nonce = $data['nonce'];
    if(wp_verify_nonce($nonce, 'checkbox') !== false) {
      $user_current = get_current_user_id();
      $user_id = $dataArray['userid'];
      if($user_current != NULL) {
				$op_user = get_user_meta( $user_id, 'op_user', true);
        $op_current = get_user_meta( $user_current, 'op_user', true);
        if (!in_array($user_current, $op_user['hasiovalidado'])){
          array_push($op_user['hasiovalidado'], $user_current);
          array_push($op_current['havalidado'], $user_id);
        } else {
          foreach($op_user['hasiovalidado'] as $k => $v){
            if ($v == $user_current) unset($op_user['hasiovalidado'][$k]);
            }
          foreach($op_current['havalidado'] as $k => $v){
            if ($v == $user_id) unset($op_current['havalidado'][$k]);
            }
        }
        if ( (count($op_user['hasiovalidado']) == get_option("validation_count") || in_array('1', $op_user['hasiovalidado'])) && (!is_user_role('author',$user_id) && !is_user_role('editor',$user_id)) ){
						$user = new WP_User($user_id);
   					$user->remove_role('subscriber');
   					$user->add_role('author');
          	user_confirmed( $user_id);
          	$validate_date = current_time('mysql');
        }
        if (count($op_user['hasiovalidado']) < get_option("validation_count") && !in_array('1', $op_user['hasiovalidado'])){
						$user = new WP_User($user_id);
   					$user->remove_role('author');
   					$user->add_role('subscriber');
        }
        update_user_meta($user_id, 'op_user', $op_user );
        update_user_meta($user_id, 'validate_date', $validate_date );
        update_user_meta($user_current, 'op_user', $op_current );
      } 
    } 
  }
}


/*
* FUNCIONES PRINCIPALES DEL TEMA
*********************************************/
/* Email if user is denunced  */
function user_denunced( $user_id, $user_current ) {
	 user_denunced_email( $user_id, $user_current );
   $op_user = get_user_meta($user_id, 'op_user', true );
	 $op_user_current = get_user_meta($user_current, 'op_user', true );
   array_push($op_user['hasiodenunciado'], $user_current);
   array_push($op_user_current['hadenunciado'], $user_id);
   update_user_meta($user_id, 'op_user', $op_user );
   update_user_meta($user_current, 'op_user', $op_user_current );
  }

/* Acciones cuando usuaro es validado  */
function user_confirmed($user_id) {
	 user_confirmed_email($user_id);
   $op_user = get_user_meta($user_id, 'op_user', true );
   $op_user['validate_date'] = current_time('mysql');
   update_user_meta($user_id, 'op_user', $op_user );
   tweet_confirmed_user( $user_id, 'author' );
  }

/* Comprobar rol de usuario */
function is_user_role( $role, $user_id = null ) {
    if (is_numeric($user_id))	$user = get_userdata($user_id);
    else $user = wp_get_current_user();
    if (empty($user))	return false;
    return in_array( $role, (array) $user->roles );
}

/* Comprobar si usuario existe */
function user_id_exists($user_id){
		$user = get_userdata( $user_id );
  	if ( $user == false ){
      return false;
    }else{ 
      return true;
    }
}

/* registrar último login */
add_action('wp_login','reg_last_login');
function reg_last_login($login) {
    global $user_ID;
    $user = get_userdatabylogin($login);
    update_usermeta($user->ID, 'last_login', current_time('mysql'));
}
function the_last_login($user_id) {
    $last_login = get_user_meta($user_id, 'last_login', true);
    echo $last_login;
}

/* Encabezados meta de author */
add_filter( 'wp_title', 'filter_wp_title' );
function filter_wp_title( $title ) {

	if (is_author()){
		$filtered_title = $post->ID;
		return $filtered_title;
	}elseif(is_search()){
		$filtered_title = 'Búsqueda';
		return $filtered_title;
  }else{
    return $title;
  }
}

/* Random user query */
function wp_user_query_random_enable($query) {
    if($query->query_vars["orderby"] == 'rand') {
        $query->query_orderby = 'ORDER by RAND()';
    }
}
add_filter('pre_user_query', 'wp_user_query_random_enable');



/* Añadir meta de disindu */
function add_disindu_meta( $user_id ) {
  $op_user = array(
  	'karma' => 10,
		'invitaciones' => 0,
    'recomendaciones' => array( 0 ),
    'hainvitado' => array( 0 ),
  	'havalidado' => array( 0 ),
  	'hasiovalidado' => array( 0 ),
  	'hadenunciado' => array( 0 ),
  	'hasiodenunciado' => array( 0 ),
		'harecomendado' => array( 0 ),
		'hasiorecomendado' => array( 0 ),
	);
  add_user_meta( $user_id, 'op_user', $op_user );
  $validate_date = 0;
  add_user_meta( $user_id, 'validate_date', $validate_date );
}
add_action( 'user_register', 'add_disindu_meta', 10, 1 );



/* save enlace meta */
function save_book_meta( $post_id, $post, $update ) {
    $slug = 'book';
    if ( $slug != $post->post_type ) {
        return;
    }
    if (isset($_REQUEST['book_author']))  update_post_meta( $post_id, 'book_author', sanitize_text_field( $_REQUEST['book_author'] ) );
    

    if ( isset( $_REQUEST['publisher'] ) ) {
        update_post_meta( $post_id, 'publisher', sanitize_text_field( $_REQUEST['publisher'] ) );
    }

    // Checkboxes are present if checked, absent if not.
    if ( isset( $_REQUEST['inprint'] ) ) {
        update_post_meta( $post_id, 'inprint', TRUE );
    } else {
        update_post_meta( $post_id, 'inprint', FALSE );
    }
}
add_action( 'save_post', 'save_book_meta', 10, 3 );






/*
* FUNCIONES PRINCIPALES DE IDIOMAS
*********************************************/

function the_type_name( $type ){
  switch ($type) {
    case "estudiante" : echo "Estudiante"; break;
    case "profesional" : echo "Profesional"; break;
    case "estudio" : echo "Estudio"; break;
    default: echo "¿?";
    }
}

function the_region_name( $region ){
  switch ($region) {
    case "alava" : echo "Álava"; break;
    case "albacete" : echo "Albacete"; break;
    case "alicante" : echo "Alicante"; break;
    case "almeria" : echo "Almería"; break;
    case "avila" : echo "Ávila"; break;
    case "badajoz" : echo "Badajoz"; break;
    case "barcelona" : echo "Barcelona"; break;
    case "burgos" : echo "Burgos"; break;
    case "caceres" : echo "Cáceres"; break;
    case "cadiz" : echo "Cádiz"; break;
    case "castellon" : echo "Castellón"; break;
    case "ceuta" : echo "Ceuta"; break;
    case "ciudadreal" : echo "Ciudad Real"; break;
    case "cordoba" : echo "Córdoba"; break;
    case "cuenca" : echo "Cuenca"; break;
    case "gerona" : echo "Gerona"; break;
    case "granada" : echo "Granada"; break;
    case "guadalajara" : echo "Guadalajara"; break;
    case "guipuzcoa" : echo "Guipúzcoa"; break;
    case "huelva" : echo "Huelva"; break;
    case "huesca" : echo "Huesca"; break;
    case "jaen" : echo "Jaén"; break;
    case "lacoruna" : echo "La Coruña"; break;
    case "laspalmas" : echo "Las Palmas de Gran Canaria"; break;
    case "leon" : echo "León"; break;
    case "lerida" : echo "Lérida"; break;
    case "logrono" : echo "Logroño"; break;
    case "lugo" : echo "Lugo"; break;
    case "madrid" : echo "Madrid"; break;
    case "malaga" : echo "Málaga"; break;
    case "melilla" : echo "Melilla"; break;
    case "merida" : echo "Mérida"; break;
    case "murcia" : echo "Murcia"; break;
    case "orense" : echo "Orense"; break;
    case "oviedo" : echo "Oviedo"; break;
    case "palencia" : echo "Palencia"; break;
    case "palmademallorca" : echo "Palma de Mallorca"; break;
    case "pamplona" : echo "Pamplona"; break;
    case "pontevedra" : echo "Pontevedra"; break;
    case "salamanca" : echo "Salamanca"; break;
    case "stacruztenerife" : echo "Sta Cruz de Tenerife"; break;
    case "santander" : echo "Santander"; break;
    case "santiago" : echo "Santiago de Compostela"; break;
    case "segovia" : echo "Segovia"; break;
    case "sevilla" : echo "Sevilla"; break;
    case "soria" : echo "Soria"; break;
    case "tarragona" : echo "Tarragona"; break;
    case "teruel" : echo "Teruel"; break;
    case "toledo" : echo "Toledo"; break;
    case "valencia" : echo "Valencia"; break;
    case "valladolid" : echo "Valladolid"; break;
    case "vizcaya" : echo "Vizcaya"; break;
    case "zamora" : echo "Zamora"; break;
    case "zaragoza" : echo "Zaragoza"; break;
    default: echo "¿?";
  }
}

function the_speciality_name( $esp ){
  switch ($esp) {
    case "religion" : echo "Religión"; break;
    case "vehiculos" : echo "Vehículos/Transporte"; break;
    case "mobiliario" : echo "Mobiliario"; break;
    case "iluminacion" : echo "Iluminación"; break;
    case "bano" : echo "Baño"; break;
    case "cocina" : echo "Menaje/cocina"; break;
    case "envases" : echo "Envases"; break;
    case "museos" : echo "Exposición / Museística"; break;
    case "herramientas" : echo "Maquinaria / Herramientas"; break;
    case "juguetes" : echo "Juguetes / Ocio"; break;
    case "deportes" : echo "Deportes"; break;
    case "complementos" : echo "Herrajes / Complementos"; break;
    case "construccion" : echo "Construcción"; break;
    case "oficina" : echo "Material de oficina"; break;
    case "regalo" : echo "Regalo / Promoción"; break;
    case "gestion" : echo "Gestión del Diseño"; break;
    case "religion" : echo "Religión / Funeraria"; break;
    case "medicina" : echo "Medicina / Laboratorio"; break;
    case "otros" : echo "Otros"; break;
    default: echo "¿?";
    }
}







/*
* EVITAR SPAM
*********************************************/

function spam_registration($errors, $sanitized_user_login, $user_email) {
    if ( !isset($_POST['confirm_email']) || $_POST['confirm_email'] !== '' ) {
        wp_redirect( home_url('/login/') . '?action=register&success=1' );
        exit;
    }
    return $errors;
}
add_filter('registration_errors', 'spam_registration', 10, 3);



/*
* MODIFICAR TÍTULO EN HEAD
*********************************************/

function author_title( $title, $sep ) {
	global $paged, $page;

	if (is_author()){
  	$author = get_queried_object();
    $title = get_the_author_meta('first_name',$author->ID).' '.get_the_author_meta('last_name',$author->ID);
  }
	return $title;
}
add_filter( 'wp_title', 'author_title', 10, 2 );




/*
* CAMBIAR FORMATO FECHA
*********************************************/

function validateDate($date){
	$d = DateTime::createFromFormat('Ymd', $date);
  return $d && $d->format('Ymd') == $date;
}



/*
* CAMBIAR VISUALIZACION DE USUARIOS EN EL BACKEND
*********************************************/
remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');
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
?>