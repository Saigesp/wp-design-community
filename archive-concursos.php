<?php get_header();

if(is_user_role('administrator') || is_user_role('editor')) { 
  //include(locate_template('functions-validation.php'));
}
?>
  <!-- flexboxer -->
<form method="POST" action="">
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--fees">

    <?php if(is_user_role('administrator') || is_user_role('editor')) { ?>

      <!-- admin options -->
      <section class="wrap wrap--content wrap--content__toframe wrap--flex wrap--transparent">
          <div class="wrap wrap--frame wrap--frame__middle">
              <p></p>
          </div>
          <div class="wrap wrap--frame wrap--frame__middle">
              <p class="right"><a class="js-section-launch" onclick="ToggleSection(this)" data-section="createconcurso">Crear concurso</a></p>
          </div>
      </section><!-- end of admin options -->

      <section id="createconcurso" class="wrap wrap--content wrap--form wrap--hidden js-section">
        <h3>Crea concurso</h3>
        <div class="wrap wrap--flex">
          <div class="wrap wrap--frame__middle">
            <label for="concurso_name">Nombre del concurso</label>
          </div>
          <div class="wrap wrap--frame__middle">
            <input id="concurso_name" type="text" name="concurso_name" required value=""/>
          </div>
        </div>
        <div class="wrap wrap--flex">
          <div class="wrap wrap--frame__middle">
            <label for="concurso_org">Organismo convocante</label>
          </div>
          <div class="wrap wrap--frame__middle">
            <input id="concurso_org" type="text" name="concurso_org" required value=""/>
          </div>
        </div>
        <div class="wrap wrap--flex">
          <div class="wrap wrap--frame__middle">
            <label for="concurso_bases">Más información</label>
          </div>
          <div class="wrap wrap--frame__middle">
            <input id="concurso_bases" type="text" name="concurso_bases" required value="" placeholder="http://"/>
          </div>
        </div>
        <div class="wrap wrap--flex">
          <div class="wrap wrap--frame__middle">
            <label for="concurso_quantity">Máximo premio</label>
          </div>
          <div class="wrap wrap--frame__middle">
            <input id="concurso_quantity" type="text" name="concurso_quantity" value=""/>
          </div>
        </div>
        <div class="wrap wrap--flex">
          <div class="wrap wrap--frame__middle wrap--flex">
            <label for="datepicker">Cierre de convocatoria</label>
          </div>
          <div class="wrap wrap--frame__middle">
            <input id="datepicker" type="text" name="fee_date" value="" required />
          </div>
        </div>
        <div class="wrap wrap--flex">
          <textarea name="description" class="description js-medium-editor tolisten"><?php echo $user->description;?></textarea>
        </div>
        <div class="wrap wrap--flex wrap--submit">
          <div class="wrap wrap--frame__middle wrap--flex">
          </div>
          <div class="wrap wrap--frame__middle wrap--flex">
            <p class="submit">
              <input name="updatefee" type="submit" id="submit-all" class="button button-primary" value="Crear concurso">
              <input name="action" type="hidden" id="action" value="new-concurso" />
            </p>
          </div>
        </div>
        <div class="wrap wrap--icon wrap--icon__close js-section-launch" onclick="ToggleSection(this)" data-section="close">
            <?php the_svg_icon('close', 'icon--corner js-close-alert'); ?>
        </div>
      </section>
    <?php } ?>



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