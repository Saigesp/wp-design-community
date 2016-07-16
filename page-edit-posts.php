<?php
get_header(); 
$current_user_id = $current_user->ID;
?>
<div class="flexboxer flexboxer--single flexboxer--single__job flexboxer--full">
	<?php if($_GET['id'] > 0 && (is_user_role('editor') || is_user_role('administrator'))){ ?>
		<?php
		global $post;
		$post_id = $_GET['id'];
		$post = get_post($post_id);
		$job_bussiness = get_post_meta($post_id, 'job_bussiness', true);
		$job_info = get_post_meta($post_id, 'job_info', true);
		?> 

		<?php
		if(is_user_role('editor') || is_user_role('administrator')){

			$pageoptions = [
				"postinfo" => "Detalles",
			];
      		wpdc_the_pageoptions($pageoptions);

			$infoarray = [
				"Publicado" => get_the_date('Y-m-d h:i:s'),
				"Última modificación" => get_the_date('Y-m-d h:i:s'),
				"Autor" => wpdc_get_user_name($post->post_author),
			];
      		wpdc_the_section_custom($infoarray, 'postinfo', 'Detalles del artículo', true, true);
		}
		?>


		<section id="newconcurso" class="wrap wrap--content wrap--form wrap--shadow">
			<h3 class="title title--section">Editar artículo</h3>
			<form method="POST" action="">
			  	<input type="hidden" name="id" value="<?php echo $post_id;?>">

			    <?php wpdc_the_input_text('post_name', get_the_title($post_id), 'Título del artículo', 'Título');?>

				<?php wpdc_the_input_textarea('description', get_post_field('post_content', $post_id), 'Descripción de la oferta');?>
			    
			    <?php wpdc_the_submit('updatesection', 'updateposts', '', '', 'Guardar cambios');?>
			</form>
			<?php include(locate_template('templates/sections/section-close.php')); ?>
		</section>

	<?php }elseif (is_user_role('author') || is_user_role('editor') || is_user_role('administrator')){ ?>

		<?php include(locate_template('templates/sections/404-noinfo.php')); ?>

	<?php }else{ header('Location: '.site_url().'?action=nopermission' ); } ?>
</div>

<?php get_footer(); ?>