<?php get_header();

$args = array (
  'order' => 'DESC',
  'posts_per_page' => -1,
  'post_type' => 'fee',
  'orderby' => 'meta_value',
  'meta_key'  => 'fee_date',
);
$wp_query = new wp_query( $args );


if(is_user_role('administrator') || is_user_role('editor')) { 
  include(locate_template('functions-validation.php'));
}

?>

<!-- flexboxer -->
<form method="POST" action="">
<div class="flexboxer flexboxer--event">

      <?php include(locate_template('templates/harry/harry.php')); ?>

		<!-- admin options -->
      <section class="wrap wrap--content wrap--content__toframe wrap--flex wrap--transparent wrap--menu">
          <div class="wrap wrap--frame wrap--frame__middle">
              <p class=""><a onclick="ToggleSection(this)" class="js-section-launch" data-section="setbankaccount">Configurar cuentas</a></p>
          </div>
          <div class="wrap wrap--frame wrap--frame__middle">
              <p class="right"><a onclick="ToggleSection(this)" class="js-section-launch" data-section="createfee">Crear cuota</a></p>
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
        <div class="wrap wrap--icon wrap--icon__close js-section-launch" onclick="ToggleSection(this)" data-section="close">
            <?php the_svg_icon('close', 'icon--corner js-close-alert'); ?>
        </div>
      </section>
  
	<section id="setbankaccount" class="wrap wrap--content wrap--hidden js-section">
		<h3>Cuentas</h3>
    <h4>Cuenta bancaria</h4>
    <p>Especifica a los usuarios de tu sitio dónde hacer los ingresos bancarios.</p>
    <div class="wrap wrap--frame wrap--flex">
      <div class="wrap wrap--frame__middle">
        <label for="bank_account">Código de la cuenta bancaria.</label>
      </div>
      <div class="wrap wrap--frame__middle">
        <input id="bank_account" type="text" name="bank_account" value="" placeholder="IBAN ES 01 0123 0123 01 0123456789"/>
      </div>
    </div>
    <h4>Paypal</h4>
    <div class="wrap wrap--icon wrap--icon__close js-section-launch" onclick="ToggleSection(this)" data-section="close">
        <?php the_svg_icon('close', 'icon--corner js-close-alert'); ?>
    </div>
	</section>

<?php if (have_posts()) : ?>
    <section class="wrap wrap--content">
      <h2>Cuotas</h2>
      <h4>Cuotas</h4>
      <?php while (have_posts()) : the_post(); 
        $members_payed = is_array(get_post_meta(get_the_ID(), 'members_payed', true)) ? get_post_meta(get_the_ID(), 'members_payed', true) : array();
        $members_pending = is_array(get_post_meta(get_the_ID(), 'members_pending', true)) ? get_post_meta(get_the_ID(), 'members_pending', true) : array();
        ?>

        <!-- content -->
          <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame__middle wrap--flex">
              <div class="wrap wrap--frame__middle">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
              </div>
              <div class="wrap wrap--frame__middle">
                <span class="js-date"><?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'fee_date', true)));?></span>
                <span class="js-date-fromnow help-info"><?php echo get_post_meta(get_the_ID(), 'fee_date', true);?></span>
              </div>
            </div>
            <div class="wrap wrap--frame__middle wrap--flex">
              <div class="wrap wrap--frame__middle">
                <?php
                echo get_post_meta(get_the_ID(), 'fee_quantity', true).' €'; 
                if(get_post_meta(get_the_ID(), 'members_payed', true) != '')
                  echo ' <span class="help-info">Recaudados '.get_post_meta(get_the_ID(), 'fee_quantity', true)*sizeof(get_post_meta(get_the_ID(), 'members_payed', true)).' €</span>';
                ?>
              </div>
              <div class="wrap wrap--frame__middle">
            <?php if(date(strtotime(get_post_meta(get_the_ID(), 'fee_date', true))) > date(strtotime('now'))){
            		echo 'Evento futuro';
            	  } else {
	                  if(get_post_meta(get_the_ID(), 'members_payed', true) != '') echo sizeof(get_post_meta(get_the_ID(), 'members_payed', true));
	                  else echo '0';
	                  echo ' Abonos, ';
	                  if(get_post_meta(get_the_ID(), 'members_pending', true) != '') echo sizeof(get_post_meta(get_the_ID(), 'members_pending', true));
	                  else echo '0';
	                  echo ' En proceso';
            	  }	?>
              </div>
            </div>
          </div>
      <?php endwhile; ?>
    </section><!-- end of content -->
    <?php else : ?>

      <!-- noinfo -->
      <section class="wrap wrap--content">
        <h2>No hay cuotas creadas</h2>
      </section><!-- end of noinfo -->

    <?php endif; ?>

  
</div><!-- end of flexboxer -->
</form>



<?php get_footer(); ?>