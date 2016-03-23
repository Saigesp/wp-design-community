<?php get_header(); ?> 
<?php if(is_user_role('administrator') || is_user_role('editor') || is_user_role('author')) { 

include(locate_template('functions-validation.php'));
  ?>
  <!-- flexboxer -->
<form method="POST" action="">
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--fees">

    <!-- admin options -->
    <section class="wrap wrap--content wrap--content__toframe wrap--flex wrap--transparent">
        <div class="wrap wrap--frame wrap--frame__middle">
            <p></p>
        </div>
        <div class="wrap wrap--frame wrap--frame__middle">
            <p class="right"><a onclick="ToggleSection('createfee')">Crear cuota</a></p>
        </div>
    </section><!-- end of admin options -->

    <section id="createfee" class="wrap wrap--content wrap--form wrap--hidden js-section">
        <h3>Crea cuota</h3>
        <div class="wrap wrap--flex">
          <div class="wrap wrap--frame__middle">
            <label for="fee_name">Nombre de la cuota</label>
          </div>
          <div class="wrap wrap--frame__middle">
            <input type="text" name="fee_name" value=""/>
          </div>
        </div>
        <div class="wrap wrap--flex">
          <div class="wrap wrap--frame__middle">
            <label for="fee_quantity">Cantidad</label>
          </div>
          <div class="wrap wrap--frame__middle">
            <input type="number" name="fee_quantity" min="0" max="999" step="0.01" value=""/>
          </div>
        </div>
        <div class="wrap wrap--flex">
          <div class="wrap wrap--frame__middle wrap--flex">
            <label for="fee_date">Inicio</label>
          </div>
          <div class="wrap wrap--frame__middle">
            <input id="datepicker" type="text" name="fee_date" value=""/>
          </div>
        </div>
        <div class="wrap wrap--flex wrap--submit">
          <div class="wrap wrap--frame__middle wrap--flex">
          </div>
          <div class="wrap wrap--frame__middle wrap--flex">
            <p class="submit">
              <input name="updatefee" type="submit" id="submit-all" class="button button-primary" value="Crear cuota">
              <input name="action" type="hidden" id="action" value="new-fee" />
            </p>
          </div>
        </div>
        <div class="wrap wrap--icon wrap--icon__close" onclick="ToggleSection('close')">
            <?php the_svg_icon('close', 'icon--corner js-close-alert'); ?>
        </div>
    </section>




    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>

        <!-- content -->
        <section class="wrap wrap--content">
          <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
          <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame__middle">
              <p>Fecha: <?php echo get_post_meta(get_the_ID(), 'fee_date', true); ?></p>
            </div>
            <div class="wrap wrap--frame__middle">
              <p>Cantidad: <?php echo get_post_meta(get_the_ID(), 'fee_quantity', true); ?> €</p>
            </div>
          </div>
          <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame__middle">
              <h4>Socios con la cuota abonada: <?php echo sizeof(get_post_meta(get_the_ID(), 'members_payed', true)); ?></h4>
            </div>
            <div class="wrap wrap--frame__middle">
              <h4>Socios con la cuota pendiente de validar: <?php echo sizeof(get_post_meta(get_the_ID(), 'members_pending', true)); ?></h4>
            </div>
          </div>
        </section><!-- end of content -->

      <?php endwhile; ?>
    <?php else : ?>

      <!-- noinfo -->
      <section class="wrap wrap--content">
        <h2>No hay cuotas creadas</h2>
      </section><!-- end of noinfo -->

    <?php endif; ?>
  </div><!-- end of flexboxer -->
</form>
<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>
<?php get_footer(); ?>