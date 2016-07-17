<?php get_header(); ?>
<div class="flexboxer flexboxer--single">

	<?php if (have_posts()) : ?>
		
		<section class="wrap wrap--content wrap--shadow">
			<?php while (have_posts()) : the_post(); ?>
				<h3 class="title title--article__sub"><?php the_title(); ?></h3>
				<p class="info info--post">
				<?php if(!is_user_role('administrator', get_the_author_meta('ID')))
					echo 'Por <a href="'.get_author_post_url(get_the_author_meta('ID')).'">'.wpdc_get_user_name(get_the_author_meta('ID')).'</a> ';
				?>
				<span class="js-date"><?php echo get_the_date('Y-m-d H:i:s');?></span><p>
				<?php if(function_exists('the_subtitle')){?><h3 class="subtitle subtitle--article"><?php the_subtitle(); ?></h3><?php } ?>
				<div id="content-<?php the_ID(); ?>" class="content content--article">
					<?php the_content(); ?>
				</div>
			<?php endwhile; ?>

			<?php if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_concursos' || is_user_role('administrator') || is_user_role('editor')){?>
	          <?php wpdc_the_edit_icon(get_bloginfo('url').'/edit-concursos/?id='.get_the_ID());?>
	        <?php } ?>
	        
		</section>

	<?php else : ?>

    	<?php include(locate_template('templates/sections/404-noinfo.php')); ?>

	<?php endif; ?>
</div>
<?php get_footer();?>