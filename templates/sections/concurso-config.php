<section id="manageconcursos" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section">
	<h3 class="title title--section">Configurar concursos</h3>
	<?php if($concurso_query->have_posts()) { ?>
		<h3 class="sep">Listado de concursos</h3>
		<form method="POST" action="">
		    <ul class="list">
		      <?php while ($concurso_query->have_posts()) : $concurso_query->the_post(); ?>
		        <?php
		        $post_id = get_the_ID();
		        $concurso_org = get_post_meta($post_id, 'concurso_org', true);
		        $concurso_bases = get_post_meta($post_id, 'concurso_bases', true);
		        $concurso_quantity = get_post_meta($post_id, 'concurso_quantity', true);
		        $concurso_date = get_post_meta($post_id, 'concurso_date', true);
		        ?>
		        <li class="item wrap wrap--frame wrap--flex">
		          <div class="wrap wrap--frame wrap--frame__fourth">
		            <a href="<?php the_permalink();?>"><?php the_title();?></a>
		          </div>
		          <div class="wrap wrap--frame wrap--frame__fourth">
		            <a href="<?php echo $concurso_bases; ?>"><span class="js-date"><?php echo $concurso_date; ?></span></a>
		            <span class="js-date-fromnow help-info"><?php echo $concurso_date; ?></span>
		          </div>
		          <div class="wrap wrap--frame wrap--frame__fourth">
		          </div>
		          <div class="wrap wrap--frame wrap--frame__fourth wrap--checkbox">
					<input type="checkbox" id="cx-rv-concurso-<?php echo $post_id;?>" name="concursos_to_remove[]" value="<?php echo $post_id;?>"/>
		            <label for="cx-rv-concurso-<?php echo $post_id;?>" class="remove"></label>
		          </div>
		        </li>
		      <?php endwhile; ?>
		    </ul>
			<?php wpdc_the_submit('updatesection', 'removeconcurso', '', '', 'Eliminar concursos');?>
		</form>
	<?php }else{ ?>
		<p>No hay concursos que gestionar :/</p>
	<?php } ?>
	<?php include(locate_template('templates/sections/section-close.php')); ?>

</section>

