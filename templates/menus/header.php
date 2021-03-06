<header class="wrap wrap--header wrap--shadow">
  <div class="flexboxer">
    <section class="wrap wrap--frame wrap--flex">
      <div class="wrap wrap--frame wrap--frame__middle">
        <!-- logo -->
        <a href="<?php bloginfo('url'); ?>">
          <?php if(wp_get_attachment_url(get_theme_mod( 'logo_file', true )) != ''){ ?>
            <img alt="logo" class="logo" src="<?php echo wp_get_attachment_url(get_theme_mod( 'logo_file', true )); ?>"/>
          <?php } else { ?>
        	  <img alt="logo" class="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png"/>
          <?php } ?>
        </a><!-- end of logo -->

      </div>
      <div class="wrap wrap--frame wrap--frame__middle text text--right">
        
        <?php if(!is_user_logged_in()){ ?>
          <ul class="menu">
            <li>
              <a href="<?php echo site_url('login');?>">Iniciar sesión</a>
            </li>
          </ul>
        <?php }else{ ?>
          <?php if (has_nav_menu('menuheader')) wp_nav_menu( array( 'theme_location' => 'menuheader', 'container' => false));?>
          <ul class="menu">
            <li>
              <a href="<?php echo get_author_posts_url(get_current_user_id());?>">Perfil</a>
            </li>
          </ul>
        <?php } ?>

        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/user-white.svg" alt="Menú" class="icon icon--menu icon--menu__user icon--menu__inline" onclick="ToggleMenu('menuuser')">

        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/hamburguer.svg" alt="Menú" class="icon icon--menu icon--menu__inline" onclick="ToggleMenu('menutop')">

      </div>
    </section>
  </div>
</header>




<?php 

$args = array(
  'echo'           => true,
  'remember'       => true,
  'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
  'form_id'        => 'loginform',
  'id_username'    => 'user_login',
  'id_password'    => 'user_pass',
  'id_remember'    => 'rememberme',
  'id_submit'      => 'wp-submit',
  'label_username' => __( 'Username' ),
  'label_password' => __( 'Password' ),
  'label_remember' => __( 'Remember Me' ),
  'label_log_in'   => __( 'Log In' ),
  'value_username' => '',
  'value_remember' => false
);

//wp_login_form( $args );


/*

<!-- rightmenu -->
<?php if (has_nav_menu('menutop')) { ?>
  <nav id="menutop" class="wrap wrap--menu wrap--menu__top js-menu js-fullheight animecubic350">
    <?php wp_nav_menu( array( 'theme_location' => 'menutop', 'container' => false ) ); ?>
  </nav>
<?php } ?><!-- end of rightmenu -->

*/ ?>

<?php //include(locate_template('templates/menus/menu-user.php')); ?> 

<div id="overlaybody" class="overlay overlay--body" onclick="ToggleMenu('close')"></div>