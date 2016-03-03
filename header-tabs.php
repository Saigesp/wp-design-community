<header class="headertop wrap wrap--flex">
  <div class="wrapper wrap wrap--frame">
    <div class="wrap wrap--logo">
    	<a href="<?php bloginfo('url'); ?>">
        <?php if(wp_get_attachment_url(get_theme_mod( 'logo_file', true )) != ''){ ?>
          <img alt="logo" src="<?php echo wp_get_attachment_url(get_theme_mod( 'logo_file', true )); ?>"/>
        <?php } else { ?>
    		  <img alt="logo" src="<?php echo get_template_directory_uri(); ?>/img/default/logo.png"/>
        <?php } ?>
    	</a>
    </div>
    <div class="wrap wrap--pagetitle">
      <?php if(is_author()){ ?>
        <div class="wrap wrap--path showontablet">
          <h3><span class="current"><?php echo get_the_author_meta('first_name', 1) . ' '. get_the_author_meta('last_name', 1); ?></span></h3>
        </div>
      <?php } ?>
      <?php if(is_page('Edit Profile')){ ?>
        <div class="wrap wrap--path showontablet">
          <h3><a href="<?php echo get_author_posts_url( $current_user->ID); ?>">
            <?php echo get_the_author_meta('first_name', 1) . ' '. get_the_author_meta('last_name', 1); ?></a> / <span class="current">Edit Profile</span></h3>
        </div>
      <?php } ?>
      <?php if(is_page('Edit Event')){ ?>
        <div class="wrap wrap--path showontablet">
          <h3><span class="current">Crear evento</span></h3>
        </div>
      <?php } ?>
      <?php if(is_single()){  ?>
        <div class="wrap wrap--share sharecontainer">
        	<?php the_svg_icon('share');?>
        </div>
      <?php } ?>
    </div>
    <?php if (!has_nav_menu($menutop)) { ?>
    <div class="wrap wrap--icon wrap--icon__topmenu" onclick="ToggleMenu()">
      <?php the_svg_icon('kebab');?>
    </div>
    <?php } ?>
  </div>
</header>
<?php if (!empty($_GET["alert"])) { ?>
<div class="wrap wrap--content alert alert--error">
  <?php if ($_GET["alert"] == 'nologged') ?> <p>Es necesario que inicies sesión para acceder a esa sección</p>
</div>
<?php } ?>
<?php if (has_nav_menu($menutop)) { ?>
  <nav id="navtop" class="navtop">
   	<?php  wp_nav_menu( array( 'theme_location' => 'menutop', 'container' => false ) ); ?>
  </nav>
<?php } ?>