<?php
get_header(); 
$current_user_id = $current_user->ID;
?>
<div class="flexboxer flexboxer--single flexboxer--single__job flexboxer--full">
	<?php if($_GET['id'] > 0 && (is_user_role('editor') || is_user_role('administrator'))){ ?>
		<?php
		global $post;
		$post_id = $_GET['id'];
		$job_bussiness = get_post_meta($post_id, 'job_bussiness', true);
		$job_info = get_post_meta($post_id, 'job_info', true);
		?> 

		<section id="newconcurso" class="wrap wrap--content wrap--form wrap--shadow">
			<h3 class="title title--section">Editar oferta</h3>
			<form method="POST" action="">
			  	<input type="hidden" name="id" value="<?php echo $post_id;?>">

			    <?php wpdc_the_input_text('job_name', get_the_title($post_id), 'Nombre de la oferta', 'Prácticas en...');?>

				<?php wpdc_the_input_text('job_bussiness', $job_bussiness, 'Empresa', 'Empresa');?>

				<?php wpdc_the_input_text('job_info', $job_info, 'Más información', 'http://');?>

				<?php wpdc_the_input_textarea('description', get_post_field('post_content', $post_id), 'Descripción de la oferta');?>
			    
			    <?php wpdc_the_submit('updatesection', 'updatejob', '', '', 'Guardar cambios');?>
			</form>
			<?php include(locate_template('templates/sections/section-close.php')); ?>
		</section>

	<?php }elseif (is_user_role('author') || is_user_role('editor') || is_user_role('administrator')){ ?>

		<?php include(locate_template('templates/sections/404-noinfo.php')); ?>

	<?php }else{ header('Location: '.site_url().'?action=nopermission' ); } ?>
</div>

<?php get_footer(); ?>