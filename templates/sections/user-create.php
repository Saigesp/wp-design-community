<section id="newuser" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section">
	<h3 class="title title--section">Nuevo usuario</h3>
	<form name="registerform" action="<?php echo add_query_arg('do', 'register', home_url('/configuration-secretary/')); ?>" method="post">
    	<?php wpdc_the_input_email('user_login', '', 'Email', 'user@example.com');?>
    	<?php wpdc_the_input_email('user_email', '', 'Repetir email', 'user@example.com');?>
      	<?php wpdc_the_submit('wp-submit', 'Crear usuario', 'a', 'a', 'Crear usuario');?>
	</form>

	<?php include(locate_template('templates/sections/section-close.php')); ?>
</section>