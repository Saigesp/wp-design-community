<?php get_header(); ?>

 <?php include( locate_template(  'menu-middle.php' )); ?>

<div id="divwrap" class="wraparch index iascontainer">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <p>a</p>
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