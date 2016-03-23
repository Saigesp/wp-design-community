<?php

if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

  /* DATOS PERSONALES
  *
  *****************************************************
  */
  // NOMBRE
  if (!empty($_POST['last-name']) && !empty($_POST['last-name'])) update_user_meta($user->ID, 'last_name', esc_attr($_POST['last-name']));

  // APELLIDOS
  if (!empty($_POST['first-name']) && !empty($_POST['first-name']))  update_user_meta( $user->ID, 'first_name', esc_attr($_POST['first-name']));
      
  // DNI
  if (!empty($_POST['dbem_dnie'])) update_user_meta($user->ID, 'dbem_dnie', esc_attr( $_POST['dbem_dnie'] ) );

  // DIRECCIÓN
  if (!empty($_POST['dbem_address'])) update_user_meta($user->ID, 'dbem_address', esc_attr( $_POST['dbem_address'] ) );

  // TELÉFONO
  if (!empty($_POST['dbem_phone'])) update_user_meta($user->ID, 'dbem_phone', esc_attr( $_POST['dbem_phone'] ) );

  // EMAIL
  if (!is_email(esc_attr( $_POST['email'] ))) $error[] = 'El email introducido no es válido, por favor inténtalo de nuevo.';
  elseif(email_exists(esc_attr( $_POST['email'] )) && esc_attr($_POST['email']) != get_the_author_meta('user_email', $user->ID)) $error[] = 'El email introducido ya está siendo usado por otro usuario, prueba con uno diferente';
  else wp_update_user( array ('ID' => $user->ID, 'user_email' => esc_attr( $_POST['email'] )));

  // IMAGEN DE PERFIL
  //if (!empty($_POST['async-upload'])) update_user_meta( $user->ID, 'foto_personal', $_POST['html-upload'] );

  // PÁGINA WEB
  if (!empty($_POST['user_url'])) wp_update_user( array ('ID' => $user->ID, 'user_url' => esc_attr( $_POST['user_url'] )));

  // PSEUDONIMO
  if (!empty($_POST['pseudonimo'])) update_user_meta($user->ID, 'pseudonimo', esc_attr( $_POST['pseudonimo'] ) );

  // DESCRIPCIÓN
  if (!empty($_POST['description'])) update_user_meta( $user->ID, 'description', esc_attr( $_POST['description'] ) );



  /* REDES SOCIALES
  *
  *****************************************************
  */
  // TWITTER
  if ($_POST['twitter'][0] == '@')
    $_POST['twitter'] = substr($_POST['twitter'], 1); 
  if (substr($_POST['twitter'], 0, 4) == 'http')
    $_POST['twitter'] = substr(strrchr($_POST['twitter'], "/"), 1);
  update_user_meta($user->ID, 'twitter', esc_attr($_POST['twitter']));

  // FACEBOOK
  if (substr($_POST['facebook'], 0, 4) == 'http') $_POST['facebook'] = substr(strrchr($_POST['facebook'], "/"), 1);
  update_user_meta( $user->ID, 'facebook', esc_attr( $_POST['facebook'] ) );

  // LINKEDIN
  if (substr($_POST['linkedin'], 0, 56) == 'https://www.linkedin.com/profile/public-profile-settings') $_POST['linkedin'] = '';
  update_user_meta( $user->ID, 'linkedin', esc_attr( $_POST['linkedin'] ) );
          
  // TUMBLR
  update_user_meta( $user->ID, 'tumblr', esc_attr( $_POST['tumblr'] ) );

  // BEHANCE
  if (substr($_POST['behance'], 0, 4) == 'http') $_POST['behance'] = substr(strrchr($_POST['behance'], "/"), 1);
  update_user_meta( $user->ID, 'behance', esc_attr( $_POST['behance'] ) );
  
  //DOMESTIKA
  if (substr($_POST['domestika'], 0, 4) == 'http') $_POST['domestika'] = substr(strrchr($_POST['domestika'], "/"), 1);
  update_user_meta( $user->ID, 'domestika', esc_attr( $_POST['domestika'] ) );

  // GOOGLE PLUS
  update_user_meta( $user->ID, 'googleplus', esc_attr( $_POST['googleplus'] ) );


  /* DATOS PROFESIONALES
  *
  *****************************************************
  */
  // TITULACIÓN
  if (!empty($_POST['titulacion'])) update_user_meta( $user->ID, 'titulacion', esc_attr( $_POST['titulacion'] ) );

  // CENTRO DE ESTUDIOS
  if (!empty($_POST['centro_de_estudios'])) update_user_meta( $user->ID, 'centro_de_estudios', esc_attr( $_POST['centro_de_estudios'] ) );

  // TIPO
  if (!empty($_POST['type'])) update_user_meta( $user->ID, 'type', $_POST['type']);

  // ESPECIALIDAD
  if(isset($_POST['especialidad'])){
    if (sizeof($_POST['especialidad']) > 3) {
      $error[] = 'Solo puedes seleccionar 3 áreas de experiencia como máximo.';
    } else {
      update_user_meta( $user->ID, 'especialidad', $_POST['especialidad']); 
    }
  } 


  /* DATOS DE ASOCIADO
  *
  *****************************************************
  */


  /* DATOS DE LA PÁGINA
  *
  *****************************************************
  */
  // ROL
  if (!empty($_POST['roles'])){
    $WP_User = new WP_User($user->ID);
    foreach( $WP_User->roles as $role ) {
      $role = get_role( $role );
      if ( $role != null ) $user->remove_role($role->name);
    } 
    $user->add_role(esc_attr( $_POST['roles'] ));
  }

  // CARGO
  update_user_meta( $user->ID, 'asociation_position', $_POST['asociation_position']);

  // PERFIL PÚBLICO
  if (!empty($_POST['perfil_publico'])){
    update_user_meta( $user->ID, 'perfil_publico', $_POST['perfil_publico']);
    global $wp_rewrite;
    $wp_rewrite->flush_rules( false );
  }

  // KARMA
  if (!empty($_POST['karma'])) {
   $op_user = get_user_meta($user_id, 'op_user', true );
   $op_user['karma'] = esc_attr( $_POST['karma'] );
   update_user_meta($user_id, 'op_user', $op_user );
  }

  // INVITACIONES
  if (!empty($_POST['invitations'])) {
   $op_user = get_user_meta($user_id, 'op_user', true );
   $op_user['invitations'] = esc_attr( $_POST['invitations'] );
   update_user_meta($user_id, 'op_user', $op_user );
  }

  if ( count($error) == 0 ) {
        do_action('edit_user_profile_update', $user->ID);
        wp_redirect( get_permalink() );
        exit;
    }
}





  /* CAMBIO DE GOBIERNO
  *
  *****************************************************
  */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-govern' ) {
  $cargos = array('presidente', 'vicepresidente', 'secretario', 'tesorero');
  foreach ($cargos as $cargo) {
    if (!empty($_POST[$cargo])){
      // Quitar rol de editor a anterior
      $juntales = get_users();
      foreach ($juntales as $juntal) {
        if (get_the_author_meta('asociation_position', $juntal->ID) == $cargo ){
          $juntal->remove_role('editor');
          $juntal->add_role(esc_attr('author'));
          update_user_meta($juntal->ID, 'asociation_position', '' );
        } 
      }
      //Añadir rol de editor
      $juntales = get_users();
      foreach ($juntales as $juntal) {
        if ($juntal->ID == $_POST[$cargo] ){
          $juntal->remove_role('author');
          $juntal->add_role(esc_attr('editor'));
          update_user_meta($juntal->ID, 'asociation_position', $cargo );
        } 
      }
    }
  }
  if (!empty($_POST['vocales'])){
      // Quitar rol a anteriores
      $juntales = get_users();
      foreach ($juntales as $juntal) {
        if (get_the_author_meta('asociation_position', $juntal->ID) == 'vocal'){
          $juntal->remove_role('editor');
          $juntal->add_role(esc_attr('author'));
          update_user_meta($juntal->ID, 'asociation_position', '' );
        } 
      }
      // Añadir rol a nuevo
      foreach ($_POST['vocales'] as $vocal_id) {
        $vocal = get_userdata($vocal_id);
          $vocal->remove_role('author');
          $vocal->add_role(esc_attr('editor'));
          update_user_meta($vocal_id, 'asociation_position', 'vocal' );
      }
  }



}





/* CAMBIO ESTATUS DE ASOCIADO
*
*****************************************************
*/
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-secretary' ) {
  if(!empty($_POST['asociate'])){
    $new_socis = $_POST['asociate'];
    foreach ($new_socis as $user_id) {
      $user = get_userdata($user_id);
      $user->remove_role('subscriber');
      $user->add_role('author');
    }
  }

  if(!empty($_POST['desasociate'])){
    $old_socis = $_POST['desasociate'];
    foreach ($old_socis as $soc_id) {
      $soc = get_userdata($soc_id);
      $soc->add_role('subscriber');
      $soc->remove_role('author');
    }
  }
}












/* NUEVA CUOTA
*
*****************************************************
*/
 
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'new-fee' ) {

    $hasError = false;
    $publish_status = 'publish';
    $publish_type = 'fee';

    if (trim($_POST['fee_name']) === '') $hasError = true;
    if (!is_numeric($_POST['fee_quantity'])) $hasError = true;

    if(!$hasError){
      $post_information = array(
          'post_title' => wp_strip_all_tags( $_POST['fee_name'] ),
          'post_content' => 'Ey',
          'post_type' => $publish_type,
          'post_status' => $publish_status,
      );
      $post_id = wp_insert_post( $post_information );

      update_post_meta($post_id, 'fee_date', esc_attr($_POST['fee_date']));
      update_post_meta($post_id, 'fee_quantity', esc_attr($_POST['fee_quantity']));
      
      //if ( $post_id )  wp_redirect( 'http://xn--diseadoresindustriales-nec.es/preguntas/?send=ok' ); exit;
    } 
}


/* ACTUALIZAR CUOTA
*
*****************************************************
*/
 
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-fee' ) {

      //update_post_meta($post_id, 'fee_date', esc_attr($_POST['fee_date']));
      //update_post_meta($post_id, 'fee_quantity', esc_attr($_POST['fee_quantity']));
      $post_id = $_POST['fee_id'];
      $hasError = false;
      if ($post_id == '') $hasError = true;

      if(!$hasError){

        //Añadir abono
        if(!empty($_POST['members_payed']) && is_array($_POST['members_payed']) ){
          $payed_members = get_post_meta($post_id, 'members_payed', true);
          if(!is_array($payed_members)) $payed_members = array();
          foreach ($_POST['members_payed'] as $user_id) {
            if( ($key = array_search($user_id, $payed_members)) === false) $payed_members[$user_id] = current_time('mysql');
          }
          update_post_meta($post_id, 'members_payed', $payed_members);
        }

        //Añadir abono pendiente
        if(!empty($_POST['members_pending']) && is_array($_POST['members_pending']) ){
          $pending_members = get_post_meta($post_id, 'members_pending', true);
          if(!is_array($pending_members)) $pending_members = array();
          foreach ($_POST['members_pending'] as $user_id) {
            if( ($key = array_search($user_id, $pending_members)) === false) $pending_members[$user_id] = current_time('mysql');
          }
          update_post_meta($post_id, 'members_pending', $pending_members);
        }

        // Quitar abono
        if(!empty($_POST['members_paydown']) && is_array($_POST['members_paydown']) ){
          $payed_members = get_post_meta($post_id, 'members_payed', true);
          if(!is_array($payed_members)) $payed_members = array();
          foreach ($_POST['members_paydown'] as $user_id) {
            if($payed_members[$user_id] != '') unset($payed_members[$user_id]);
          }
          update_post_meta($post_id, 'members_payed', $payed_members);
        }

        // Quitar abono pendiente
        if(!empty($_POST['members_pendingdown']) && is_array($_POST['members_pendingdown']) ){
          $pending_members = get_post_meta($post_id, 'members_pending', true);
          if(!is_array($pending_members)) $pending_members = array();
          foreach ($_POST['members_pendingdown'] as $user_id) {
            if($pending_members[$user_id] != '') unset($pending_members[$user_id]);
          }
          update_post_meta($post_id, 'members_pending', $pending_members);
        }

        // Validar abono pendiente
        if(!empty($_POST['members_validate']) && is_array($_POST['members_validate']) ){
          $payed_members = get_post_meta($post_id, 'members_payed', true);
          $pending_members = get_post_meta($post_id, 'members_pending', true);
          if(!is_array($pending_members)) $pending_members = array();
          if(!is_array($payed_members)) $payed_members = array();
          foreach ($_POST['members_validate'] as $user_id) {
            if($pending_members[$user_id] != '') unset($pending_members[$user_id]);
            if( ($key = array_search($user_id, $payed_members)) === false) $payed_members[$user_id] = current_time('mysql');
          }
          update_post_meta($post_id, 'members_pending', $pending_members);
          update_post_meta($post_id, 'members_payed', $payed_members);          
        }

      }

}



/* PAGAR CUOTA
*
*****************************************************
*/
 
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'pay-fee' ) {
  $post_id = get_the_ID();
  $user_id = get_current_user_id();
  $paymethod = $_POST['paymethod'];
  $hasError = false;
  if ($post_id == '') $hasError = true;
  if ($paymethod == '') $hasError = true;
  if (!is_singular('fee'))  $hasError = true;
  if (!is_numeric($user_id))  $hasError = true;

  if(!$hasError){

    if($paymethod == 'transferency'){
      $pending_members = get_post_meta($post_id, 'members_pending', true);
      if(!is_array($pending_members)) $pending_members = array();
      if (!in_array($user_id, $pending_members)) $pending_members[$user_id] = current_time('mysql');
      update_post_meta($post_id, 'members_pending', $pending_members);
    }elseif($paymethod == 'paypal'){
      //TODO Pago por paypal
    }else{
      //TODO Errores
    }
  }else{
    //TODO Errores
  }

}

?>