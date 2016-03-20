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

  // PERFIL PÚBLICO
  if (!empty($_POST['perfil_publico'])){
    update_user_meta( $user->ID, 'perfil_publico', $_POST['perfil_publico']);
    global $wp_rewrite;
    $wp_rewrite->flush_rules( false );
  }

  if ( count($error) == 0 ) {
        do_action('edit_user_profile_update', $user->ID);
        wp_redirect( get_permalink() );
        exit;
    }

  }



?>