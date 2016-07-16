<header class="wrap wrap--header wrap--shadow">
  <div class="flexboxer">
    <section class="wrap wrap--frame wrap--flex">
      <div class="wrap wrap--frame wrap--frame__middle">
        <!-- logo -->
        <a href="<?php bloginfo('url'); ?>">
          <?php if(wp_get_attachment_url(get_theme_mod( 'logo_file', true )) != ''){ ?>
            <img alt="logo" class="logo" src="<?php echo wp_get_attachment_url(get_theme_mod( 'logo_file', true )); ?>"/>
          <?php } else { ?>
        	  <img alt="logo" class="logo" src="<?php echo get_template_directory_uri(); ?>/img/default/logo.png"/>
          <?php } ?>
        </a><!-- end of logo -->

        <!-- top title -->
        <div class="wrap wrap--pagetitle">
          <?php if(is_author()){ ?>
            <div class="wrap wrap--path showontablet">
              <h3 class="title"><span class="current"><?php echo get_the_author_meta('first_name', 1) . ' '. get_the_author_meta('last_name', 1); ?></span></h3>
            </div>
          <?php } ?>
          <?php if(is_page('Edit Profile')){ ?>
            <div class="wrap wrap--path showontablet">
              <h3 class="title"><a href="<?php echo get_author_posts_url( $current_user->ID); ?>">
                <?php echo get_the_author_meta('first_name', 1) . ' '. get_the_author_meta('last_name', 1); ?></a> / <span class="current">Edit Profile</span></h3>
            </div>
          <?php } ?>
          <?php if(is_page('Edit Event')){ ?>
            <div class="wrap wrap--path showontablet">
              <h3 class="title"><span class="current">Crear evento</span></h3>
            </div>
          <?php } ?>
          <?php if(is_single()){  ?>
            <div class="wrap wrap--share sharecontainer">
            	<?php // the_svg_icon('share');?>
            </div>
          <?php } ?>
        </div><!-- end of top title -->

      </div>
      <div class="wrap wrap--frame wrap--frame__middle text text--right">
        
        <?php if(!is_user_logged_in()){ ?>
          <ul class="menu">
            <li>
              <a href="">Iniciar sesión</a>
            </li>
          </ul>
        <?php }else{ 
          if (has_nav_menu('menuheader')) {
            wp_nav_menu( array( 'theme_location' => 'menuheader', 'container' => false ) );
          }
        } ?>

        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/hamburguer.svg" alt="Menú" class="icon icon--menu icon--menu__inline" onclick="ToggleMenu('menutop')">

      </div>
    </section>

<?php /*

    <!-- usermenu -->
    <div class="wrap wrap--icon wrap--icon__usermenu" onclick="ToggleMenu('menuuser')">
      <?php
      if(!is_user_logged_in()) // the_svg_icon('doner');
      else wpdc_the_profile_photo($current_user->ID);
      ?>

    </div><!-- end of usermenu -->
    
*/ ?>
    
  </div>
</header>


<?php /*

<!-- rightmenu -->
<?php if (has_nav_menu('menutop')) { ?>
  <nav id="menutop" class="wrap wrap--menu wrap--menu__top js-menu js-fullheight animecubic350">
    <?php wp_nav_menu( array( 'theme_location' => 'menutop', 'container' => false ) ); ?>
  </nav>
<?php } ?><!-- end of rightmenu -->

*/ ?>

<?php //include(locate_template('templates/menus/menu-user.php')); ?> 

<div id="overlaybody" class="overlay overlay--body" onclick="ToggleMenu('close')"></div>