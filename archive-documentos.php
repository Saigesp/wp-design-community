<?php get_header(); ?>

  <!-- flexboxer -->
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--docs">

    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>

       
      <?php endwhile; ?>
    <?php else : ?>

      <!-- noinfo -->
      <section class="wrap wrap--content wrap--transparent">
        <h2>No hay documentos subidos</h2>
      </section><!-- end of noinfo -->

    <?php endif; ?>
  </div><!-- end of flexboxer -->
<?php get_footer(); ?>