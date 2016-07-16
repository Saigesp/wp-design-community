<?php get_header(); 
  $term_slug  = get_query_var( 'author' );
  $user_info  = get_userdata($term_slug);
  $user_meta  = get_user_meta($term_slug);
?>
<div class="flexboxer flexboxer--author">

  <section class="wrap wrap--content wrap--shadow">
    <div class="wrap wrap--frame wrap--flex wrap--userinfo">
      <div class="wrap wrap--frame wrap--frame__100">
        <?php wpdc_the_profile_photo($user_info->ID);?>
      </div>
      <div class="wrap wrap--frame wrap--frame__middle">
        <p>
          <a href="<?php echo get_author_posts_url( $user_info->ID ); ?>">
            <?php echo wpdc_get_user_name($user_info->ID); ?>
          </a>
          <br><?php echo get_user_meta($user_info->ID, 'position', 1);?>
          <br><?php echo change_role_name( get_user_meta($user_info->ID, 'asociation_position', 1)); ?>
        </p>
      </div>
    </div>

    <?php wpdc_the_edit_icon(get_bloginfo('url').'/edit-profile/?id='.$user_info->ID);?>
      
    <div class="description">
      <?php echo html_entity_decode($user_info->description);?>
    </p>
  </section>

  <?php
  if(is_user_role('editor') || is_user_role('administrator') || $user_info->ID == get_current_user_id()){

    $userdata = [
      'DNI' => get_the_author_meta('dbem_dnie', $user_info->ID),
      'Fecha de nacimiento' => get_the_author_meta('bornday', $user_info->ID),
      'Teléfono' => get_the_author_meta('dbem_phone', $user_info->ID),
      'Dirección' => get_the_author_meta('dbem_address', $user_info->ID),
      'Estudios' => get_the_author_meta('titulacion', $user_info->ID),
      'Centro de estudios' => get_the_author_meta('centro_de_estudios', $user_info->ID),
    ];

    if($user_info->ID == get_current_user_id()) $title_section = 'Tus datos de asociado';
    else $title_section = 'Datos de asociado';
  
    wpdc_the_section_custom( $userdata, 'userdata', $title_section);
  }

  if(is_user_role('editor') || is_user_role('administrator')){
    wpdc_the_section_registry_track(get_user_registry_track($user_info->ID), 'user_track', 'Historial de estados');
  }

  
  ?>


</div><!-- end of flexboxer -->
<?php get_footer(); ?>