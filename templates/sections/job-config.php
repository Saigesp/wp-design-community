<section id="managejob" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section">
  	<h3 class="title title--section">Gestionar ofertas</h3>
	<?php if($job_query->have_posts()) { ?>
		<form method="POST" action="">
			<ul class="list">
				<?php while ($job_query->have_posts()) : $job_query->the_post(); ?>
					<?php
					$post_id = get_the_ID();
					$job_bussiness = get_post_meta($post_id, 'job_bussiness', true);
					$job_info = get_post_meta($post_id, 'job_info', true);
					?>
					<li class="item wrap wrap--frame wrap--flex">
					  <div class="wrap wrap--frame wrap--frame__fourth">
					    <a href="<?php the_permalink();?>"><?php the_title();?></a>
					  </div>
					  <div class="wrap wrap--frame wrap--frame__fourth">
					  	<?php echo $job_bussiness;?>
					  </div>
					  <div class="wrap wrap--frame wrap--frame__fourth">
					    <a href="<?php echo $job_info; ?>"><span class="js-date"><?php echo get_the_date('Y-m-d h:i:s'); ?></span></a>
					    <span class="js-date-fromnow help-info"><?php echo get_the_date('Y-m-d h:i:s'); ?></span>
					  </div>
					  <div class="wrap wrap--frame wrap--frame__fourth wrap--checkbox">
						<input type="checkbox" id="cx-rv-job-<?php echo $post_id;?>" name="jobs_to_remove[]" value="<?php echo $post_id;?>"/>
					    <label for="cx-rv-job-<?php echo $post_id;?>" class="remove"></label>
					  </div>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php wpdc_the_submit('updatesection', 'removejob', '', '', 'Eliminar ofertas');?>
		</form>
	<?php }else{ ?>
		<p>No hay ofertas que gestionar :/</p>
	<?php } ?>
	<?php include(locate_template('templates/sections/section-close.php')); ?>

</section>




		    
