<section id="createfee" class="wrap wrap--content wrap--shadow wrap--form wrap--hidden js-section">
  <h3>Crea cuota</h3>
  
  <?php wpdc_the_input_text('fee_name', '', 'Nombre de la cuota', 'Cuota 2015');?>

  <?php wpdc_the_input_number('fee_quantity', '', 'Cantidad', 0, 999);?>

  <?php wpdc_the_input_text('fee_date', '', 'Inicio', 'Inicio');?>

  <?php wpdc_the_submit('updatefee', 'Crear cuota', 'new-fee', 'Crear cuota');?>

  <?php include(locate_template('templates/sections/section-close.php')); ?>
</section>