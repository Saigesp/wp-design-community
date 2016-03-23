<?php get_header(); ?> 
<?php
//if(is_user_role('administrator') || is_user_role('editor') || is_user_role('author')) {
if(true) {

$fee_id = $_GET['id'] == '' ? 0 : $_GET['id'];

if($fee_id >= 0){
  $fee = get_post($fee_id);
}

?>

  <!-- flexboxer -->
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--payfee">
      
      <?php if($fee_id <= 0){ ?>

        <section class="wrap wrap--content">
          <p>No hay información de la cuota</p>
        </section>

      <?php }else{ ?>

      <section class="wrap wrap--content">
        <h2>Pagar <?php echo $fee->post_title; ?></h2>
        <div class="wrap wrap--frame wrap--flex">
          <div class="wrap wrap--frame__middle">
            <p>Fecha: <?php echo get_post_meta($fee_id, 'fee_date', true); ?></p>
          </div>
          <div class="wrap wrap--frame__middle">
            <p>Cantidad: <?php echo get_post_meta($fee_id, 'fee_quantity', true); ?> €</p>
          </div>
        </div>
        <p>Estatus: Pendiente de abono</p>
        <div class="wrap wrap--frame wrap--flex">
          <div class="wrap wrap--frame__middle">
            Método de pago
          </div>
          <div class="wrap wrap--frame__middle">
            <select name="paymethod" id="">
              <option value="transferency">Pago mediante transferencia</option>
              <option value="transferency">Pago por paypal</option>
            </select>
          </div>
        </div>
      </section>

      <section class="wrap wrap--frame wrap--empty wrap--submit">
        <p class="submit">
          <input name="payfee" type="submit" id="submit-all" class="button button-primary" value="Pagar cuota">
          <input name="action" type="hidden" id="action" value="pay-fee" />
        </p>
      </section>

      <?php } ?>




  </div><!-- end of flexboxer -->
<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>
<?php get_footer(); ?>