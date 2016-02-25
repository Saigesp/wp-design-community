<header class="headertop">
  <div class="wrapper">
    <?php if (has_nav_menu($menutop)) { ?>
  	   <?php the_svg_icon('hamburguer')?>
    <?php } ?>
    <div class="wrap wrap--logo">
    	<a href="<?php bloginfo('url'); ?>">
        <?php if(wp_get_attachment_url(get_theme_mod( 'logo_file', true )) != ''){ ?>
          <img alt="logo" src="<?php echo wp_get_attachment_url(get_theme_mod( 'logo_file', true )); ?>"/>
        <?php } else { ?>
    		  <img alt="logo" src="<?php echo get_template_directory_uri(); ?>/img/default/logo.png"/>
        <?php } ?>
    	</a>
    </div>
    <?php if(is_author()){ ?>
      <div class="wrap wrap--path showontablet">
        <h3><span class="current"><?php echo get_the_author_meta('first_name', 1) . ' '. get_the_author_meta('last_name', 1); ?></span></h3>
      </div>
    <?php } ?>
    <?php if(is_single()){  ?>
      <div class="wrap wrap--share sharecontainer">
      	<?php the_svg_icon('share');?>
      </div>
    <?php } ?>
  </div>
</header>
<?php if (has_nav_menu($menutop)) { ?>
  <nav id="navtop" class="navtop">
   	<?php  wp_nav_menu( array( 'theme_location' => 'menutop', 'container' => false ) ); ?>
  </nav>
<?php } ?>