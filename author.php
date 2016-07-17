<?php get_header(); 
  $term_slug  = get_query_var( 'author' );
  $user_info  = get_userdata($term_slug);
  $user_meta  = get_user_meta($term_slug);
  $pageoptions = [];
    if(is_user_role('editor') || is_user_role('administrator') || $user_info->ID == get_current_user_id()) $pageoptions["user_messages"] = "Mensajes";
    if(is_user_role('editor') || is_user_role('administrator')) $pageoptions["user_track"] = "Historial";
    if(is_user_role('editor') || is_user_role('administrator') || $user_info->ID == get_current_user_id()) $pageoptions["userdata"] = "Datos de asociado";
?>
<div class="flexboxer flexboxer--author">

  <?php if ($user_info->ID == get_current_user_id() && get_user_meta(get_current_user_id(), 'asociation_status', 1) == 'pendiente'){ ?>
      <div class="wrap wrap--content wrap--shadow wrap--alert wrap--alert__info">
        <p>Tu solicitud se está tramitando en estos momentos. Te rogamos tengas paciencia.</p>
        <?php include(locate_template('templates/sections/section-close.php')); ?>
      </div>
  <?php } ?>

  <?php if ($user_info->ID == get_current_user_id() && !is_user_role('subscriber')){ ?>

<?php
  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_type' => 'fee',
    'orderby' => 'meta_value',
    'meta_key'  => 'fee_date_end',
  );
  $fee_query = new wp_query( $args );

  if ($fee_query->have_posts()){
    $html_info = '';
    $html_warning = '';
    while ($fee_query->have_posts()) {
      $fee_query->the_post();
      $fee_date_start = get_post_meta(get_the_ID(), 'fee_date_start', true);
      $fee_date_end = get_post_meta(get_the_ID(), 'fee_date_end', true);
      if(strtotime($fee_date_start) < time() && strtotime($fee_date_end) > time()){
        
        $members_payed = is_array(get_post_meta(get_the_ID(), 'members_payed', true)) ? get_post_meta(get_the_ID(), 'members_payed', true) : array();
        $members_pending = is_array(get_post_meta(get_the_ID(), 'members_pending', true)) ? get_post_meta(get_the_ID(), 'members_pending', true) : array();
        if($members_payed[get_current_user_id()] == ''){
          if($members_pending[get_current_user_id()] != '') $html_info .= '<p>Cuota <a href="'.get_the_permalink().'">'.get_the_title().'</a> en proceso de validación</p>';
          else $html_warning .= '<p>Cuota <a href="'.get_the_permalink().'">'.get_the_title().'</a> pendiente de abono.</p>';
        }
      }
    }
    if($html_warning != '') echo '<div class="wrap wrap--content wrap--shadow wrap--alert wrap--alert__warning">'.$html_warning.'</div>';
    if($html_info != '') echo '<div class="wrap wrap--content wrap--shadow wrap--alert wrap--alert__info">'.$html_info.'</div>';
  }

?>

  <?php } ?>

  <!-- admin options -->
  <?php wpdc_the_pageoptions($pageoptions);?>

  <?php include(locate_template('templates/sections/user-info.php')); ?>

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

    /* Datos de asociado */
    if($user_info->ID == get_current_user_id()) $title_section = 'Tus datos de asociado';
    else $title_section = 'Datos de asociado';
    wpdc_the_section_custom( $userdata, 'userdata', $title_section, true);

    /* Messages */
    if($user_info->ID == get_current_user_id()) $title_section = 'Mensajes con '.get_option('blogname');
    else $title_section = 'Mensajes con '. wpdc_get_user_name($user_info->ID);
    wpdc_the_section_messages(get_user_notification_track($user_info->ID, 'type', 'message'), 'user_messages', $title_section, true);

  }

  if(is_user_role('editor') || is_user_role('administrator')){

    /* Historial de registro */
    wpdc_the_section_registry_track(get_user_registry_track($user_info->ID), 'user_track', 'Historial', true);
  }
  
  ?>


</div><!-- end of flexboxer -->
<?php get_footer(); ?>