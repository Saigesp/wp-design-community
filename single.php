<?php get_header(); ?>
<div class="flexboxer flexboxer--single">

	<?php if (have_posts()) : ?>
		
		<section class="wrap wrap--content wrap--shadow">
			<?php while (have_posts()) : the_post(); ?>
				<h3 class="title title--article__sub"><?php the_title(); ?></h3>
				<?php if(function_exists('the_subtitle')){?><h3 class="subtitle subtitle--article"><?php the_subtitle(); ?></h3><?php } ?>
				<div id="content-<?php the_ID(); ?>" class="content">
					<?php the_content(); ?>
				</div>
			<?php endwhile; ?>
		</section>

	<?php else : ?>

    	<?php include(locate_template('templates/sections/404-noinfo.php')); ?>

	<?php endif; ?>
</div>
<?php get_footer();?>