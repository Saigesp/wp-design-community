<?php get_header(); ?>
<?php
$op_user = get_the_author_meta('op_user',$current_user->ID, true);
$invitaciones = $op_user['invitaciones'];
$resta = 1;

if($_GET['text'] == 'enviado'){
 $op_user['invitaciones'] = $op_user['invitaciones']+$resta; 
 update_user_meta($current_user->ID, 'op_user', $op_user );		
}

$op_user = get_the_author_meta('op_user',$current_user->ID, true);
$invitaciones = $op_user['invitaciones'];
$invit_rest = get_option("invitation_count") - $invitaciones; 

?>

<script type="text/javascript">

  function validateForm(form){
    document.getElementById("avise").innerHTML = "";
    if(form.user_login.value != form.user_email.value) {
      var p = document.createElement("P");
      var t = document.createTextNode("Los emails no coinciden!");
    	p.appendChild(t);
      p.className = "error";
    	document.getElementById("avise").appendChild(p);
      document.getElementById("avise").className = "avise error";
      form.user_email.focus();
      return false;
    }
    if(!form.terms.checked) {
      var p = document.createElement("P");
      var t = document.createTextNode("Debes aceptar los términos y condiciones de uso");
    	p.appendChild(t);
      p.className = "error";
    	document.getElementById("avise").appendChild(p);
      document.getElementById("avise").className = "avise error";
      form.terms.focus();
      return false;
    }
    if(!form.bots.checked) {
      var p = document.createElement("P");
      var t = document.createTextNode("Debes marcar que invitas a un diseñador industrial");
    	p.appendChild(t);
      p.className = "error";
    	document.getElementById("avise").appendChild(p);
      document.getElementById("avise").className = "avise error";
      form.bots.focus();
      return false;
    }
    return true;
  }

</script>

<div id="page-<?php the_ID(); ?>" style="min-height: 60%;">
<div id="avise"></div>
<?php
if (is_user_role("author") || is_user_role("editor") || is_user_role("administrator")) {
  if (get_option("invitation_op") == true || is_user_role("administrator")){
    if ($invitaciones < get_option("invitation_count")){
    ?>
        <?php
        $email_exists = $_GET["email_exists"];
        $invalid_email = $_GET["invalid_email"];
        if ($email_exists == 1 || $invalid_email == 1){
          echo '<div class="avise error" id="avise">';
          if ($email_exists == 1) echo "<p class='bold red'>Email ya existente, por favor escoge otro</p>";
          if ($invalid_email == 1) echo "<p class='bold red'>Email incorrecto, por favor escoge uno válido</p>";
          echo '</div>';
        }elseif($_GET['text'] == 'enviado'){
          echo '<div class="avise success" id="avise">';
          echo '<p>Invitación enviada con éxito!</p>';
          echo '</div>';
        }
        ?>
        <div class="profilebox onecolumn">
          <h2><?php the_title();?></h2>
          <div class="avise notice" id="notice">
            <p class="notice">Invitaciones restantes: <?php echo $invit_rest;?></p>
          </div>
					<form name="registerform" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post" onsubmit="return validateForm(this);">
    				<p>
      				<input type="text" name="user_login" value="" required>
      				<label for="user_login">Email</label>
    					<?php the_svg_icon("email");?>
      				<span class="underinput">Recibirás la contraseña en este email</span>
    				</p>
    				<p>
      				<input type="text" name="user_email" id="user_email" value="" required>
      				<label for="user_email">Repetir email</label>
							<?php the_svg_icon("email");?>
      				<span class="underinput">Recibirás la contraseña en este email</span>
    				</p>
    				<p style="display:none">
        			<label for="confirm_email">;)</label>
        			<input type="text" name="confirm_email" id="confirm_email" value="">
    				</p>
  					<p>
              <input type="checkbox" name="terms" style="margin: 10px 0;"/> Acepto los <a href="http://xn--diseadoresindustriales-nec.es/terminos-y-condiciones/">términos y condiciones</a>
            </p>
            <p>
              <input type="checkbox" name="bots" style="margin: 10px 0 30px;"/> Invito a un diseñador industrial
            </p>
    				<p class="form-submit">
              <input type="hidden" name="redirect_to" value="/invitar/?text=enviado" />
              <input type="submit" name="wp-submit" id="wp-submit" class="submit button" value="Enviar invitación" />
            </p>
					</form>
          <?php 
					$email_address = $_POST['user_reg'];
					if ( null == username_exists( $email_address ) && $email_address!= '') {
    				$password = wp_generate_password( 12, false );
    				$user_id = wp_create_user( $email_address, $password, $email_address );
    				wp_update_user(array( 'ID' => $user_id, 'nickname' => $email_address));
  					$op_user = get_the_author_meta('op_user',$current_user->ID, true);
  					if (is_array($op_user['hainvitado'])){array_push($op_user['hainvitado'], $user_id); } 
  					update_user_meta($current_user->ID, 'op_user', $op_user );		
					}
					echo $email_adress;
					$user = new WP_User( $user_id ); 
					?>
        </div><!--profilebox -->
		<?php
    }else{
    	echo '<div class="avise error" id="avise">';
      echo '<p class="error">Has gastado todas tus invitaciones :(</p>';
      echo '</div>';
    }
  }else{
    echo '<div class="avise error" id="avise">';
    echo '<p class="error">Invitaciones desactivadas</p>';
    echo '</div>';
  }
}else{
  echo '<div class="avise error" id="avise">';
  echo '<p class="error">No tienes permiso para acceder a esta página</p>';
  echo '</div>';
}
?>
</div><!--page-->
<?php get_footer(); ?>
