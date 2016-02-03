<?php get_header(); ?>

<?php
$order = $_GET['order'] == '' ? 'rand' : $_GET['order'];
$page = $_GET['pag'] == '' ? '1' : $_GET['pag'];
$status = $_GET['status'] == '' ? 'published' : $_GET['status'];
$users_per_page = get_option("users_per_page");
$users_per_page_noloop = get_option("users_per_page_noloop");
?>

<?php include( locate_template(  'menu-directorio.php' )); ?>

<?php
$original_query = $wp_query;
if ($status == 'published' ){
if ($order == 'registered'){ // orden por registro
    $args = array( 
    'exclude' => array( 1 ),
    'role' => 'author',
    'meta_key' => 'validate_date',
    'orderby'  => 'meta_value',
    'order' => 'DESC',
    'number' => 9999,
    'meta_query'     => array(
      array(
        'key'       => 'perfil_publico',
        'value'     => '1',
        'compare'   => '=',
        'type'      => 'NUMERIC',
      ),
    ),
  );
  $user_count_query = new WP_User_Query($args);
	$user_count = $user_count_query->get_results();
	$total_users = $user_count ? count($user_count) : 1;
	$total_pages = 1;
	$offset = $users_per_page * ($page - 1);
	$total_pages = ceil($total_users / $users_per_page);
	$base = get_permalink( get_the_ID() ) . '?' . remove_query_arg('p', $query_string) . '%_%';
  $args = array( 
    'exclude' => array( 1 ),
    'role' => 'author',
    'meta_key' => 'validate_date',
    'orderby'  => 'meta_value',
    'order' => 'DESC',
    'number' => $users_per_page,
    'offset'    => $offset,
    'meta_query'     => array(
      array(
        'key'       => 'perfil_publico',
        'value'     => '1',
        'compare'   => '=',
        'type'      => 'NUMERIC',
      ),
    ),
  );
}elseif ($order == 'last_name'){ // orden por nombre (apellido)
  $args = array( 
    'exclude' => array( 1 ),
    'role' => 'author',
		'orderby' => 'meta_value',
    'meta_key' => $order,
    'order' => 'ASC',
    'number' => 9999,
    'meta_query'     => array(
      array(
        'key'       => 'perfil_publico',
        'value'     => '1',
        'compare'   => '=',
        'type'      => 'NUMERIC',
      ),
    ),
  );
  $user_count_query = new WP_User_Query($args);
	$user_count = $user_count_query->get_results();
	$total_users = $user_count ? count($user_count) : 1;
	$total_pages = 1;
	$offset = $users_per_page * ($page - 1);
	$total_pages = ceil($total_users / $users_per_page);
	$base = get_permalink( get_the_ID() ) . '?' . remove_query_arg('p', $query_string) . '%_%';
  $args = array( 
    'exclude' => array( 1 ),
    'role' => 'author',
		'orderby' => 'meta_value',
    'meta_key' => $order,
    'order' => 'ASC',
    'number' => $users_per_page,
    'offset'    => $offset,
    'meta_query'     => array(
      array(
        'key'       => 'perfil_publico',
        'value'     => '1',
        'compare'   => '=',
        'type'      => 'NUMERIC',
      ),
    ),
  );
}elseif ($order == 'rand'){ // orden aleatorio (POR DEFECTO)
  $args = array( 
    'exclude' => array( 1 ),
    'role' => 'author',
    'orderby' => $order,
    'order' => 'DESC',
    'number' => 30,
    'number' => $users_per_page_noloop,
    'meta_query'     => array(
      array(
        'key'       => 'perfil_publico',
        'value'     => '1',
        'compare'   => '=',
        'type'      => 'NUMERIC',
      ),
    ),
  );
}

}else{ //usuarios pendientes
  $args = array( 
    'exclude' => array( 1 ),
    'role' => 'subscriber',
		'orderby' => $order,
    'order' => 'DESC',
    'number' => 9999,
    'meta_key' => 'perfil_publico',
    'meta_value' => '1',
  );
  $user_count_query = new WP_User_Query($args);
	$user_count = $user_count_query->get_results();
	$total_users = $user_count ? count($user_count) : 1;
	$total_pages = 1;
	$offset = $users_per_page * ($page - 1);
	$total_pages = ceil($total_users / $users_per_page);
	$base = get_permalink( get_the_ID() ) . '?' . remove_query_arg('p', $query_string) . '%_%';
  $args = array( 
    'exclude' => array( 1 ),
    'role' => 'subscriber',
    'orderby' => $order,
    'order' => 'DESC',
    'meta_key' => 'perfil_publico',
    'meta_value' => '1',
    'number' => $users_per_page_noloop,
    'offset'    => $offset,
  );  
  
}
?>

<div id="usermain" >
<?php include( locate_template(  'loop-profile.php' )); ?>
</div>


<div class="navigation">
<?php
	echo paginate_links( array(
    'base' => $base,
    'format' => '&pag=%#%',
    'prev_text' => __('&laquo; Previous'),
    'next_text' => __('Next &raquo;'),
    'total' => $total_pages,
    'current' => $page,
    'end_size' => 1,
    'mid_size' => 5,
    'add_args' => false,
));?>
</div>

<?php get_footer(); ?>
