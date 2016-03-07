<?php get_header(); ?> 
<?php if(is_user_role('administrator') || is_user_role('editor') || is_user_role('author')) {

$fee_id = $_GET['id'] == '' ? 0 : $_GET['id'];

if($fee_id >= 0){
  $fee = get_post($fee_id);
}

?>

  <!-- flexboxer -->
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--payfee">
      
      <?php if($fee_id <= 0){ ?>

        <section class="wrap wrap--content">
          <h2>Pagar cuota</h2>
          <p>No hay información de la cuota</p>
        </section>

      <?php }else{ ?>

      <section class="wrap wrap--content">
        <h2>Pagar cuota</h2>
        <?php echo $fee_id; ?>
        <p>Nombre de la cuota: <?php echo $fee->post_title; ?></p>
      </section>

      <?php } ?>

      <section class="wrap wrap--frame">
        <p class="submit">
          <input type="hidden" name="pay_fee" value="true" />
          <input type="submit" class="button button-primary" value="Pagar cuota">
        </p>
      </section>

    <section class="wrap wrap--frame">
      <?php var_dump($fee); ?>
    </section>

  </div><!-- end of flexboxer -->
<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>
<?php get_footer(); ?>