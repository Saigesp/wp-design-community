<?php
get_header(); 
$current_user_id = $current_user->ID;
?>
<div class="flexboxer flexboxer--single flexboxer--single__concurso flexboxer--full">
	<?php if($_GET['id'] > 0 && (is_user_role('editor') || is_user_role('administrator'))){ ?>
		<?php
		include(locate_template('templates/functions/functions-validation.php'));
		global $post;
		$post_id = $_GET['id'];
		$concurso_org = get_post_meta($post_id, 'concurso_org', true);
		$concurso_bases = get_post_meta($post_id, 'concurso_bases', true);
		$concurso_quantity = get_post_meta($post_id, 'concurso_quantity', true);
		$concurso_date = get_post_meta($post_id, 'concurso_date', true);
		?> 

		<?php include(locate_template('templates/sections/meeseeks.php')); ?>

		<section id="newconcurso" class="wrap wrap--content wrap--form wrap--shadow">
		  <h3 class="title title--section">Editar concurso</h3>
		  <form method="POST" action="">

		  	<input type="hidden" name="id" value="<?php echo $post_id;?>">

		    <?php wpdc_the_input_text('concurso_name', get_the_title($post_id), 'Nombre del concurso', 'Nombre del concurso');?>

		    <?php wpdc_the_input_text('concurso_org', $concurso_org, 'Organismo convocante', 'Organismo');?>
		    
		    <?php wpdc_the_input_text('concurso_bases', $concurso_bases, 'Bases/Más información', 'http://');?>
		    
		    <?php wpdc_the_input_text('concurso_quantity', $concurso_quantity, 'Máximo premio', '3000€, Viaje a Roma...');?>
		    
		    <?php wpdc_the_input_date('concurso_date', $concurso_date, 'Cierre de convocatoria');?>

		    <?php wpdc_the_input_textarea('description', get_post_field('post_content', $post_id), 'Descripción del concurso');?>
		    
		    <?php wpdc_the_submit('updatesection', 'updateconcurso', '', '', 'Guardar cambios');?>
		  </form>
		</section>

	<?php }elseif (is_user_role('author') || is_user_role('editor') || is_user_role('administrator')){ ?>

		<?php include(locate_template('templates/sections/404-noinfo.php')); ?>

	<?php }else{ header('Location: '.site_url().'?action=nopermission' ); } ?>
</div>

<?php get_footer(); ?>