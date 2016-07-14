<section id="manageposts" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section">
  	<h3 class="title title--section">Gestionar artículos</h3>
	<?php if($posts_query->have_posts()) { ?>
		<form method="POST" action="">
			<ul class="list">
				<?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
					<?php
					$post_id = get_the_ID();
					?>
					<li class="item wrap wrap--frame wrap--flex">
					  <div class="wrap wrap--frame wrap--frame__fourth">
					    <a href="<?php the_permalink();?>"><?php the_title();?></a>
					  </div>
					  <div class="wrap wrap--frame wrap--frame__fourth">
					  	
					  </div>
					  <div class="wrap wrap--frame wrap--frame__fourth">
					    <a href=""><span class="js-date"><?php echo get_the_date('Y-m-d h:i:s'); ?></span></a>
					    <span class="js-date-fromnow help-info"><?php echo get_the_date('Y-m-d h:i:s'); ?></span>
					  </div>
					  <div class="wrap wrap--frame wrap--frame__fourth wrap--checkbox">
						<input type="checkbox" id="cx-rv-posts-<?php echo $post_id;?>" name="posts_to_remove[]" value="<?php echo $post_id;?>"/>
					    <label for="cx-rv-posts-<?php echo $post_id;?>" class="remove"></label>
					  </div>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php wpdc_the_submit('updatesection', 'removeposts', '', '', 'Eliminar artículos');?>
		</form>
	<?php }else{ ?>
		<p>No hay artículos que gestionar :/</p>
	<?php } ?>
	<?php include(locate_template('templates/sections/section-close.php')); ?>

</section>




		    
