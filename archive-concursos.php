<?php get_header();

if(is_user_role('administrator') || is_user_role('editor')) { 
  //include(locate_template('functions-validation.php'));
}
?>
  <!-- flexboxer -->
<form method="POST" action="">
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--fees">

    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>

        <!-- content -->
        <section class="wrap wrap--frame">
          <div class="wrap wrap--content">
            <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            <div class="wrap wrap--frame wrap--flex">
              <div class="wrap wrap--frame__middle">
                <p>Fecha: <?php echo get_post_meta(get_the_ID(), 'fee_date', true); ?></p>
              </div>
              <div class="wrap wrap--frame__middle">
                <p>Cantidad: <?php echo get_post_meta(get_the_ID(), 'fee_quantity', true); ?> €</p>
              </div>
            </div>
            <?php if(is_user_role('administrator') || is_user_role('editor')) { ?>
              <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame__middle">
                  <h4>Socios con la cuota abonada: <?php echo sizeof(get_post_meta(get_the_ID(), 'members_payed', true)); ?></h4>
                </div>
                <div class="wrap wrap--frame__middle">
                  <h4>Socios con la cuota pendiente de validar: <?php echo sizeof(get_post_meta(get_the_ID(), 'members_pending', true)); ?></h4>
                </div>
              </div>
            <?php }else{ ?>
              <div class="wrap wrap--frame wrap--submit">
                <p class="submit">
                  <a href="<?php the_permalink();?>" class="button button-primary">Ver detalles</a>
                </p>
              </div>
            <?php } ?>
          </div>
        </section><!-- end of content -->

      <?php endwhile; ?>
    <?php else : ?>

      <!-- noinfo -->
      <section class="wrap wrap--content">
        <h2>No hay concursos creados</h2>
      </section><!-- end of noinfo -->

    <?php endif; ?>
  </div><!-- end of flexboxer -->
</form>
<?php get_footer(); ?>