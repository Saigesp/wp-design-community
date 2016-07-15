<section class="wrap wrap--content wrap--shadow wrap--form wrap--box">
	<h3 class="title title--article__sub">Regístrate</h3>
	<div class="wrap wrap--frame">

		<?php echo html_entity_decode(get_option("text_register")); ?>

		<form name="registerform" action="<?php echo add_query_arg('do', 'register', home_url('/configuration-secretary/')); ?>" method="post">
			<?php wpdc_the_input_email('user_login', '', 'Email', 'user@example.com');?>
			<?php wpdc_the_input_email('user_email', '', 'Repetir email', 'user@example.com');?>
			<input type="email" name="confirm_email" id="2" class="hidden" value=""/>
			<div class="wrap wrap--frame wrap--checkbox">
				<input type="checkbox" name="tos" id="1"/>
				<label for="1"></label>
				<label for="1">Acepto los <a href="<?php echo get_option("tos_link");?>">términos y condiciones</a></label>
			</div>

		  	<?php wpdc_the_submit('wp-submit', 'Crear usuario', 'a', 'a', 'Registrarse');?>
		</form>

	</div>
</section>