<?php if (has_nav_menu($menumiddle)) { ?>
	<div id="menumiddle" class="menumiddle" >  
		<div class="wrapmenumiddle">
			<nav id="navmiddleres" class="navmiddle menumiddlenav">
				
				<ul class="selectcategory">
					<li class='has-sub'><a href="#">Secciones</a>
						<?php  wp_nav_menu( array( 'theme_location' => 'menumiddle', 'container' => false ) ); ?>
					</li>
				</ul>
				
			</nav>
	  </div>
	</div>
<?php } ?>