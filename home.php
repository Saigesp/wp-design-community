<?php get_header(); ?>
<div class="flexboxer flexboxer--home">
  <?php if (have_posts()) {
      while (have_posts()) { 
        the_post();
        include( locate_template(  'loop-archive.php' ));
      }
  	}
  ?>
</div>
<?php get_footer(); ?>