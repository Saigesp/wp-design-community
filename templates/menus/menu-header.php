<header class="headertop wrap wrap--flex">
  <div class="wrapper wrap wrap--frame">

    <!-- logo -->
    <div class="wrap wrap--logo">
    	<a href="<?php bloginfo('url'); ?>">
        <?php if(wp_get_attachment_url(get_theme_mod( 'logo_file', true )) != ''){ ?>
          <img alt="logo" src="<?php echo wp_get_attachment_url(get_theme_mod( 'logo_file', true )); ?>"/>
        <?php } else { ?>
    		  <img alt="logo" src="<?php echo get_template_directory_uri(); ?>/img/default/logo.png"/>
        <?php } ?>
    	</a>
    </div><!-- end of logo -->

    <!-- top title -->
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
    </div><!-- end of top title -->

    <!-- usermenu -->
    <div class="wrap wrap--icon wrap--icon__usermenu" onclick="ToggleMenu('menuuser')">
      <?php
      if(!is_user_logged_in()) the_svg_icon('doner');
      else the_profile_photo($current_user->ID);
      ?>

    </div><!-- end of usermenu -->

    <!-- rightmenu launcher -->
    <?php if (has_nav_menu('menutop')) { ?>
      <div class="wrap wrap--icon wrap--icon__topmenu" onclick="ToggleMenu('menutop')">
        <?php the_svg_icon('kebab');?>
      </div>
    <?php } ?><!-- end of rightmenu launcher -->
    
  </div>
</header>



<!-- rightmenu -->
<?php if (has_nav_menu('menutop')) { ?>
  <nav id="menutop" class="wrap wrap--menu wrap--menu__top js-menu js-fullheight animecubic350">
    <?php wp_nav_menu( array( 'theme_location' => 'menutop', 'container' => false ) ); ?>
  </nav>
<?php } ?><!-- end of rightmenu -->


<?php include(locate_template('templates/menus/menu-user.php')); ?> 

<div id="overlaybody" class="overlay overlay--body" onclick="ToggleMenu('close')"></div>