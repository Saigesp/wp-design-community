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
			<?php if (has_nav_menu($menumiddle)) { ?>
			<ul class="selectcategory">
				<li class='has-sub'><a href="#">Secciones</a>
					<?php  wp_nav_menu( array( 'theme_location' => 'menumiddle', 'container' => false ) ); ?>
				</li>
			</ul>
			<?php } ?>
		</nav>
  </div>
</div>