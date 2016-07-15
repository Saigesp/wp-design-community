<section id="createfee" class="wrap wrap--content wrap--shadow wrap--form wrap--hidden js-section">
  <h3 class="title title--section">Crea cuota</h3>
  <form method="POST" action="">
	  <?php wpdc_the_input_text('fee_name', '', 'Nombre de la cuota', 'Cuota 2015');?>

	  <?php wpdc_the_input_number('fee_quantity', '', 'Cantidad', 0, 999);?>

	  <?php wpdc_the_input_date('fee_date_start', '', 'Inicio');?>

	  <?php wpdc_the_input_date('fee_date_end', '', 'Fin');?>

	  <?php wpdc_the_submit('updatesection', 'newfee', '', '', 'Crear cuota');?>

	  <?php include(locate_template('templates/sections/section-close.php')); ?>
  </form>
</section>