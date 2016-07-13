<section id="newjob" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section">
	<h3 class="title title--section">Crear oferta de trabajo</h3>
	<form method="POST" action="">
		<?php wpdc_the_input_text('job_name', '', 'Nombre de la oferta', 'Prácticas en...');?>

		<?php wpdc_the_input_text('job_bussiness', '', 'Empresa', 'Empresa');?>

		<?php wpdc_the_input_text('job_info', '', 'Más información', 'http://');?>

		<?php wpdc_the_input_textarea('description', '', 'Descripción de la oferta');?>

		<?php wpdc_the_submit('updatesection', 'newjob', '', '', 'Publicar oferta');?>

		<?php include(locate_template('templates/sections/section-close.php')); ?>
  	</form>
</section>