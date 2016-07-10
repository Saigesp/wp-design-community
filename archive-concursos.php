<?php get_header();

if(is_user_role('administrator') || is_user_role('editor')) { 
  //include(locate_template('templates/functions/functions-validation.php'));
}
?>
  <!-- flexboxer -->
<form method="POST" action="">
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--concursos">

    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>


      <?php endwhile; ?>
    <?php else : ?>

      <!-- noinfo -->
      <section class="wrap wrap--content wrap--transparent">
        <h2>No hay concursos creados</h2>
      </section><!-- end of noinfo -->

    <?php endif; ?>
  </div><!-- end of flexboxer -->
</form>
<?php get_footer(); ?>