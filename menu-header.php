<header id="headertop" class="headertop" >
  <div class="headertopwrap">
  	<a href="#navtop"><?php the_svg_icon('hamburguer')?></a>
    <div class="logocontainer">
    	<a href="<?php bloginfo('url'); ?>">
    		<img alt="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png"/>
    	</a>
    </div>
    <?php if(is_single()){  ?>
      <div id="sharebuttoncont" class="sharecontainer">
      	<?php the_svg_icon('share');?>
      </div>
    <?php } ?>
  </div>
</header>
<nav id="navtop" class="navtop">
 	<?php  wp_nav_menu( array( 'theme_location' => 'menutop', 'container' => false ) ); ?>
</nav>