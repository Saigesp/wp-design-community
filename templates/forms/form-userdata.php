  <section class="wrap wrap--content wrap--shadow wrap--form wrap--author">
		<?php the_profile_photo($user);?>

		<?php wpdc_the_input_text('login', $current_user->user_login, 'Login (No se puede cambiar)', 'login', true);?>

		<?php wpdc_the_input_text('first-name', get_user_meta($user->ID,'first_name', 1), 'Nombre', 'Nombre');?>
		
		<?php wpdc_the_input_text('last-name', get_user_meta($user->ID,'last_name', 1), 'Apellidos', 'Apellidos');?>

		<?php wpdc_the_input_email('email', esc_attr(get_the_author_meta('email', $user->ID)), 'Email', 'user@example.com');?>
      
		<?php wpdc_the_input_text('last-name', get_user_meta($user->ID,'position',1), 'Perfil', 'Diseñador en LittlePep S.A.');?>      
	
    	<textarea name="description" class="description js-medium-editor tolisten"><?php echo $user->description;?></textarea>
  </section><!-- end of author -->