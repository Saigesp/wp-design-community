<script>
$(document).ready(function(){

$('#navmiddleres li.active').addClass('open').children('ul').show();
	$('#navmiddleres').find( 'li.has-sub>a' ).on('click', function(){
		$(this).removeAttr('href');
		var element = $(this).parent('li');
		if (element.hasClass('open')) {
			element.removeClass('open');
			element.find('li').removeClass('open');
			element.find('ul').slideUp(200);
		} else {
			element.addClass('open');
			element.children('ul').slideDown(200);
			element.siblings('li').children('ul').slideUp(200);
			element.siblings('li').removeClass('open');
			element.siblings('li').find('li').removeClass('open');
			element.siblings('li').find('ul').slideUp(200);
		}
	});

});
</script>

<div id="menumiddle" class="menumiddle" >  
	<div class="wrapmenumiddle">
		<nav id="navmiddleres" class="navmiddle menumiddlenav">
			<ul class="selectcategory">
				<li class='has-sub'><a href="#">Secciones</a>
					<?php  wp_nav_menu( array( 'theme_location' => 'menumiddle', 'container' => false ) ); ?>
				</li>
			</ul>
			<ul class="selectcategory">
				<li class='has-sub'>
					<a href="#">
						<?php
						if(is_tax('customlanguage')) {
							$termino = get_term_by('slug', get_query_var( 'customlanguage' ), 'customlanguage');
							echo 'Idioma: ' . $termino->name;
						}else {
							echo 'Idiomas';
						}
						?>
					</a>
					<?php 
					$languages_reg = get_terms('customlanguage', array(
					 	'orderby'    => 'name',
					 	'hide_empty' => true,
					));
					if (!empty($languages_reg) && !is_wp_error($languages_reg)){?>
						<ul>
							<?php
							foreach ($languages_reg as $lang) {?>
								<li>
									<a href="<?php bloginfo('url'); echo '/languages/'. $lang->slug;?>">
										<?php echo $lang->name; ?>
									</a>
								</li>
							<?php }?>
						</ul>
					<?php } ?>
				</li>
			</ul>
		</nav>
  </div>
</div>