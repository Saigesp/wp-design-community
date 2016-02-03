<?php

get_header(); 

include( locate_template(  'menu-directorio.php' ));

$search_string = $_GET["act"];
$search_region = $_GET["reg"];
$search_activi = $_GET["act"];
$page = $_GET['pag'];
$pro = $_GET["pro"];
$stu = $_GET["stu"];
$est = $_GET["est"];
$users_per_page = get_option("users_per_page");
$users_per_page_noloop = get_option("users_per_page_noloop");
if ($page == '') $page = 1;

$perfil = array();
if ($pro == true) array_push($perfil, "profesional");
if ($stu == true) array_push($perfil, "estudio");
if ($est == true) array_push($perfil, "estudiante");

$original_query = $wp_query; 

if($search_region && $search_activi) {//funcional solo si se completa  actividad y region
  $args = array( 
    'exclude' => array( 1 ),
    'who' => 'authors',
    'number' => 9999,
    'meta_query' => array(
          'relation' => 'AND',
          array(
              'key'     => 'especialidad',
              'value'   => $search_activi,
              'compare' => 'LIKE'
          ),
          array(
              'key'     => 'region',
              'value'   => $search_region,
              'compare' => '='
          ),
          array(
              'key'     => 'type',
              'value'   => $perfil,
              'compare' => 'IN'
          ),
          array(
              'key'     => 'perfil_publico',
              'value'   => '1',
              'compare' => '='
          ),
          
      )  
  );
  $user_count_query = new WP_User_Query($args);
	$user_count = $user_count_query->get_results();
	$total_users = $user_count ? count($user_count) : 1;
	$total_pages = 1;
	$offset = $users_per_page * ($page - 1);
	$total_pages = ceil($total_users / $users_per_page);
	$base = get_permalink( get_the_ID() ) . remove_query_arg('p') . '%_%';
  $args = array( 
    'exclude' => array( 1 ),
    'who' => 'authors',
    'number' => $users_per_page,
    'offset'    => $offset,
    'meta_query' => array(
          'relation' => 'AND',
          array(
              'key'     => 'especialidad',
              'value'   => $search_activi,
              'compare' => 'LIKE'
          ),
          array(
              'key'     => 'region',
              'value'   => $search_region,
              'compare' => '='
          ),
          array(
              'key'     => 'type',
              'value'   => $perfil,
              'compare' => 'IN'
          ),
          array(
              'key'     => 'perfil_publico',
              'value'   => '1',
              'compare' => '='
          ),
          
      )  
  );
}
if($search_region && !$search_activi) { // Solo Region
  $args = array( 
    'exclude' => array( 1 ),
    'who' => 'authors',
    'number' => 9999,
    'meta_query' => array(
          'relation' => 'AND',
          array(
              'key'     => 'region',
              'value'   => $search_region,
              'compare' => '='
          ),
          array(
              'key'     => 'type',
              'value'   => $perfil,
              'compare' => 'IN'
          ),
          array(
              'key'     => 'perfil_publico',
              'value'   => '1',
              'compare' => '='
          ),
      )  
  );
  $user_count_query = new WP_User_Query($args);
	$user_count = $user_count_query->get_results();
	$total_users = $user_count ? count($user_count) : 1;
	$total_pages = 1;
	$offset = $users_per_page * ($page - 1);
	$total_pages = ceil($total_users / $users_per_page);
	$base = get_permalink( get_the_ID() ) . remove_query_arg('p') . '%_%';
  $args = array( 
    'exclude' => array( 1 ),
    'who' => 'authors',
    'number' => $users_per_page,
    'offset'    => $offset,
    'meta_query' => array(
          'relation' => 'AND',
          array(
              'key'     => 'region',
              'value'   => $search_region,
              'compare' => '='
          ),
          array(
              'key'     => 'type',
              'value'   => $perfil,
              'compare' => 'IN'
          ),
          array(
              'key'     => 'perfil_publico',
              'value'   => '1',
              'compare' => '='
          ),
      )  
  );
}
if(!$search_region && $search_activi) {// Solo Actividad
  $args = array( 
    'exclude' => array( 1 ),
    'who' => 'authors',
    'number' => 9999,
    'meta_query' => array(
          'relation' => 'AND',
          array(
              'key'     => 'especialidad',
              'value'   => $search_activi,
              'compare' => 'LIKE'
          ),
          array(
              'key'     => 'type',
              'value'   => $perfil,
              'compare' => 'IN'
          ),
          array(
              'key'     => 'perfil_publico',
              'value'   => '1',
              'compare' => '='
          ),
      )  
  );
  $user_count_query = new WP_User_Query($args);
	$user_count = $user_count_query->get_results();
	$total_users = $user_count ? count($user_count) : 1;
	$total_pages = 1;
	$offset = $users_per_page * ($page - 1);
	$total_pages = ceil($total_users / $users_per_page);
	$base = get_permalink( get_the_ID() ) . remove_query_arg('p') . '%_%';
  $args = array( 
    'exclude' => array( 1 ),
    'who' => 'authors',
    'number' => $users_per_page,
    'offset'    => $offset,
    'meta_query' => array(
          'relation' => 'AND',
          array(
              'key'     => 'especialidad',
              'value'   => $search_activi,
              'compare' => 'LIKE'
          ),
          array(
              'key'     => 'type',
              'value'   => $perfil,
              'compare' => 'IN'
          ),
          array(
              'key'     => 'perfil_publico',
              'value'   => '1',
              'compare' => '='
          ),
      )  
  );
}
?>

<div id="usermain"  >
<?php include( locate_template(  'loop-profile.php' )); ?>
</div>

<div class="navigation">
<?php
	echo paginate_links( array(
    'base' => $base, // the base URL, including query arg
    'format' => '&pag=%#%', // this defines the query parameter that will be used, in this case "p"
    'prev_text' => __('&laquo; Previous'), // text for previous page
    'next_text' => __('Next &raquo;'), // text for next page
    'total' => $total_pages, // the total number of pages we have
    'current' => $page, // the current page
    'end_size' => 1,
    'mid_size' => 5,
    'add_args' => False,
));?>
</div>

<?php
if ($pro != true) $pro = 0;
if ($stu != true) $stu = 0;
if ($est != true) $est = 0;
?>
<script type="text/javascript">
function TransSearch(){
  if (<?php echo $pro; ?> == true) document.getElementById("chepro").checked = true;
  if (<?php echo $stu; ?> == true) document.getElementById("chestu").checked = true;
  if (<?php echo $est; ?> == true) document.getElementById("cheest").checked = true;
  
  document.getElementById('selact').value = "<?php echo $search_activi; ?>";
  document.getElementById('selreg').value = "<?php echo $search_region; ?>";
  
  }
TransSearch();
</script>


<?php get_footer(); ?>
