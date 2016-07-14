<section id="newposts" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section">
	<h3 class="title title--section">Crear artículo</h3>
	<form method="POST" action="">
		<?php wpdc_the_input_text('post_name', '', 'Título', 'Título');?>

		<?php wpdc_the_input_text('post_subtitle', '', 'Subtítulo', 'Subtítulo');?>

		<?php wpdc_the_input_textarea('description', '', 'Contenido');?>

		<?php wpdc_the_submit('updatesection', 'newposts', '', '', 'Publicar artículo');?>

		<?php include(locate_template('templates/sections/section-close.php')); ?>
  	</form>
</section>