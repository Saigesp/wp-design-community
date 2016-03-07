<?php get_header(); ?> 
<?php if(is_user_role('administrator') || is_user_role('editor')) { ?>
  <!-- flexboxer -->
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--fee">

      <!-- content -->
      <section class="wrap wrap--content wrap--form">
        <h3>Crea cuota</h3>
        <?php //the_content();?>
        <div class="wrap wrap--flex">
          <div class="wrap wrap--frame__middle wrap--flex">
            <div class="wrap wrap--frame__middle">
              <label for="dbem_dnie">Nombre</label>
            </div>
            <div class="wrap wrap--frame__middle">
            <input type="text" name="dbem_dnie" value=""/>
            </div>
          </div>
          <div class="wrap wrap--frame__middle wrap--flex">
            <div class="wrap wrap--frame__middle">
              <label for="dbem_address">Cantidad</label>
            </div>
            <div class="wrap wrap--frame__middle">
            <input type="number" name="quantity" min="0" max="999" step="0.01" value=""/>
            </div>
          </div>
        </div>
        <div class="wrap wrap--flex">
          <div class="wrap wrap--frame__middle wrap--flex">
            <div class="wrap wrap--frame__middle">
              <label for="dbem_phone">Inicio</label>
            </div>
            <div class="wrap wrap--frame__middle">
            <input type="text" name="dbem_phone" value=""/>
            </div>
          </div>
          <div class="wrap wrap--frame__middle wrap--flex">
            <div class="wrap wrap--frame__middle">
              <label for="hola">Fin</label>
            </div>
            <div class="wrap wrap--frame__middle">
              <input type="text" name="hola">
            </div>
          </div>
        </div>
      </section>

      <section class="wrap wrap--frame">
        <p class="submit">
          <input type="hidden" name="pay_fee" value="true" />
          <input type="submit" class="button button-primary" value="Crear cuota">
        </p>
      </section>

  </div><!-- end of flexboxer -->
<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>
<?php get_footer(); ?>