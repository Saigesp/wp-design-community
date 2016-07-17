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