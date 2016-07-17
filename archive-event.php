<?php

get_header(); 

$pagec = $_GET['pag'] == '' ? '1' : $_GET['pag'];
$post_per_page = get_option( 'posts_per_page', '10' );

$args = array (
  'order' => 'DESC',
  'orderby' => 'meta_value',
  'meta_key' => '_event_start_date',
  'posts_per_page' => -1,
  'post_type' => 'event'
);
$post_count_query = new wp_query( $args );
$post_count = $post_count_query->found_posts;
$total_post = $post_count ? count($post_count) : 1;
$total_pages = 1;
$offset = $post_per_page * ($pagec - 1);
$total_pages = ceil($total_post / $post_per_page);
$args = array( 
  'order' => 'DESC',
  'orderby' => 'meta_value',
  'meta_key' => '_event_start_date',
  'posts_per_page' => $post_per_page,
  'offset'    => $offset,
  'post_type' => 'event'
);
$wp_query = new wp_query( $args );
$article_count = 1;
?>

<!-- flexboxer -->
<div id="ias" class="flexboxer flexboxer--full flexboxer--archive flexborex--archive__events">

  <?php if (have_posts()) : while (have_posts()) : the_post();
    include(locate_template('templates/loops/loop-event.php'));
  endwhile; endif; ?>

</div><!-- end of flexboxer -->

<!-- navigation -->
<div class="navigation">
  <?php $base = strtok($_SERVER["REQUEST_URI"],'?').'%_%';
  echo paginate_links( array(
    'base' => $base,
    'total' => $wp_query->max_num_pages,
    'format'   => '?pag=%#%',
    'current'  => $pagec,
  )); ?>
</div><!-- end of navigation -->

<?php get_footer(); ?>