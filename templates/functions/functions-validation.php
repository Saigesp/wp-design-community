<?php if('POST' == $_SERVER['REQUEST_METHOD'] && !empty(esc_attr($_POST['action']))){ 

  $alerts_success = '';
  $alerts_error = '';
  $alerts_warning = '';
  $alerts_info = '';

  /* CAMBIO DE PERFIL
  *
  *****************************************************
  */


if (esc_attr($_POST['action']) == 'update-user' || (esc_attr($_POST['action']) == 'upgrade' && $_POST['updatesection'] == 'upgradeuser')) {
  if(esc_attr($_POST['action']) == 'update-user') $user_id = $user->ID;
  if($_POST['updatesection'] == 'upgradeuser') $user_id = get_current_user_id();
  /* DATOS PERSONALES */
  // NOMBRE
  if (!empty(esc_attr($_POST['last_name']))) update_user_meta($user_id, 'last_name', esc_attr($_POST['last_name']));

  // APELLIDOS
  if (!empty(esc_attr($_POST['first_name'])))  update_user_meta( $user_id, 'first_name', esc_attr($_POST['first_name']));
      
  // DNI
  if (!empty(esc_attr($_POST['dbem_dnie']))) update_user_meta($user_id, 'dbem_dnie', esc_attr($_POST['dbem_dnie']) );


  // FECHA DE NACIMIENTO
  update_user_meta($user_id, 'bornday', $_POST['bornday'] );      

  // POSITION
  if (!empty(esc_attr($_POST['position']))) update_user_meta($user_id, 'position', esc_attr($_POST['position']) );

  // DIRECCIÓN
  if (!empty(esc_attr($_POST['dbem_address']))) update_user_meta($user_id, 'dbem_address', esc_attr($_POST['dbem_address']) );

  // TELÉFONO
  if (!empty(esc_attr($_POST['dbem_phone']))) update_user_meta($user_id, 'dbem_phone', esc_attr($_POST['dbem_phone']) );

  // EMAIL
  if (!is_email(esc_attr( $_POST['email'] ))) $error[] = 'El email introducido no es válido, por favor inténtalo de nuevo.';
  elseif(email_exists(esc_attr( $_POST['email'] )) && esc_attr($_POST['email']) != get_the_author_meta('user_email', $user_id)) $error[] = 'El email introducido ya está siendo usado por otro usuario, prueba con uno diferente';
  else wp_update_user( array ('ID' => $user_id, 'user_email' => esc_attr( $_POST['email'] )));

  // IMAGEN DE PERFIL
  //if (!empty($_POST['async-upload'])) update_user_meta( $user_id, 'foto_personal', $_POST['html-upload'] );

  // PÁGINA WEB
  if (!empty(esc_attr($_POST['user_url']))) wp_update_user( array ('ID' => $user_id, 'user_url' => esc_attr($_POST['user_url'])));

  // PSEUDONIMO
  if (!empty(esc_attr($_POST['pseudonimo']))) update_user_meta($user_id, 'pseudonimo', esc_attr($_POST['pseudonimo']));

  // DESCRIPCIÓN
  if (!empty(esc_attr($_POST['description']))) update_user_meta( $user_id, 'description', esc_attr($_POST['description']));


  // FECHA DE NACIMIENTO
  update_user_meta($user_id, 'bornday', esc_attr($_POST['bornday']) );

  /* REDES SOCIALES */
  // TWITTER
  if ($_POST['twitter'][0] == '@')
    $_POST['twitter'] = substr($_POST['twitter'], 1); 
  if (substr($_POST['twitter'], 0, 4) == 'http')
    $_POST['twitter'] = substr(strrchr($_POST['twitter'], "/"), 1);
  update_user_meta($user_id, 'twitter', esc_attr($_POST['twitter']));

  // FACEBOOK
  if (substr($_POST['facebook'], 0, 4) == 'http') $_POST['facebook'] = substr(strrchr($_POST['facebook'], "/"), 1);
  update_user_meta( $user_id, 'facebook', esc_attr( $_POST['facebook'] ) );

  // LINKEDIN
  if (substr($_POST['linkedin'], 0, 56) == 'https://www.linkedin.com/profile/public-profile-settings') $_POST['linkedin'] = '';
  update_user_meta( $user_id, 'linkedin', esc_attr( $_POST['linkedin'] ) );
          
  // TUMBLR
  update_user_meta( $user_id, 'tumblr', esc_attr( $_POST['tumblr'] ) );

  // BEHANCE
  if (substr($_POST['behance'], 0, 4) == 'http') $_POST['behance'] = substr(strrchr($_POST['behance'], "/"), 1);
  update_user_meta( $user_id, 'behance', esc_attr( $_POST['behance'] ) );
  
  //DOMESTIKA
  if (substr($_POST['domestika'], 0, 4) == 'http') $_POST['domestika'] = substr(strrchr($_POST['domestika'], "/"), 1);
  update_user_meta( $user_id, 'domestika', esc_attr( $_POST['domestika'] ) );

  // GOOGLE PLUS
  update_user_meta( $user_id, 'googleplus', esc_attr( $_POST['googleplus'] ) );


  /* DATOS PROFESIONALES */
  // TITULACIÓN
  if (!empty($_POST['titulacion'])) update_user_meta( $user_id, 'titulacion', esc_attr( $_POST['titulacion'] ) );

  // CENTRO DE ESTUDIOS
  if (!empty($_POST['centro_de_estudios'])) update_user_meta( $user_id, 'centro_de_estudios', esc_attr( $_POST['centro_de_estudios'] ) );

  // TIPO
  if (!empty($_POST['type'])) update_user_meta( $user_id, 'type', $_POST['type']);

  // ESPECIALIDAD
  if(isset($_POST['especialidad'])){
    if (sizeof($_POST['especialidad']) > 3) {
      $error[] = 'Solo puedes seleccionar 3 áreas de experiencia como máximo.';
    } else {
      update_user_meta( $user_id, 'especialidad', $_POST['especialidad']); 
    }
  } 


  /* DATOS DE ASOCIADO */


  /* DATOS DE LA PÁGINA */
  // ROL
  if (!empty($_POST['roles'])){
    $WP_User = new WP_User($user_id);
    foreach( $WP_User->roles as $role ) {
      $role = get_role( $role );
      if ( $role != null ) $user->remove_role($role->name);
    } 
    $user->add_role(esc_attr( $_POST['roles'] ));
  }

  // CARGO
  update_user_meta( $user_id, 'asociation_position', $_POST['asociation_position']);

  // PERFIL PÚBLICO
  if (!empty($_POST['perfil_publico'])){
    update_user_meta( $user_id, 'perfil_publico', $_POST['perfil_publico']);
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
        do_action('edit_user_profile_update', $user_id);
        wp_redirect( get_permalink() );
        exit;
    }

  $alerts_success .= 'Datos de usuario actualizados';

}


/* INVITAR/CREAR USUARIO
*
*****************************************************
*/ /*
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'create-user' ) {

    $email_address = $_POST['user_reg'];
    if ( null == username_exists( $email_address ) && $email_address!= '') {
      $password = wp_generate_password( 12, false );
      $user_id = wp_create_user( $email_address, $password, $email_address );
      wp_update_user(array( 'ID' => $user_id, 'nickname' => $email_address));
      //$op_user = get_the_author_meta('op_user',$current_user->ID, true);
      //if (is_array($op_user['hainvitado'])){
      //  array_push($op_user['hainvitado'], $user_id);
      //} 
      //update_user_meta($current_user->ID, 'op_user', $op_user );    
      $user = new WP_User( $user_id ); 
    }
    //echo $email_adress;

} */



/* UPGRADE USER
*
******************************************************/
if (esc_attr($_POST['action']) == 'upgrade' && !empty(esc_attr($_POST['updatesection']))) {

  if (esc_attr($_POST['updatesection']) == 'upgradeuser'){
    $user_id = get_current_user_id();
    if($user_id > 0){

      update_user_meta($user_id, 'asociation_status', 'pendiente' );
      update_user_registry_track($user_id, 'pendiente');
      $alerts_success .= '<p>Solicitud enviada!</p>';
    }
  }
  
}





/* CONFIGURACIÓN ADMIN
*
******************************************************/
 
if (esc_attr($_POST['action']) == 'configuration'  && is_user_role('administrator')) {

  if (!empty($_POST['updatesection']) && $_POST['updatesection'] == 'general-options'){
    $users_can_register = $_POST["users_can_register"] == 1 ? 1 : 0; update_option("users_can_register", $users_can_register);
    $users_can_asociate = $_POST["users_can_asociate"] == 1 ? 1 : 0; update_option("users_can_asociate", $users_can_asociate);
    $fields_asociate_min = $_POST["fields_asociate_min"]; update_option("fields_asociate_min", $fields_asociate_min);
    $alerts_success .= 'Opciones actualizadas';
  }
  if (!empty($_POST['updatesection']) && $_POST['updatesection'] == 'twitteroptions'){
    $automate_twitter = esc_attr($_POST["automate_twitter"]); update_option("automate_twitter", $automate_twitter);
    $consumer_key = esc_attr($_POST["consumer_key"]); update_option("consumer_key", $consumer_key);
    $consumer_secret = esc_attr($_POST["consumer_secret"]); update_option("consumer_secret", $consumer_secret);
    $access_token = esc_attr($_POST["access_token"]); update_option("access_token", $access_token);
    $access_token_secret = esc_attr($_POST["access_token_secret"]); update_option("access_token_secret", $access_token_secret);
    $tweet_new_user = esc_attr($_POST["tweet_new_user"]); update_option("tweet_new_user", $tweet_new_user);
    $follow_new_user = esc_attr($_POST["follow_new_user"]); update_option("follow_new_user", $follow_new_user);
    $tweet_new_publication = esc_attr($_POST["tweet_new_publication"]); update_option("tweet_new_publication", $tweet_new_publication);
    $alerts_success .= 'Configuración de twitter guardada';
  }
  if (!empty($_POST['updatesection']) && $_POST['updatesection'] == 'tweet-test'){
    $tweet_msg = 'Test';
    $respuesta = sendTweet($tweet_msg);
    $alerts_success .= 'Tweet enviado!';
  }
  if (!empty($_POST['updatesection']) && $_POST['updatesection'] == 'texts-update'){
    $tos_link = esc_attr($_POST["tos_link"]); update_option("tos_link", $tos_link);
    $text_subscriber_upgrade = esc_attr($_POST["text_subscriber_upgrade"]); update_option("text_subscriber_upgrade", $text_subscriber_upgrade);
    $text_register = esc_attr($_POST["text_register"]); update_option("text_register", $text_register);

    $alerts_success .= 'Configuración de textos actualizada';
  }

}



/* CONFIGURACION PRESIDENCIA
*
*****************************************************
*/
if (esc_attr($_POST['action']) == 'configuration-presidence'  && (get_user_meta($current_user->ID, 'asociation_position', true) == 'presidente' || is_user_role('administrator'))) {

  $msg = '';
  $cargos = array('presidente', 'vicepresidente', 'secretario', 'tesorero');
  $responsabilities = array('rp_events', 'rp_concursos', 'rp_jobs', 'rp_posts');
  $juntales = get_users();

  // Change govern
  if (!empty($_POST['updatesection']) && $_POST['updatesection'] == 'changegovern'){


    // Change vicepresident, secretary, treasury
    foreach ($cargos as $cargo) {
      foreach ($juntales as $juntal) {
        if (get_the_author_meta('asociation_position', $juntal->ID) == $cargo && $juntal->ID != $_POST[$cargo]){
          $juntal->remove_role('editor');
          $juntal->add_role(esc_attr('author'));
          update_user_meta($juntal->ID, 'asociation_position', '' );
          update_user_registry_track($juntal->ID, 'sin cargo');
        }
      }
      foreach ($juntales as $juntal) {
        if ($juntal->ID == $_POST[$cargo] && get_the_author_meta('asociation_position', $juntal->ID) != $cargo){
          $juntal->remove_role('author');
          $juntal->add_role(esc_attr('editor'));
          update_user_meta($juntal->ID, 'asociation_position', $cargo );
          $msg .= '<p>El usuario '.wpdc_the_user_name($juntal->ID).' ahora es '.change_role_name($cargo).'</p>';
          update_user_registry_track($juntal->ID, change_role_name($cargo));
        } 
      }
    }

    // Change vocals
    foreach ($juntales as $juntal) {
      if (get_the_author_meta('asociation_position', $juntal->ID) == 'vocal' && !in_array($juntal->ID, $_POST['vocal'])){
        $juntal->remove_role('editor');
        $juntal->add_role(esc_attr('author'));
        update_user_meta($juntal->ID, 'asociation_position', '' );
        update_user_registry_track($juntal->ID, 'sin cargo');
      } 
    }
    foreach ($_POST['vocal'] as $vocal_id) {
      if(get_the_author_meta('asociation_position', $vocal_id) == 'vocal') continue;
      $vocal = get_userdata($vocal_id);
      $vocal->remove_role('author');
      $vocal->add_role(esc_attr('editor'));
      update_user_meta($vocal_id, 'asociation_position', 'vocal' );
      $msg .= '<p>El usuario '.wpdc_the_user_name($vocal_id).' ahora es vocal</p>';
      update_user_registry_track($vocal_id, change_role_name('vocal'));
    }

    // Change responsabilities
    foreach($responsabilities as $responsability){
      //if(is_array($_POST[$responsability])){
        foreach ($juntales as $user) {
          if(is_array($_POST[$responsability])){
            if (get_the_author_meta('asociation_responsability', $user->ID) == $responsability && !in_array($user->ID, $_POST[$responsability])){
              update_user_meta($user->ID, 'asociation_responsability', '' );
              update_user_registry_track($user->ID, 'sin responsabilidad');
            }
          }
        }
        if(is_array($_POST[$responsability])){
          foreach ($_POST[$responsability] as $user_id){
            if (get_the_author_meta('asociation_responsability', $user_id) == $responsability) continue;
            update_user_meta($user_id, 'asociation_responsability', $responsability );
            $msg .= '<p>El usuario '.wpdc_the_user_name($user_id).' ahora es '.change_role_name($responsability).'</p>';
            update_user_registry_track($user_id, change_role_name($responsability));
          }
        }
     // }
    }

  }
  if (!empty($_POST['updatesection']) && $_POST['updatesection'] == 'changecapacities') {

    // Change permissions
    if(!empty($_POST['capacity_mode'])){
      if(get_option('capacity_mode') !== $_POST['capacity_mode']){
        change_options('capacity_mode', $_POST['capacity_mode'], 'yes');
        $msg .= '<p>Permisos del sistema cambiados</p>';
      }
    }

    if(!empty($_POST['transparency_mode'])){
      if(get_option('transparency_mode') !== $_POST['transparency_mode']){
        change_options('transparency_mode', $_POST['transparency_mode'], 'no');
        $msg .= '<p>Transparencia del sistema cambiada</p>';
      }
    }

    if(!empty($_POST['active_section'])){
      change_options('active_section', $_POST['active_section'], 'yes');
      $msg .= '<p>Secciones activas cambiadas</p>';
    }
    
  }
  if (esc_attr($_POST['updatesection']) == 'changepresident') {

    // Change president
    if (!empty($_POST['presidente'])){
      foreach ($juntales as $juntal) {
        if (get_the_author_meta('asociation_position', $juntal->ID) == 'presidente' ){
          $juntal->remove_role('editor');
          $juntal->add_role(esc_attr('author'));
          update_user_meta($juntal->ID, 'asociation_position', '' );
          update_user_registry_track($juntal->ID, 'sin cargo');
        } 
      }
      foreach ($juntales as $juntal) {
        if ($juntal->ID == $_POST['presidente'] ){
          $juntal->remove_role('author');
          $juntal->add_role(esc_attr('editor'));
          update_user_meta($juntal->ID, 'asociation_position', 'presidente' );
          $msg .= '<p>El usuario '.wpdc_the_user_name($juntal->ID).' es el nuevo lider!</p>';
          update_user_registry_track($juntal->ID, change_role_name('presidente'));
        } 
      }
    }

  }

  if($msg) $alerts_success .= $msg;
}









/* CONFIGURATION SECRETARY
*
*****************************************************
*/
if (esc_attr($_POST['action']) == 'configuration-secretary' ) {

  if (esc_attr($_POST['updatesection']) == 'change_member_status') {  
    $msg = '';

    if(!empty($_POST['asociate'])){
      $new_socis = $_POST['asociate'];
      foreach ($new_socis as $user_id) {
        $user = get_userdata($user_id);
        $user->remove_role('subscriber');
        $user->add_role('author');
        update_user_meta($user_id, 'asociation_status', 'validado' );
        $msg .= '<p>El usuario '.wpdc_the_user_name($user_id).' ahora es socio</p>';
        update_user_registry_track($user_id, 'socio');
      }
      $alerts_success .= $msg;
    }

    if(!empty($_POST['desasociate'])){
      $old_socis = $_POST['desasociate'];
      $msg = '';
      foreach ($old_socis as $soc_id) {
        $soc = get_userdata($soc_id);
        $soc->add_role('subscriber');
        $soc->remove_role('author');
        update_user_meta($user_id, 'asociation_status', '' );
        $msg .= '<p>El usuario '.wpdc_the_user_name($user_id).' ya no es socio</p>';
        update_user_registry_track($user_id, 'exsocio');
      }
      $alerts_success .= $msg;
    }
  }

  if (esc_attr($_POST['updatesection']) == 'validatemembers') {

    if(!empty($_POST['members_tovalide']) && is_array($_POST['members_tovalide']) ){
      foreach ($_POST['members_tovalide'] as $user_id){
        $user = get_userdata($user_id);
        $user->remove_role('subscriber');
        $user->add_role('author');
        update_user_meta($user_id, 'asociation_status', 'validado' );
        update_user_registry_track($user_id, 'validado');
        $msg .= '<p>El usuario '.wpdc_the_user_name($user_id).' ahora es socio</p>';
        update_user_registry_track($user_id, 'socio');
      }
    }

    if(!empty($_POST['members_tosuspend']) && is_array($_POST['members_tosuspend']) ){
      foreach ($_POST['members_tosuspend'] as $user_id){
        update_user_meta($user_id, 'asociation_status', '' );
        update_user_registry_track($user_id, '');
      }
    }
  }

  if (esc_attr($_POST['updatesection']) == 'publish_document') {
    
    $max_file_archives = 10; // Define how many images can be uploaded to the current post
    $wp_upload_dir = wp_upload_dir();
    $path = $wp_upload_dir['path'] . '/';
    $count = 0;
    $msg_ok = '';
    $msg_e = '';
    $publish_status = 'publish';
    $publish_type = 'documentos';

    if(count($_POST['files']) > $max_file_archives) {
        $msg_e .= "<p>No puedes subir más de " . $max_file_archives . " archivos a la vez</p>";
    } else {
      $post_information = array(
        'post_title' => wp_strip_all_tags( $_POST['files-filename'] ),
        'post_content' => '[Post con documentos adjuntos]',
        'post_type' => $publish_type,
        'post_status' => $publish_status,
      );
      $post_id = wp_insert_post( $post_information );

      foreach ( $_POST['files'] as $f => $name ) {
        $count++;
        $extension = pathinfo( $name, PATHINFO_EXTENSION );
        $new_filename = $name;
        $filename = $path.$new_filename;
        $filetype = wp_check_filetype( basename( $filename ), null );
        $wp_upload_dir = wp_upload_dir();
        $attachment = array(
          'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
          'post_mime_type' => $filetype['type'],
          'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
          'post_content'   => '',
          'post_status'    => 'inherit'
        );
        // Insert attachment to the database
        $attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
        require_once( ABSPATH . 'wp-admin/includes/image.php' );

        // Generate meta data
        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename ); 
        wp_update_attachment_metadata( $attach_id, $attach_data );

        $msg_ok .= "<p>".$filename." subido correctamente</p>";                    
      }
    }

    if($msg_e != ''){
      $alerts_error .= $msg_e;
    }
    if($msg_ok != ''){
      $alerts_success .= $msg_ok;
    }
  }

  if ( esc_attr($_POST['updatesection']) == 'removedoc' ) {
    $cont = 0;
    $cont_files = 0;
    if(!empty($_POST['docs_remove']) && is_array($_POST['docs_remove'])){
      foreach ($_POST['docs_remove'] as $post_id) {
        $cont++;
        $attachments = get_posts( array(
            'post_type' => 'attachment',
            'posts_per_page' => -1,
            'post_parent' => $post_id
        ));
        if ($attachments) {
          foreach ( $attachments as $attachment ) {
            $cont_files++;
            wp_delete_attachment( $attachment->ID, true );
          }
        }
        wp_delete_post( $post_id, true );
      }
      $alerts_success .= '<p>'.$cont.' paquetes y '.$cont_files.' archivos eliminados</p>';
    }
  }


}












/* CONFIGURACIÓN TESORERIA
*
******************************************************/
 
if (esc_attr($_POST['action']) == 'configuration-treasury'  && (get_user_meta($current_user->ID, 'asociation_position', true) == 'tesorero' || is_user_role('administrator'))) {


  if ( esc_attr($_POST['updatesection']) == 'newfee' ) {
    $hasError = false;
    $publish_status = 'publish';
    $publish_type = 'fee';
    $msg = '';

    if (trim($_POST['fee_name']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el nombre de la cuota!</p>';
    }
    if (!is_numeric($_POST['fee_quantity'])) {
      $hasError = true;
      $msg .= '<p>Falta la cantidad de la cuota!</p>';
    }

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
      
      $alerts_success .= '<p>Cuota '.$_POST['fee_name'].' creada</p>';
      
    }else{
      $alerts_error .= $msg;
    }
  }
  if ( esc_attr($_POST['updatesection']) == 'updatefee' ) {

  }
  if ( esc_attr($_POST['updatesection']) == 'banksaccount' ) {

    $msg = '';

    if(get_option("bank_account") != esc_attr($_POST["bank_account"])){
      $bank_account = esc_attr($_POST["bank_account"]);
      update_option("bank_account", $bank_account);
      $msg .= '<p>Cuenta bancaria actualizada</p>';
    }
    
    if(get_option("paypal_account") != esc_attr($_POST["paypal_account"])){
      $paypal_account = esc_attr($_POST["paypal_account"]);
      update_option("paypal_account", $paypal_account);
      $msg .= '<p>Cuenta de paypal actualizada</p>';
    }
    
    if(get_option("paypal_button_fee") != esc_attr($_POST["paypal_button_fee"])){
      $paypal_account = esc_attr($_POST["paypal_button_fee"]);
      update_option("paypal_button_fee", $paypal_account);
      $msg .= '<p>Botón de paypal actualizado</p>';
    }

    if($msg != '') $alerts_success .= $msg;

  }
}



/* PAGAR CUOTA
*
*****************************************************
*/
 
if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty(esc_attr($_POST['action']))) {
 
  global $post;
  $action_check = 'fee/'.$post->post_name;

  if (esc_attr($_POST['action']) == $action_check) {

    if ( esc_attr($_POST['updatesection']) == 'payfee' ) {

      $post_id = get_the_ID();
      $user_id = get_current_user_id();
      $paymethod = $_POST['paymethod'];
      $hasError = false;
      $msg = '';

      if ($post_id == ''){
        $hasError = true;
        $msg .= '<p>Error :/</p>';
      }
      if ($paymethod == ''){
        $hasError = true;
        $msg .= '<p>Método de pago no seleccionado</p>';
      }
      if (!is_singular('fee')){
        $hasError = true;
        $msg .= '<p>¿Qué intentas?</p>';
      }
      if (!is_numeric($user_id) || $user_id < 1){
        $hasError = true;
        $msg .= '<p>Usuario inválido</p>';
      }

      if(!$hasError){

        $treasury_page = get_page_by_title('Configuration treasury');
        $username = wpdc_get_user_name($user_id);

        if($paymethod == 'transferency'){

          $pending_members = get_post_meta($post_id, 'members_pending', true);
          if(!is_array($pending_members))
            $pending_members = array();
          if (!in_array($user_id, $pending_members))
            $pending_members[$user_id] = current_time('mysql');

          update_post_meta($post_id, 'members_pending', $pending_members);
          $alerts_success .= '<p>Cuota actualizada</p>';
          $message = '<a href="'.get_permalink($post_id).'">'.$username.' pagará '.get_the_title($post_id).' mediante transferencia</a><a href="#hidden">'.current_time('mysql').'</a>';

        }elseif($paymethod == 'paypal'){
          //TODO Pago por paypal
        }else{
          //TODO Errores
        }

      $commentdata = array(
        'comment_post_ID' => $treasury_page->ID,
        'comment_author' => $username,
        'comment_author_email' => get_userdata($user_id)->user_email,
        'comment_author_url' => get_userdata($user_id)->user_url,
        'comment_content' => $message,
        'comment_type' => '',
        'comment_parent' => 0,
        'user_id' => 1,
        'comment_approved' => 1
      );

      $comment_id = wp_new_comment( $commentdata );

      add_comment_meta( $comment_id, 'notification', current_time('mysql'), true );

      }else{
        $alerts_error .= $msg;
      }
    }
    if (esc_attr($_POST['updatesection']) == 'updatefee' ) {

      //update_post_meta($post_id, 'fee_date', esc_attr($_POST['fee_date']));
      //update_post_meta($post_id, 'fee_quantity', esc_attr($_POST['fee_quantity']));
      $post_id = get_the_ID();;
      $hasError = false;
      $msg = '';

      if ($post_id == ''){
        $hasError = true;
        $msg .= '<p>Error :/</p>';
      }

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

        $alerts_success .= '<p>Abonos actualizados</p>';
      }else{
        $alerts_error .= $msg;
      }
    }
  }
}
































/* CONFIGURACIÓN CONCURSOS
*
******************************************************/
 
if (esc_attr($_POST['action']) == 'configuration-concursos'  && (get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_concursos' || is_user_role('administrator'))) {


  if (esc_attr($_POST['updatesection']) == 'newconcurso') {
    $hasError = false;
    $publish_status = 'publish';
    $publish_type = 'concursos';
    $msg = '';

    if (trim($_POST['concurso_name']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el nombre del concurso!</p>';
    }
    if (trim($_POST['concurso_org']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el nombre del organismo convocante!</p>';
    }
    if (trim($_POST['concurso_bases']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el link a las bases del concurso!</p>';
    }
    if (trim($_POST['concurso_quantity']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el premio al que se puede aspirar!</p>';
    }
    if (trim($_POST['concurso_date']) === '') {
      $hasError = true;
      $msg .= '<p>Se te ha olvidado poner la fecha!</p>';
    }

    if(!$hasError){
      $post_information = array(
          'post_title' => wp_strip_all_tags( $_POST['concurso_name'] ),
          'post_content' => $_POST['description'],
          'post_type' => $publish_type,
          'post_status' => $publish_status,
      );
      $post_id = wp_insert_post( $post_information );

      update_post_meta($post_id, 'concurso_org', esc_attr($_POST['concurso_org']));
      update_post_meta($post_id, 'concurso_bases', esc_attr($_POST['concurso_bases']));
      update_post_meta($post_id, 'concurso_quantity', esc_attr($_POST['concurso_quantity']));
      update_post_meta($post_id, 'concurso_date', esc_attr($_POST['concurso_date']));
      
      $alerts_success .= '<p>Concurso '.$_POST['concurso_name'].' creado</p>';
      
    }else{
      $alerts_error .= $msg;
    }
  }
  if (esc_attr($_POST['updatesection']) == 'removeconcurso') {

    if(!empty($_POST['concursos_to_remove']) && is_array($_POST['concursos_to_remove'])){
      $cont = 0;
      foreach ($_POST['concursos_to_remove'] as $post_id) {
        if(!empty($post_id) && $post_id > 0){
          $cont++;
          wp_delete_post($post_id, true );
        }
      }
      if($cont > 0){
        $alerts_success .= '<p>'.$cont.' Concurso eliminados con éxito</p>';
      }
    }



  }
}

/* EDITAR CONCURSOS
*
******************************************************/
 
if (esc_attr($_POST['action']) == 'edit-concursos'  && (get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_concursos' || is_user_role('administrator'))) {


  if (esc_attr($_POST['updatesection']) == 'updateconcurso' ) {
    $hasError = false;
    $publish_status = 'publish';
    $publish_type = 'concursos';
    $msg = '';

    if (trim($_POST['concurso_name']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el nombre del concurso!</p>';
    }
    if (trim($_POST['concurso_org']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el nombre del organismo convocante!</p>';
    }
    if (trim($_POST['concurso_bases']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el link a las bases del concurso!</p>';
    }
    if (trim($_POST['concurso_quantity']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el premio al que se puede aspirar!</p>';
    }
    if (trim($_POST['concurso_date']) === '') {
      $hasError = true;
      $msg .= '<p>Se te ha olvidado poner la fecha!</p>';
    }
    if (!$_POST['id'] > 0) {
      $hasError = true;
      $msg .= '<p>Qué intentas?</p>';
    }
    if(get_post_type($_POST['id']) != $publish_type){
      $hasError = true;
      $msg .= '<p>Qué intentas???</p>';
    }
      
    if(!$hasError){

      $post_id = $_POST['id'];
      $my_post = array(
          'ID'           => $post_id,
          'post_title'   => esc_attr($_POST['concurso_name']),
          'post_content' => esc_attr($_POST['description']),
      );
      wp_update_post( $my_post );
      update_post_meta($post_id, 'concurso_org', esc_attr($_POST['concurso_org']));
      update_post_meta($post_id, 'concurso_bases', esc_attr($_POST['concurso_bases']));
      update_post_meta($post_id, 'concurso_quantity', esc_attr($_POST['concurso_quantity']));
      update_post_meta($post_id, 'concurso_date', esc_attr($_POST['concurso_date']));
      
      $alerts_success .= '<p>Concurso '.$_POST['concurso_name'].' actualizado</p>';
      
    }else{
      $alerts_error .= $msg;
    }
  }
}





























/* CONFIGURACIÓN OFERTAS
*
******************************************************/
 
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'configuration-jobs'  && (get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_jobs' || is_user_role('administrator'))) {


  if ( $_POST['updatesection'] == 'newjob' ) {
    $hasError = false;
    $publish_status = 'publish';
    $publish_type = 'jobs';
    $msg = '';

    if (trim($_POST['job_name']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el nombre del puesto!</p>';
    }
    if (trim($_POST['job_bussiness']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el nombre de la empresa/organismo!</p>';
    }
    if (trim($_POST['job_info']) === '') {
      $hasError = true;
      $msg .= '<p>Falta una web de referencia!</p>';
    }

    if(!$hasError){
      $post_information = array(
          'post_title' => wp_strip_all_tags( $_POST['job_name'] ),
          'post_content' => $_POST['description'],
          'post_type' => $publish_type,
          'post_status' => $publish_status,
      );
      $post_id = wp_insert_post( $post_information );

      update_post_meta($post_id, 'job_bussiness', esc_attr($_POST['job_bussiness']));
      update_post_meta($post_id, 'job_info', esc_attr($_POST['job_info']));
      
      $alerts_success .= '<p>Oferta '.$_POST['job_name'].' creada</p>';
      
    }else{
      $alerts_error .= $msg;
    }
  }
  

  if ( esc_attr($_POST['updatesection']) == 'removejob' ) {

    if(!empty($_POST['jobs_to_remove']) && is_array($_POST['jobs_to_remove'])){
      $cont = 0;
      foreach ($_POST['jobs_to_remove'] as $post_id) {
        if(!empty($post_id) && $post_id > 0){
          $cont++;
          wp_delete_post($post_id, true );
        }
      }
      if($cont > 0){
        $alerts_success .= '<p>'.$cont.' ofertas eliminadas con éxito</p>';
      }
    }
  }

}

/* EDITAR OFERTA
*
******************************************************/

if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'edit-jobs'  && (get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_concursos' || is_user_role('administrator'))) {


  if ( esc_attr($_POST['updatesection']) == 'updatejob' ) {
    $hasError = false;
    $publish_status = 'publish';
    $publish_type = 'jobs';
    $msg = '';

    if (trim($_POST['job_name']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el nombre de la oferta!</p>';
    }
    if (trim($_POST['job_bussiness']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el nombre de de la empresa!</p>';
    }
    if (trim($_POST['job_info']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el link de más información!</p>';
    }
    if (!$_POST['id'] > 0) {
      $hasError = true;
      $msg .= '<p>Qué intentas?</p>';
    }
    if(get_post_type($_POST['id']) != $publish_type){
      $hasError = true;
      $msg .= '<p>Qué intentas???</p>';
    }
      
    if(!$hasError){

      $post_id = $_POST['id'];
      $my_post = array(
          'ID'           => $post_id,
          'post_title'   => esc_attr($_POST['job_name']),
          'post_content' => esc_attr($_POST['description']),
      );
      wp_update_post( $my_post );
      update_post_meta($post_id, 'job_bussiness', esc_attr($_POST['job_bussiness']));
      update_post_meta($post_id, 'job_info', esc_attr($_POST['job_info']));
      
      $alerts_success .= '<p>Oferta '.$_POST['job_name'].' actualizada</p>';
      
    }else{
      $alerts_error .= $msg;
    }
  }
}

















/* CONFIGURACIÓN POSTS
*
******************************************************/
 
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'configuration-posts'  && (get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_posts' || is_user_role('administrator'))) {


  if ( $_POST['updatesection'] == 'newposts' ) {
    $hasError = false;
    $publish_status = 'publish';
    $publish_type = 'post';
    $msg = '';

    if (trim($_POST['post_name']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el nombre del puesto!</p>';
    }
    if(!$hasError){
      $post_information = array(
          'post_title' => wp_strip_all_tags( $_POST['post_name'] ),
          'post_content' => $_POST['description'],
          'post_type' => $publish_type,
          'post_status' => $publish_status,
      );
      $post_id = wp_insert_post( $post_information );
      
      $alerts_success .= '<p>Artículo '.$_POST['post_name'].' publicado</p>';
    }else{
      $alerts_error .= $msg;
    }
  }
  if ( esc_attr($_POST['updatesection']) == 'removeposts' ) {

    if(!empty($_POST['posts_to_remove']) && is_array($_POST['posts_to_remove'])){
      $cont = 0;
      foreach ($_POST['posts_to_remove'] as $post_id) {
        if(!empty($post_id) && $post_id > 0){
          $cont++;
          wp_delete_post($post_id, true );
        }
      }
      if($cont > 0){
        $alerts_success .= '<p>'.$cont.' artículos eliminados con éxito</p>';
      }
    }
  }

}

/* EDITAR POST
*
******************************************************/

if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'edit-posts'  && (get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_posts' || is_user_role('administrator'))) {


  if ( esc_attr($_POST['updatesection']) == 'updateposts' ) {
    $hasError = false;
    $publish_status = 'publish';
    $publish_type = 'post';
    $msg = '';

    if (trim($_POST['post_name']) === '') {
      $hasError = true;
      $msg .= '<p>Falta el nombre del artículo!</p>';
    }
    if (!$_POST['id'] > 0) {
      $hasError = true;
      $msg .= '<p>Qué intentas?</p>';
    }
    if(get_post_type($_POST['id']) != $publish_type){
      $hasError = true;
      $msg .= '<p>Qué intentas???</p>';
    }
      
    if(!$hasError){

      $post_id = $_POST['id'];
      $my_post = array(
          'ID'           => $post_id,
          'post_title'   => esc_attr($_POST['post_name']),
          'post_content' => esc_attr($_POST['description']),
      );
      wp_update_post( $my_post );
      
      $alerts_success .= '<p>Artículo '.$_POST['post_name'].' actualizado</p>';
      
    }else{
      $alerts_error .= $msg;
    }
  }
}

if($alerts_success != '') new Frontend_box( $alerts_success, array('type'=>'success','where'=>'meeseeks','auto_close'=> true,'delay'=>'7'));
if($alerts_error != '') new Frontend_box( $alerts_error, array('type'=>'error','where'=>'meeseeks','auto_close'=> true,'delay'=>'7'));
if($alerts_warning != '') new Frontend_box( $alerts_warning, array('type'=>'warning','where'=>'meeseeks','auto_close'=> true,'delay'=>'7'));
if($alerts_info != '') new Frontend_box( $alerts_info, array('type'=>'info','where'=>'meeseeks','auto_close'=> true,'delay'=>'7'));


} ?>