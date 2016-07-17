<section class="wrap wrap--content wrap--form wrap--shadow">
	<h3 class="title title--section">Datos del usuario</h3>

  <?php wpdc_the_input_date('registro', date('d M Y H:i', strtotime($user->user_registered)), 'Fecha de registro', true);?>

  <?php wpdc_the_input_date('last_login', date('d M Y H:i', strtotime(get_last_login($user->ID))), 'Último acceso', true);?>

  <?php if(is_object($op_user)) wpdc_the_input_number('karma', $op_user['karma'], 'Karma', 0, 999, true);?>

  <?php if(is_object($op_user)) wpdc_the_input_number('invitations', $op_user['invitations'], 'Invitaciones', 0, 999, true);?>

</section>