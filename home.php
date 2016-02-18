<?php get_header(); ?>

 <?php include( locate_template(  'header-masonry.php' )); ?> 
 <?php include( locate_template(  'menu-middle.php' )); ?>

<?php 
  $pagec = $_GET['pag'] == '' ? '1' : $_GET['pag'];
  $post_per_page = get_option( 'posts_per_page', '10' );
?>

<?php
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

<div id="divwrap" class="wraparch index iascontainer">
  <?php
    if (have_posts()) : 
      $cont = 0;
      while (have_posts()) : 
        the_post();
        include( locate_template(  'loop-archive.php' ));

  		endwhile;
  	else :
  	endif;
  ?>
  <div class="navigation">
    <?php
    $base = get_bloginfo( 'url' ). '%_%';
    echo paginate_links( array(
      'base' => $base,
      'total' => $wp_query->max_num_pages,
      'format'   => '?pag=%#%',
      'current'  => $pagec,
    ) );
    ?>
  </div>
</div>
<?php get_footer(); ?>