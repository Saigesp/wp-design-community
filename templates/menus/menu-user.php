<nav id="menu_user" class="menu menu--side menu--side__right menu--user js-menu animecubic350">
<?php if(!is_user_logged_in()){


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

    <?php if(is_user_role('administrator') || is_user_role('editor') || get_user_meta($current_user->ID, 'asociation_responsability', true) != '') { ?>
      <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-admin">
        <a onclick="ToggleMenu('menuadmin')">Administración</a>
      </li>
    <?php } ?>

      <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-logout">
        <a href="<?php echo wp_logout_url();?>">Cerrar sesión</a>
      </li>

  </ul>
<?php }?>
</nav>


<?php if(is_user_role('administrator') || is_user_role('editor')) { ?>
  <nav id="menuadmin" class="wrap wrap--menu wrap--menu__user js-menu animecubic350">
    <ul id="menu-admin-menu-base" class="menu"><li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">

      <?php if(is_user_role('administrator')) { ?>
        <li class="menu-item menu-item-type-custom menu-item-object-custom">
          <a href="<?php echo get_bloginfo('url');?>/configuration">Configuración de la página</a>
        </li>
      <?php } ?>

      <?php if(get_user_meta($current_user->ID, 'asociation_position', true) == 'presidente' || is_user_role('administrator')) { ?>
        <li class="menu-item menu-item-type-custom menu-item-object-custom">
          <a href="<?php echo get_bloginfo('url');?>/configuration-presidence">Presidencia</a>
        </li>
      <?php } ?>

      <?php if(get_user_meta($current_user->ID, 'asociation_position', true) == 'secretario' || is_user_role('administrator')) { ?>
        <li class="menu-item menu-item-type-custom menu-item-object-custom">
          <a href="<?php echo get_bloginfo('url');?>/configuration-secretary">Secretaría</a>
        </li>
      <?php } ?>

      <?php if(get_user_meta($current_user->ID, 'asociation_position', true) == 'tesorero' || is_user_role('administrator')) { ?>
        <li class="menu-item menu-item-type-custom menu-item-object-custom">
          <a href="<?php echo get_bloginfo('url');?>/configuration-treasury">Tesorería</a>
        </li>
      <?php } ?>

      <?php if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_events' || is_user_role('administrator')) { ?>
        <li class="menu-item menu-item-type-custom menu-item-object-custom">
          <a href="<?php echo get_bloginfo('url');?>/configuration-event">Gestión eventos</a>
        </li>
      <?php } ?>

      <?php if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_concursos' || is_user_role('administrator')) { ?>
        <li class="menu-item menu-item-type-custom menu-item-object-custom">
          <a href="<?php echo get_bloginfo('url');?>/configuration-concursos">Gestión de concursos</a>
        </li>
      <?php } ?>

      <li class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="<?php echo get_bloginfo('url');?>/control-users">Control de usuarios</a>
      </li>

    </ul>
  </nav>
<?php } ?>