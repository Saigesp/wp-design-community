<?php get_header(); ?>
<?php if(is_user_role('administrator') || is_user_role('editor')) { ?>

<?php if (isset($_POST["update_settings"])) {
		$automate_twitter = esc_attr($_POST["automate_twitter"]); update_option("automate_twitter", $automate_twitter);
      	$consumer_key = esc_attr($_POST["consumer_key"]);	update_option("consumer_key", $consumer_key);
    	$consumer_secret = esc_attr($_POST["consumer_secret"]);	update_option("consumer_secret", $consumer_secret);
    	$access_token = esc_attr($_POST["access_token"]);	update_option("access_token", $access_token);
    	$access_token_secret = esc_attr($_POST["access_token_secret"]);	update_option("access_token_secret", $access_token_secret);
    	$tweet_new_user = esc_attr($_POST["tweet_new_user"]);	update_option("tweet_new_user", $tweet_new_user);
    	$follow_new_user = esc_attr($_POST["follow_new_user"]);	update_option("follow_new_user", $follow_new_user);
    	$tweet_new_publication = esc_attr($_POST["tweet_new_publication"]);	update_option("tweet_new_publication", $tweet_new_publication);
    	//if (!isset($_POST["tweet_prueba"])) echo '<div id="message" class="updated">Configuración guardada</div>';
		} else {
		$automate_twitter = get_option("automate_twitter");
  		$consumer_key = get_option("consumer_key");
    	$consumer_secret = get_option("consumer_secret");
    	$access_token = get_option("access_token"); 
    	$access_token_secret = get_option("access_token_secret"); 
  		$tweet_new_user = get_option("tweet_new_user");
    	$follow_new_user = get_option("follow_new_user");
    	$tweet_new_publication = get_option("tweet_new_publication");
      }

      if (isset($_POST["tweet_prueba"])) {
        $respuesta = sendTweet("Tweet de prueba desde diseñadoresindustriales.es");
        echo '<div id="message" class="updated">Tweet enviado! Comprueba tu perfil de twitter.</div>';
      }
?>


<!-- flexboxer -->
<form method="POST" action="">
<div class="flexboxer flexboxer--event">
  
	<section id="generalconfiguration" class="wrap wrap--content wrap--shadow wrap--collapse js-section">
		<h3 onclick="ToggleSection(this)" data-section="generalconfiguration" class="js-section-launch">Configuración general</h3>
        <p>a</p>
	</section>

	<section id="twitterconfiguration" class="wrap wrap--content wrap--form wrap--shadow wrap--collapse js-section">
		<h3 onclick="ToggleSection(this)" data-section="twitterconfiguration" class="js-section-launch">Configuración de Twitter</h3>
		<div class="wrap wrap--frame">
			<input type="checkbox" name="automate_twitter" id="automatic-twitter" value="true" <?php if($automate_twitter == true) echo 'checked';?> / >
		  	<label for="automatic-twitter"><span>Habilitar configuración automática de twitter</span></label>
		</div>
		<div class="wrap wrap--frame wrap--twitteroptions <?php if(!$automate_twitter) echo 'hide';?>">
			<p>Para configurar automáticamente una cuenta de twitter para que responda a eventos de la web, como registro de usuarios o publicación de entradas, es necesario obtener unas claves en twitter que te habilitarán como desarrollador. Estas claves se asocian a la cuenta de twitter con la que habilites la opción de desarrollador.<br>Puedes obtener las credenciales de twitter aquí: <a href="http://apps.twitter.com">apps.twitter.com</a></p>
            <?php wpdc_the_input_text('consumer_key', $consumer_key, 'Consumer key', '');?>
            <?php wpdc_the_input_text('consumer_secret', $consumer_secret, 'Consumer secret', '');?>
            <?php wpdc_the_input_text('access_token_secret', $access_token_secret, 'Access token secret', '');?>
            <?php wpdc_the_input_text('access_token', $access_token, 'Access token', '');?>

            <?php if ($consumer_key != '' && $consumer_secret != '' && $access_token != '' && $access_token_secret != ''){ ?>
                <?php wpdc_the_submit('tweet_prueba', '', '', 'Enviar tweet de prueba');?>
			<?php }?>
		</div>
		<div class="wrap wrap--frame wrap--twitteroptions wrap--twitteroptions__actions <?php if(!$automate_twitter) echo 'hide';?>">
	        <h3 class="sep">Activación de servicios de twitter</h3>
			<?php if ($consumer_key != '' && $consumer_secret != '' && $access_token != '' && $access_token_secret != ''){ ?>
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
	                  <td><input type="checkbox" id="follow_new_user" name="follow_new_user" value="true" <?php if($follow_new_user == true) echo 'checked';?>/></td>
	              </tr>
	          </table>
			<?php }elseif($automate_twitter){ ?>
				<p>Es necesario que obtengas las claves arriba indicadas para poder activar los servicios</p>
			<?php }?>			
		</div>

        <?php wpdc_the_submit('update_settings_twitter', 'update_settings', 'update-config', 'Guardar cambios');?>

	</section>
  
</div><!-- end of flexboxer -->
</form>


<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>
<?php get_footer(); ?>