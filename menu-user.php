<nav id="menuuser" class="wrap wrap--menu wrap--menu__user js-menu animecubic350">
<?php if(!is_user_logged_in()){

  // Login form
  $args = array(
    'label_username' => __( 'Usuario' ),
    'label_password' => __( 'Contraseña' ),
    'label_remember' => __( 'Recuerdame' ),
    'label_log_in'   => __( 'Iniciar sesión' ),
  );
  wp_login_form( $args ); 
}else{ ?> 
  <ul id="menu-admin-menu-base" class="menu"><li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">

    <li class="menu-item menu-item-type-custom menu-item-object-custom">
      <a href="<?php echo get_author_posts_url(get_current_user_id());?>">Perfil</a>
    </li>

    <?php if(!get_page_by_title('Edit profile') == NULL) { ?>
      <li class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="<?php echo get_bloginfo('url');?>/edit-profile">Editar Perfil</a>
      </li>
    <?php } ?>

    <?php if(is_user_role('administrator')) { ?>
      <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-admin">
        <a onclick="ToggleMenu('menuadmin')">Administración</a>
      </li>
    <?php } ?>

  </ul>
<?php }?>
</nav>


<?php if(is_user_role('administrator')) { ?>
  <nav id="menuadmin" class="wrap wrap--menu wrap--menu__user js-menu animecubic350">
    <ul id="menu-admin-menu-base" class="menu"><li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">

      <li class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="<?php echo get_bloginfo('url');?>/configuration">Configuración de la página</a>
      </li>

      <li class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="<?php echo get_bloginfo('url');?>/configuration-presidence">Presidencia</a>
      </li>

      <li class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="<?php echo get_bloginfo('url');?>/">Secretaría</a>
      </li>

      <li class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="<?php echo get_bloginfo('url');?>/control-users">Control de usuarios</a>
      </li>

      <li class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="<?php echo get_bloginfo('url');?>/configuration-treasury">Tesorería</a>
      </li>

      <li class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="<?php echo get_bloginfo('url');?>/fee">Cuotas</a>
      </li>

      <li class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="<?php echo get_bloginfo('url');?>/edit-fee">Crear cuota</a>
      </li>

      <li class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="<?php echo get_bloginfo('url');?>/pay-fee">Pagar cuota</a>
      </li>

    </ul>
  </nav>
<?php } ?>