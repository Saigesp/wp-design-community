<?php get_header(); ?>

<?php var_dump($_POST);?>

<?php
$op_user = get_the_author_meta('op_user',$current_user->ID, true);
if($op_user != null && is_numeric($op_user['invitaciones'])){
  $invitaciones = $op_user['invitaciones'];
  $resta = 1;

  if($_GET['text'] == 'enviado'){
   $op_user['invitaciones'] = $op_user['invitaciones']+$resta; 
   update_user_meta($current_user->ID, 'op_user', $op_user );    
  }

  $op_user = get_the_author_meta('op_user',$current_user->ID, true);
  $invitaciones = $op_user['invitaciones'];
$invit_rest = get_option("invitation_count") - $invitaciones; 
}

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

<div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--page flexboxer--page__invitar">
  <?php
  if (is_user_role("author") || is_user_role("editor") || is_user_role("administrator")) {
    if (get_option("invitation_op") == true || is_user_role("editor") || is_user_role("administrator")){
      if ($invitaciones < get_option("invitation_count") || is_user_role("administrator")){
      ?>
          <?php /*
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
          */ ?>
          <section class="wrap wrap--content wrap--shadow wrap--form">
            <h3 class="title title--section"><?php the_title();?></h3>
            <?php if(!is_user_role("administrator")){ ?>
              <p class="help help--section">Invitaciones restantes: <?php echo $invit_rest;?></p>
            <?php } ?>

  					<form name="registerform" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post" onsubmit="return validateForm(this);">

              <?php wpdc_the_input_email('user_login', '', 'Email', 'user@example.com');?>

              <?php wpdc_the_input_email('user_email', '', 'Repetir email', 'user@example.com');?> 

      				<p style="display:none">
          			<label for="confirm_email">;)</label>
          			<input type="text" name="confirm_email" id="confirm_email" value="">
      				</p>

              <?php wpdc_the_input_checkbox_simple('terms', '', 'Acepto los términos y condiciones', 'Términos y condiciones');?>

              <?php wpdc_the_input_checkbox_simple('bots', '', 'Invito a un diseñador');?>

              <?php wpdc_the_submit('wp-submit', 'Enviar invitación', 'redirect_to', '/wordpress/invitar/?text=enviado', 'Enviar invitación');?>
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
          </section><!--profilebox -->
  		<?php
      }else{
      	echo '<section class="wrap wrap--content wrap--transparent">';
        echo '<h3>Has gastado todas tus invitaciones :(</h3>';
        echo '</section>';
      }
    }else{
      echo '<section class="wrap wrap--content wrap--transparent">';
      echo '<h3>Invitaciones desactivadas</h3>';
      echo '</section>';
    }
  }else{
    echo '<section class="wrap wrap--content wrap--transparent">';
    echo '<h3>No tienes permiso para acceder a esta página</h3>';
    echo '</section>';
  }
  ?>
</div><!-- end of flexboxer -->
<?php get_footer(); ?>
