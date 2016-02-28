<?php

get_header(); 

$pagec = $_GET['pag'] == '' ? '1' : $_GET['pag'];
$post_per_page = get_option( 'posts_per_page', '10' );

$args = array (
  'order' => 'DESC',
  'posts_per_page' => -1,
);
$post_count_query = new wp_query( $args );
$post_count = $post_count_query->found_posts;
$total_post = $post_count ? count($post_count) : 1;
$total_pages = 1;
$offset = $post_per_page * ($pagec - 1);
$total_pages = ceil($total_post / $post_per_page);
$args = array( 
  'order' => 'DESC',
  'posts_per_page' => $post_per_page,
  'offset'    => $offset,
);
$wp_query = new wp_query( $args );

?>

<!-- flexboxer -->
<div class="flexboxer flexboxer--page">

  <?php if (have_posts()) : while (have_posts()) : the_post();
    include( locate_template(  'loop-box.php' ));
  endwhile; endif; ?>

</div><!-- end of flexboxer -->

<!-- navigation -->
<div class="navigation">
  <?php /*
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
  )); */ 
    $base = get_bloginfo( 'url' ). '%_%';
    echo paginate_links( array(
      'base' => $base,
      'total' => $wp_query->max_num_pages,
      'format'   => '?pag=%#%',
      'current'  => $pagec,
    ));
    ?>
</div><!-- end of navigation -->

<?php get_footer(); ?>




  
