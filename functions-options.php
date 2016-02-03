<?php

function setup_theme_admin_menus() {
    add_menu_page('Disindu', 'Disindu', 'manage_options', 
        'disindu_settings', 'theme_disindu_settings');
  
    add_submenu_page('disindu_settings', 
        'Usuarios', 'Usuarios', 'manage_options', 
        'users', 'theme_disindu_settings_users'); 

    add_submenu_page('disindu_settings', 
        'Publicaciones', 'Publicaciones', 'manage_options', 
        'publicaciones', 'theme_disindu_settings_publicaciones'); 
         
    add_submenu_page('disindu_settings', 
        'Twitter', 'Twitter', 'manage_options', 
        'twitter', 'theme_disindu_settings_twitter'); 
}




/* OPCIONES GENERALES
*
*****************************************************
*/
function theme_disindu_settings() {
    if (!current_user_can('manage_options')) {
    		wp_die('You do not have sufficient permissions to access this page.');
		}else{

      if (isset($_POST["update_settings"])) {
        $users_per_page = esc_attr($_POST["users_per_page"]);	update_option("users_per_page", $users_per_page);
        $users_per_page_noloop = esc_attr($_POST["users_per_page_noloop"]);	update_option("users_per_page_noloop", $users_per_page_noloop);
        $users_auto_loop = esc_attr($_POST["users_auto_loop"]);	update_option("users_auto_loop", $users_auto_loop);
        $pubs_per_page = esc_attr($_POST["pubs_per_page"]);	update_option("pubs_per_page", $pubs_per_page);
        $pubs_auto_loop = esc_attr($_POST["pubs_auto_loop"]);	update_option("pubs_auto_loop", $pubs_auto_loop);
      } else {
        $users_per_page = get_option("users_per_page");
        $users_per_page_noloop = get_option("users_per_page_noloop");
        $users_auto_loop = get_option("users_auto_loop");
        $pubs_per_page = get_option("pubs_per_page");
        $pubs_auto_loop = get_option("pubs_auto_loop");
      }
      
    ?>  
		<h2>Opciones del loop de usuarios</h2>
		<form method="POST" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="users_per_page">Usuarios por página:</label></th>
                    <td><input type="text" name="users_per_page" value="<?php echo $users_per_page;?>"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="users_per_page_noloop">Usuarios por página sin infinite scroll:</label></th>
                    <td><input type="text" name="users_per_page_noloop" value="<?php echo $users_per_page_noloop;?>"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="users_auto_loop">Carga automática del loop (veces):</label></th>
                    <td><input type="text" name="users_auto_loop" value="<?php echo $users_auto_loop;?>"/></td>
                </tr>
            </table>
		<h2>Opciones del loop de publicaciones</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="pubs_per_page">Publicaciones por página:</label></th>
                    <td><input type="text" name="pubs_per_page" value="<?php echo $pubs_per_page;?>"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="pubs_auto_loop">Carga automática del loop (veces):</label></th>
                    <td><input type="text" name="pubs_auto_loop" value="<?php echo $pubs_auto_loop;?>"/></td>
                </tr>
            </table>
       <p class="submit">
            <input type="hidden" name="update_settings" value="Y" />
            <input type="submit" class="button button-primary" value="Guardar cambios">
       </p>
     </form>
		<?php }}




/* OPCIONES DE USUARIOS
*
*****************************************************
*/
function theme_disindu_settings_users() {
    if (!current_user_can('manage_options')) {
    		wp_die('You do not have sufficient permissions to access this page.');
		}else{
    
      if (isset($_POST["update_settings_users"])) {
        $validation_op = esc_attr($_POST["validation_op"]);	update_option("validation_op", $validation_op);
        $validation_count = esc_attr($_POST["validation_count"]);	update_option("validation_count", $validation_count);
        $invitation_op = esc_attr($_POST["invitation_op"]);	update_option("invitation_op", $invitation_op);
        $invitation_count = esc_attr($_POST["invitation_count"]);	update_option("invitation_count", $invitation_count);
      } else {
        $validation_op = get_option("validation_op");
        $validation_count = get_option("validation_count");
        $invitation_op = get_option("invitation_op");
        $invitation_count = get_option("invitation_count");
      }
?>
			<div class="wrap">
        <div class="notice" id="notice">
          <?php
							if ($email_exists == 1) echo "<p class='bold red'>Email ya existente, por favor escoge otro</p>";
							if ($invalid_email == 1) echo "<p class='bold red'>Email incorrecto, por favor escoge uno válido</p>";
					?>
        </div>
        <h2>Activación de usuarios</h2>
        <p>A la cuenta de validaciones hay que sumarle 1 (Si se quieren 5 validanciones, poner 6)</p>
        <form method="POST" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="validation_op">Permitir validación por comunidad:</label></th>
                    <td><input type="checkbox" name="validation_op" value="true" <?php if($validation_op == true) echo 'checked';?>/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="validation_count">Número de validaciones necesarias:</label></th>
                    <td><input type="text" name="validation_count" value="<?php echo $validation_count;?>"/></td>
                </tr>
            </table>
          <p></p>
        <h2>Invitaciones</h2>
          <p>El cambio en el número de invitaciones sumará o restará las invitaciones disponibles de todos los usuarios, tanto nuevos como antíguos</p>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="invitation_op">Permitir invitaciones:</label></th>
                    <td><input type="checkbox" name="invitation_op" value="true" <?php if($invitation_op == true) echo 'checked';?>/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="invitation_count">Número de invitaciones por usuario:</label></th>
                    <td><input type="text" name="invitation_count" value="<?php echo $invitation_count;?>"/></td>
                </tr>
            </table>
          <p></p>
          <p class="submit">
            <input type="hidden" name="update_settings_users" value="Y" />
          	<input type="submit" class="button button-primary" value="Guardar cambios">
          </p>
        </form>
      </div>
   <?php }}




/* OPCIONES DE PUBLICACIÓN
*
*****************************************************
*/
function theme_disindu_settings_publicaciones() {
    if (!current_user_can('manage_options')) {
    		wp_die('You do not have sufficient permissions to access this page.');
		}else{
    
      if (isset($_POST["update_settings_users"])) {
        $publication_act = esc_attr($_POST["publication_act"]);	update_option("publication_act", $publication_act);
        $publication_sup = esc_attr($_POST["publication_sup"]);	update_option("publication_sup", $publication_sup);
        $publication_sup_a = esc_attr($_POST["publication_sup_a"]);	update_option("publication_sup_a", $publication_sup_a);
        $publication_sup_p = esc_attr($_POST["publication_sup_p"]);	update_option("publication_sup_p", $publication_sup_p);
        $publication_sup_e = esc_attr($_POST["publication_sup_e"]);	update_option("publication_sup_e", $publication_sup_e);
        $publication_sup_c = esc_attr($_POST["publication_sup_c"]);	update_option("publication_sup_c", $publication_sup_c);
        $publication_sup_l = esc_attr($_POST["publication_sup_l"]);	update_option("publication_sup_l", $publication_sup_l);
        $publication_sup_t = esc_attr($_POST["publication_sup_t"]);	update_option("publication_sup_t", $publication_sup_t);
        
        $denunce_a_count = esc_attr($_POST["denunce_a_count"]);	update_option("denunce_a_count", $denunce_a_count);
        $denunce_v_count = esc_attr($_POST["denunce_v_count"]);	update_option("denunce_v_count", $denunce_v_count);
      } else {
        $publication_act = get_option("publication_act");
        $publication_sup = get_option("publication_sup");
        $publication_sup_a = get_option("publication_sup_a");
        $publication_sup_p = get_option("publication_sup_p");
        $publication_sup_e = get_option("publication_sup_e");
        $publication_sup_c = get_option("publication_sup_c");
        $publication_sup_l = get_option("publication_sup_l");
        $publication_sup_t = get_option("publication_sup_t");
        
        $denunce_a_count = get_option("denunce_a_count");
        $pdenunce_v_count = get_option("denunce_v_count");
      }
?>
			<div class="wrap">
        <div class="notice" id="notice">
        </div>
        <form method="POST" action="">
        <h2>Permisos de publicación</h2>
        <p>Opciones para los usuarios confirmados (author).</p>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="publication_act">Permisos generales:</label></th>
                    <td><input type="checkbox" name="publication_act" value="true" <?php if($publication_act == true) echo 'checked';?>/>Publicar</td>
                  	<td><input type="checkbox" name="publication_sup" value="true" <?php if($publication_sup == true) echo 'checked';?>/>No supervisar</td>
                </tr>
              <?php if($publication_sup == true){?>
                <tr valign="top">
                    <th scope="row"><label for="publication_sup">No supervisar:</label></th>
                    <td><input type="checkbox" name="publication_sup_a" value="true" <?php if($publication_sup_a == true) echo 'checked';?>/> Artículos</td>
                  	<td><input type="checkbox" name="publication_sup_p" value="true" <?php if($publication_sup_p == true) echo 'checked';?>/> Preguntas</td>
                  	<td><input type="checkbox" name="publication_sup_e" value="true" <?php if($publication_sup_e == true) echo 'checked';?>/> Eventos</td>
                  	<td><input type="checkbox" name="publication_sup_c" value="true" <?php if($publication_sup_c == true) echo 'checked';?>/> Concursos</td>
                  	<td><input type="checkbox" name="publication_sup_l" value="true" <?php if($publication_sup_l == true) echo 'checked';?>/> Enlaces</td>
                  	<td><input type="checkbox" name="publication_sup_t" value="true" <?php if($publication_sup_t == true) echo 'checked';?>/> Trabajos</td>
                </tr>
              <?php }?>
            </table>
        <h2>Valores de publicación</h2>
        <p>Opciones para las publicaciones (preguntas, concursos).</p>
          <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="denunce_a_count">Denuncias para alerta:</label></th>
                    <td><input type="text" name="denunce_a_count" value="<?php echo $denunce_a_count;?>"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="denunce_v_count">Denuncias para ocultar:</label></th>
                    <td><input type="text" name="denunce_v_count" value="<?php echo $denunce_v_count;?>"/></td>
                </tr>
          </table>
          <p class="submit">
            <input type="hidden" name="update_settings_users" value="Y" />
          	<input type="submit" class="button button-primary" value="Guardar cambios">
          </p>
        </form>
      </div>
<?php }}



/* OPCIONES DE TWITTER
*
*****************************************************
*/
function theme_disindu_settings_twitter() {
    if (!current_user_can('manage_options')) {
    		wp_die('You do not have sufficient permissions to access this page.');
		}else{
      
    	if (isset($_POST["update_settings"])) {
          $consumer_key = esc_attr($_POST["consumer_key"]);	update_option("consumer_key", $consumer_key);
        	$consumer_secret = esc_attr($_POST["consumer_secret"]);	update_option("consumer_secret", $consumer_secret);
        	$access_token = esc_attr($_POST["access_token"]);	update_option("access_token", $access_token);
        	$access_token_secret = esc_attr($_POST["access_token_secret"]);	update_option("access_token_secret", $access_token_secret);
        	if (!isset($_POST["tweet_prueba"])) echo '<div id="message" class="updated">Configuración guardada</div>';
			} else {
      		$consumer_key = get_option("consumer_key");
        	$consumer_secret = get_option("consumer_secret");
        	$access_token = get_option("access_token"); 
        	$access_token_secret = get_option("access_token_secret"); 
      }
      if (isset($_POST["tweet_prueba"])) {
        	$respuesta = sendTweet("Tweet de prueba desde diseñadoresindustriales.es");
        echo '<div id="message" class="updated">Tweet enviado! Comprueba tu perfil de twitter.</div>';
      }
      if (isset($_POST["update_settings_twitter"])) {
        	$tweet_new_user = esc_attr($_POST["tweet_new_user"]);	update_option("tweet_new_user", $tweet_new_user);
        	$follow_new_user = esc_attr($_POST["follow_new_user"]);	update_option("follow_new_user", $follow_new_user);
        	$tweet_new_publication = esc_attr($_POST["tweet_new_publication"]);	update_option("tweet_new_publication", $tweet_new_publication);
        
      } else {
      		$tweet_new_user = get_option("tweet_new_user");
        	$follow_new_user = get_option("follow_new_user");
        	$tweet_new_publication = get_option("tweet_new_publication");
      }
       ?>

    <div class="wrap">
        <h2>Configuración general de twitter</h2>
      	<p>Puedes obtener las credenciales de twitter aquí: <a href="https://apps.twitter.com/">apps.twitter.com</a></p>
        <form method="POST" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="consumer_key">Consumer key:</label></th>
                    <td><input type="text" name="consumer_key" size="50" value="<?php echo $consumer_key;?>"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="consumer_secret">Consumer secret:</label></th>
                    <td><input type="text" name="consumer_secret" size="50" value="<?php echo $consumer_secret;?>"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="access_token">Access token:</label></th>
                    <td><input type="text" name="access_token" size="50" value="<?php echo $access_token;?>"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="access_token_secret">Access token secret:</label></th>
                    <td><input type="text" name="access_token_secret" size="50" value="<?php echo $access_token_secret;?>"/></td>
                </tr>
            </table>
          <p class="submit">
            <input type="hidden" name="update_settings" value="Y" />
          	<input type="submit" class="button button-primary" value="Guardar cambios">
            <?php if ($consumer_key != '' &&	$consumer_secret != '' && $access_token != '' && $access_token_secret != ''){ ?>
								<input type="submit" name="tweet_prueba" class="button button-primary" style="background: cadetblue;" value="Enviar tweet de prueba">
						<?php }?>
          </p>
        </form>
      <p></p>
        <h2>Activación de servicios de twitter</h2>
        <form method="POST" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="tweet_new_user">Twittear nuevos usuarios confirmados:</label></th>
                    <td><input type="checkbox" name="tweet_new_user" value="true" <?php if($tweet_new_user == true) echo 'checked';?>/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="follow_new_user">Seguir a nuevos usuarios confirmados:</label></th>
                    <td><input type="checkbox" name="follow_new_user" value="true" <?php if($follow_new_user == true) echo 'checked';?>/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="tweet_new_publication">Twittear nuevas publicaciones:</label></th>
                    <td><input type="checkbox" name="tweet_new_publication" value="true" <?php if($tweet_new_publication == true) echo 'checked';?>/></td>
                </tr>
            </table>
          <p class="submit">
            <input type="hidden" name="update_settings_twitter" value="Y" />
          	<input type="submit" class="button button-primary" value="Guardar cambios">
          </p>
        </form>
    </div>
<?php }}?>



<?php add_action("admin_menu", "setup_theme_admin_menus"); ?>