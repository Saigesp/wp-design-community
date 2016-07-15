<section id="twitterconfiguration" class="wrap wrap--content wrap--collapse js-section wrap--shadow wrap--form">
	<h3 onclick="ToggleSection(this)" data-section="twitterconfiguration" class="js-section-launch">Configuración de Twitter</h3>
	<form method="POST" action="">
		<div class="wrap wrap--frame">
			<input type="checkbox" name="automate_twitter" id="automatic-twitter" value="true" <?php if($automate_twitter == true) echo 'checked';?> / >
		  	<label for="automatic-twitter"><span>Habilitar configuración automática de twitter</span></label>
		</div>
		<div class="wrap wrap--frame wrap--twitteroptions <?php if(!$automate_twitter) echo 'hide';?>">
			<h3 class="sep">Claves de desarrollador de twitter</h3>
			<p>Para configurar automáticamente una cuenta de twitter para que responda a eventos de la web, como registro de usuarios o publicación de entradas, es necesario obtener unas claves en twitter que te habilitarán como desarrollador. Estas claves se asocian a la cuenta de twitter con la que habilites la opción de desarrollador.<br>Puedes obtener las credenciales de twitter aquí: <a href="http://apps.twitter.com">apps.twitter.com</a></p>

			
			<?php wpdc_the_input_text('consumer_key', $consumer_key, 'Consumer key', 'Consumer key');?>
			
			<?php wpdc_the_input_text('consumer_secret', $consumer_secret, 'Consumer secret', 'Consumer secret');?>

			<?php wpdc_the_input_text('access_token', $access_token, 'Access token', 'Access token');?>

			<?php wpdc_the_input_text('access_token_secret', $access_token_secret, 'Access token secret', 'Access token secret');?>
	        
			<?php
			
			wpdc_the_submit('updatesection', 'tweet-test', '', '', 'Enviar tweet de prueba', $empty_twitter_keys);
			?>

		</div>
		<div class="wrap wrap--frame wrap--twitteroptions wrap--twitteroptions__actions">
	    	<h3 class="sep">Activación de servicios automáticos</h3>
	    	<?php
	    	$checked = false;
	    	if($tweet_new_user == true) $checked = true;
	    	wpdc_the_input_checkbox_simple('tweet_new_user', 'true', 'Activado', 'Anunciar confirmación de nuevos usuarios', $empty_twitter_keys, $checked);
	    	?>
	    	
	    	<?php
	    	$checked = false;
	    	if($tweet_new_publication == true) $checked = true;
	    	wpdc_the_input_checkbox_simple('tweet_new_publication', 'true', 'Activado', 'Anunciar publicación de contenido', $empty_twitter_keys, $checked);
	    	?>
	    	
	    	<?php
	    	$checked = false;
	    	if($tweet_new_publication == true) $checked = true;
	    	wpdc_the_input_checkbox_simple('follow_new_user', 'true', 'Activado', 'Seguir a nuevos socios', $empty_twitter_keys, $checked);
	    	?>
		</div>	
		
		<!-- submit change status -->
		<?php wpdc_the_submit('updatesection', 'twitteroptions', '', '', 'Guardar cambios');?>

	</form>
</section>