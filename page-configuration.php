<?php get_header(); ?>
<?php if(is_user_role('administrator') || is_user_role('editor')) {

	$automate_twitter = get_option("automate_twitter");
	$consumer_key = get_option("consumer_key");
	$consumer_secret = get_option("consumer_secret");
	$access_token = get_option("access_token"); 
	$access_token_secret = get_option("access_token_secret"); 
	$tweet_new_user = get_option("tweet_new_user");
	$follow_new_user = get_option("follow_new_user");
	$tweet_new_publication = get_option("tweet_new_publication");

	$empty_twitter_keys = true;
	if ($consumer_key != '' && $consumer_secret != '' && $access_token != '' && $access_token_secret != '') $empty_twitter_keys = false;

	?>


<!-- flexboxer -->

<div class="flexboxer flexboxer--configuration flexboxer--full">
  
	<section id="generalconfiguration" class="wrap wrap--content wrap--collapse js-section wrap--shadow wrap--form">
		<h3 onclick="ToggleSection(this)" data-section="generalconfiguration" class="js-section-launch">Configuración general</h3>
        <form method="POST" action="">
        	<?php wpdc_the_input_checkbox_simple('users_can_register', 1, 'Permitir registro de usuarios', '', false, get_option('users_can_register'));?>
        	<?php wpdc_the_input_checkbox_simple('users_can_asociate', 1, 'Permitir que usuarios se asocien', '', false, get_option('users_can_asociate'));?>
        	<h3 class="sep">Registro de asociados</h3>
	        <?php
	        $options = [
				"dbem_dnie" => change_field_name("dbem_dnie"),
				"bornday" => change_field_name("bornday"),
				"dbem_phone" => change_field_name("dbem_phone"),
				"dbem_address" => change_field_name("dbem_address"),
				"titulacion" => change_field_name("titulacion"),
				"centro_de_estudios" => change_field_name("centro_de_estudios"),
				"first_name" => change_field_name("first_name"),
				"last_name" => change_field_name("last_name"),
				"email" => change_field_name("email")
	        ];
	        wpdc_the_input_select_option('fields_asociate_min', get_option("fields_asociate_min"), 'Campos obligatorios', $options, true);
	        ?>
        	<?php wpdc_the_submit('updatesection', 'general-options', '', '', 'Guardar cambios');?>
        </form>
	</section>

	<section id="orgconfig" class="wrap wrap--content wrap--collapse js-section wrap--shadow wrap--form">
		<h3 onclick="ToggleSection(this)" data-section="orgconfig" class="js-section-launch">Datos de la organización</h3>
        <form method="POST" action="">
			<?php wpdc_the_input_text('asoc_name', get_option("asoc_name"), 'Nombre completo de la organización', 'Entidad para la ...');?>
			<?php wpdc_the_input_text('asoc_adress', get_option("asoc_adress"), 'Dirección', 'Calle, Ciudad, CP...');?>
			<?php wpdc_the_input_text('asoc_email', get_option("asoc_email"), 'Email de contacto', 'info@organización.com');?>
			<?php wpdc_the_input_text('asoc_tlf', get_option("asoc_tlf"), 'Teléfono de contacto', '+34 600 000 000');?>
        	<?php wpdc_the_submit('updatesection', 'org-options', '', '', 'Guardar cambios');?>
        </form>
	</section>

	<section id="homeconfig" class="wrap wrap--content wrap--collapse js-section wrap--shadow wrap--form">
		<h3 onclick="ToggleSection(this)" data-section="homeconfig" class="js-section-launch">Portada (Home)</h3>
        <form method="POST" action="">
        	<?php wpdc_the_input_checkbox_simple('show_slider', 1, 'Mostrar slider', 'Mostrar carrusel con últimas actividades', false, get_option('show_slider'));?>
        	<?php wpdc_the_input_checkbox_simple('show_text_about_us', 1, 'Mostrar "About us"', 'Mostrar texto explicativo en la portada', false, get_option('show_text_about_us'));?>
        	<?php wpdc_the_input_textarea('text_about_us', get_option("text_about_us"), 'Texto Sobre nosotros');?>
        	<?php wpdc_the_submit('updatesection', 'home-options', '', '', 'Guardar cambios');?>
        </form>
	</section>

	<?php if(get_option('users_can_register')){?>
		<section id="registryconfiguration" class="wrap wrap--content wrap--collapse js-section wrap--shadow wrap--form">
			<h3 onclick="ToggleSection(this)" data-section="registryconfiguration" class="js-section-launch">Textos de la página</h3>
	        <form method="POST" action="">
	        	<h3 class="sep">Registro de usuarios</h3>
		        <?php wpdc_the_input_text('tos_link', get_option("tos_link"), 'Link a términos y condiciones', 'http://');?>
		        <?php wpdc_the_input_textarea('text_register', get_option("text_register"), 'Texto para el registro');?>
		        <?php wpdc_the_input_textarea('text_subscriber_upgrade', get_option("text_subscriber_upgrade"), 'Texto para los suscriptores');?>
		        <?php wpdc_the_input_textarea('text_asociate_payfee', get_option("text_asociate_payfee"), 'Texto inserto en cada cuotas');?>
		        <?php wpdc_the_input_textarea('text_asociate_payfee_banks', get_option("text_asociate_payfee_banks"), 'Texto explicativo para el pago por transferencia bancaria');?>
		        <!-- submit change status -->
				<?php wpdc_the_submit('updatesection', 'texts-update', '', '', 'Guardar cambios');?>
			</form>
		</section>
	<?php } ?>

	<?php include(locate_template('templates/sections/config-twitter.php')); ?>

	<section id="bigbang" class="wrap wrap--content wrap--collapse js-section wrap--shadow wrap--form">
		<h3 onclick="ToggleSection(this)" data-section="bigbang" class="js-section-launch">Y dios creó el cielo y la tierra</h3>
        <form method="POST" action="">
        	<?php wpdc_the_submit('bigbang', 'user-roles', '', '', 'Resetear roles');?>
        	<input type="hidden" name="updatesection" value="big-bang"/>
        </form>
	</section>
  
</div><!-- end of flexboxer -->



<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>
<?php get_footer(); ?>