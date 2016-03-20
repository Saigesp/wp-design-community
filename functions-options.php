<?php

function setup_theme_admin_menus() {
    add_menu_page('WP-DC Options', 'WP-DC Options', 'manage_options', 
        'wpdc_settings', 'theme_wpdc_settings');

    add_submenu_page('wpdc_settings', 
        'Users', 'Usuarios y roles', 'manage_options', 
        'roles', 'theme_wpdc_settings_roles'); 

    add_submenu_page('wpdc_settings', 
        'Twitter', 'Twitter', 'manage_options', 
        'twitter', 'theme_wpdc_settings_twitter');

    add_submenu_page('wpdc_settings', 
        'Importer', 'Importar datos', 'manage_options', 
        'importer', 'theme_wpdc_settings_importer'); 

}


/* OPCIONES GENERALES
*
*****************************************************
*/
function theme_wpdc_settings() {
    if (!current_user_can('manage_options')) {
    		wp_die('You do not have sufficient permissions to access this page.');
		}else{ ?>
      <div class="wrap">
          <h2>Configuración general</h2>
      </div>
    <?php }
}


/* OPCIONES DE ROLES
*
*****************************************************
*/
function theme_wpdc_settings_roles() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }else{ ?>

    <?php }
}





/* OPCIONES DE IMPORTADOR
*
*****************************************************
*/
function theme_wpdc_settings_importer() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }else{ ?>

      <style>
      .update-nag input {
          margin: 0;
          padding: 0;
          background: transparent;
          border: 0;
          font-size: inherit;
          color: #0073aa;
          text-decoration: underline;
          cursor: pointer;
      }
      </style>
      <div class="wrap" class="">

      <?php if (isset($_POST["update_settings_opuser"])) { ?>
        <div class="wrap updated">
          <?php $users = get_users();
            foreach ($users as $user){
              $user_meta = get_user_meta($user->ID);
              if(isset($user_meta['op_user'])) continue;
              add_op_user_meta( $user->ID );
              echo "<p>UsuarioID: ".$user->ID." usermeta updated.</p>";
            } ?>
        </div>
          <?php }else {
            $users = get_users();
            $cleared_users = 0;
            foreach ($users as $user){
              $user_meta = get_user_meta($user->ID);
              if(!isset($user_meta['op_user'])) $cleared_users++;
            }
          }
      ?>
     
        <h2>Configuración de usuarios y roles</h2>
        <form method="POST" action="">
          <?php if($cleared_users > 0) {?>
            <div class="wrap update-nag">
              <p><strong>Se ha observado <?php echo $cleared_users;?> usuarios sin datos meta necesarios para el correcto funcionamiento del sitio. ¿Desea actualizarlos? </strong><input type="submit" name="update_settings_opuser" value="Actualizar usuarios"/>
              <br>Message: Set $user_meta->op_user with default values in users with null op_user (news or imported users)</p>
            </div>
          <?php } ?>
        </form>

        <form method="POST" action="">
          <h2>Importar usuarios de AEDI</h2>
          <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="automate_twitter">Activar automatización</label></th>
                <td><input type="checkbox" name="automate_twitter" value="true" <?php if($automate_twitter == true) echo 'checked';?>/></td>
            </tr>
          </table>
          <p class="submit">
            <input type="hidden" name="update_settings_twitter" value="Y" />
            <input type="submit" class="button button-primary" value="Guardar cambios">
          </p>
        </form>

      </div>
    <?php }
}


/* OPCIONES DE TWITTER
*
*****************************************************
*/
function theme_wpdc_settings_twitter() {
    if (!current_user_can('manage_options')) {
    		wp_die('You do not have sufficient permissions to access this page.');
		}else{
      
    	if (isset($_POST["update_settings"])) {
          $automate_twitter = esc_attr($_POST["automate_twitter"]); update_option("automate_twitter", $automate_twitter);
          $consumer_key = esc_attr($_POST["consumer_key"]);	update_option("consumer_key", $consumer_key);
        	$consumer_secret = esc_attr($_POST["consumer_secret"]);	update_option("consumer_secret", $consumer_secret);
        	$access_token = esc_attr($_POST["access_token"]);	update_option("access_token", $access_token);
        	$access_token_secret = esc_attr($_POST["access_token_secret"]);	update_option("access_token_secret", $access_token_secret);
        	if (!isset($_POST["tweet_prueba"])) echo '<div id="message" class="updated">Configuración guardada</div>';
			} else {
          $automate_twitter = get_option("automate_twitter");
      		$consumer_key = get_option("consumer_key");
        	$consumer_secret = get_option("consumer_secret");
        	$access_token = get_option("access_token"); 
        	$access_token_secret = get_option("access_token_secret"); 
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
      if (isset($_POST["tweet_prueba"])) {
          $respuesta = sendTweet("Tweet de prueba desde diseñadoresindustriales.es");
        echo '<div id="message" class="updated">Tweet enviado! Comprueba tu perfil de twitter.</div>';
      }
      ?>

    <div class="wrap">
        <h2>Configuración general de twitter</h2>
        <p>Para configurar automáticamente una cuenta de twitter para que responda a eventos de la web, como registro de usuarios o publicación de entradas, es necesario obtener unas claves en twitter que te habilitarán como desarrollador. Estas claves se asocian a la cuenta de twitter con la que habilites la opción de desarrollador.</p>
      	<p>Puedes obtener las credenciales de twitter aquí: <a href="https://apps.twitter.com/">apps.twitter.com</a></p>
        <form method="POST" action="">
            <table class="form-table">
              <tr valign="top">
                  <th scope="row"><label for="automate_twitter">Activar automatización</label></th>
                  <td><input type="checkbox" name="automate_twitter" value="true" <?php if($automate_twitter == true) echo 'checked';?>/></td>
              </tr>
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
            <?php }else{ ?>
                <input type="submit" name="" class="button button-primary" style="background: grey;" value="Enviar tweet de prueba" disabled>
						<?php }?>
          </p>
        </form>
      <p></p>
        <h2>Activación de servicios de twitter</h2>
        <form method="POST" action="">
          <p>¿Cuando quieres lanzar los tweets?</p>
          <table class="form-table">
              <tr valign="top">
                  <th scope="row"><label for="tweet_new_user">Anunciar confirmación de nuevos usuarios:</label></th>
                  <td><input type="checkbox" name="tweet_new_user" value="true" <?php if($tweet_new_user == true) echo 'checked';?>/></td>
              </tr>
              <tr valign="top">
                  <th scope="row"><label for="tweet_new_publication">Anunciar aprobación de nuevos post:</label></th>
                  <td><input type="checkbox" name="tweet_new_publication" value="true" <?php if($tweet_new_publication == true) echo 'checked';?>/></td>
              </tr>
          </table>
          <p>¿A qué usuarios quieres seguir automáticamente?</p>
          <table class="form-table">
              <tr valign="top">
                  <th scope="row"><label for="follow_new_user">Nuevos usuarios confirmados:</label></th>
                  <td><input type="checkbox" name="follow_new_user" value="true" <?php if($follow_new_user == true) echo 'checked';?>/></td>
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