<?php get_header(); ?>

<?php 
  $pagec = $_GET['pag'] == '' ? '1' : $_GET['pag'];
  $post_per_page = get_option( 'posts_per_page', '10' );
  $term_slug = get_query_var( 's' );
  //echo ;
?>

<?php
  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    's' => $term_slug,
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
    's' => $term_slug,
  );
  $wp_query = new wp_query( $args );
?>

<div id="divwrap" class="wraparch index iascontainer customtax">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <?php include( locate_template(  'templates/loops/loop-archive.php' )); ?> 
    <?php endwhile; ?>
  <?php else : ?>
  <?php endif; ?>

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