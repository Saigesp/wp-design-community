  <section class="wrap wrap--content wrap--shadow wrap--form wrap--author">
		<?php the_profile_photo($user);?>

		<?php wpdc_the_input_text('login', get_user_meta($user->ID,'nickname', 1), 'Login (No se puede cambiar)', 'login', true);?>

		<?php wpdc_the_input_text('first_name', get_user_meta($user->ID,'first_name', 1), 'Nombre', 'Nombre');?>
		
		<?php wpdc_the_input_text('last_name', get_user_meta($user->ID,'last_name', 1), 'Apellidos', 'Apellidos');?>

		<?php wpdc_the_input_email('email', esc_attr(get_the_author_meta('email', $user->ID)), 'Email', 'user@example.com');?>
      
		<?php wpdc_the_input_text('position', get_user_meta($user->ID,'position',1), 'Perfil', 'Diseñador en LittlePep S.A.');?>      
	
    	<?php wpdc_the_input_textarea('description', $user->description, 'Descripción');?>
  </section><!-- end of author -->