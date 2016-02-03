<?php get_header(); ?>

<style>
  .ui-widget {background: transparent !important;}
  .ui-state-active, td .ui-state-hover { background: transparent !important;}
</style>

<?php
global $current_user, $wp_roles;
get_currentuserinfo();
require_once( ABSPATH . WPINC . '/registration.php' );
$error = array();    
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] ){
          wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
          $error[] = __('Contraseña cambiada!', 'profile');
        } else $error[] = __('Las contraseñas no coinciden!. por favor vuelve a intentarlo', 'profile');
    }
  	 if ($_POST['perfil_publico'] != '') update_user_meta( $current_user->ID, 'perfil_publico', $_POST['perfil_publico']);       
 }    




$invitaciones = get_the_author_meta('invitaciones',$current_user->ID);
$resta = 1;

if ($_GET["send"] == 'ok') update_user_meta( $current_user->ID, 'invitaciones', $invitaciones-1 );
$invitaciones = get_the_author_meta('invitaciones',$current_user->ID);
?>


<?php if ( !is_user_logged_in() ){ ?>




<div class="profilebox onecolumn">    

    <div class="profile-login">
      <p class="bold red"><?php _e('Por favor, inicia sesión para continuar', 'profile'); ?><br><br></p>
      <?php get_template_part( 'login' ); ?>
    </div>

</div>
<?php }else{ ?>



<div id="page-<?php the_ID(); ?>">
    <div class="profilebox onecolumn">

      <h2><?php the_title();?></h2>
<?php if ( count($error) > 0 ) echo '<p class="bold red">' . implode("<br />", $error) . '</p>'; ?>
      

      
      
      
      
      
<div class="accordion">    
	<h3 class="accordion-title" style="text-align: left;">Cambiar contraseña</h3>
	<div>  
		<form method="post" id="changepass" action="<?php the_permalink(); ?>">
			<p class="form-password">
				<input class="text-input" name="pass1" type="password" id="pass1" />
    		<label for="pass1"><?php _e('Nueva contraseña', 'profile'); ?> </label>
				<?php the_svg_icon("pass");?>
  			<span class="underinput">Introduce la nueva contraseña</span>
			</p><!-- .form-password -->
			<p class="form-password">
				<input class="text-input" name="pass2" type="password" id="pass2" />
    		<label for="pass2"><?php _e('Repetir contraseña *', 'profile'); ?></label>
				<?php the_svg_icon("pass");?>
  			<span class="underinput">Verifica la contraseña introducida</span>
			</p><!-- .form-password -->
			<p class="form-submit">
				<?php echo $referer; ?>
    		<input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Cambiar contraseña', 'profile'); ?>" />
    		<?php wp_nonce_field( 'update-user' ) ?>
    		<input name="action" type="hidden" id="action" value="update-user" />
			</p><!-- .form-submit -->
		</form>
	</div>
  <h3 class="accordion-title" style="text-align: left;">Dirección del perfil</h3>
  <div style="text-align: left;">
    <p>La url es la dirección web con la que aparecerá tu perfil dentro de la comunidad.</p>
  	<p><br>Tu url actual:
    <?php echo ' <span class="blue" style="font-size: 0.7rem;">www.diseñadoresindustriales.es/</span><span class="pink">'.substr(get_author_posts_url(get_current_user_id()),41,-1).'</span></p>';?>
    <p><br>Nueva url:</p>
    <?php echo do_shortcode('[contact-form-7 id="269" title="Cambio de URL"]'); ?>
  </div>
  	<h3 class="accordion-title" style="text-align: left;">Visibilidad del perfil</h3>
	
	<div>
    <?php if(get_the_author_meta( 'perfil_publico', $current_user->ID, false ) == 1) {?>
    <p style="margin: 30px 0 30px;">Tu perfil ahora mismo es visible para otros usuarios</p>
    		<form role="form" id="frmSignup8" method="post" action="<?php the_permalink(); ?>">
						<input name="perfil_publico" type="hidden" id="perfil_publico" value="0" />
						<input name="action" type="hidden" id="action" value="update-user" />
						<input type="submit" value="Despublicar" class="submit button" />
				</form> 
    <?php }else{ 
					if(!is_user_role('subscriber')) { ?>
    				<p style="margin: 30px 0 30px;">Tu perfil ahora miemo está oculto para otros usuarios</p>
            <form role="form" id="frmSignup8" method="post" action="<?php the_permalink(); ?>">
                <input name="perfil_publico" type="hidden" id="perfil_publico" value="1" />
                <input name="action" type="hidden" id="action" value="update-user" />
                <input type="submit" value="Publicar" class="submit button" />
            </form> 
    <?php }else{ ?>
          	<p style=" margin: 30px 0 30px;">Tu perfil está oculto en estos momentos. Debes completar tu perfil para poder iniciar el proceso de confirmación.</p>
		<?php	}
			} ?>
  </div>
	<h3 class="accordion-title" style="text-align: left;">Borrar perfil</h3>
	<div>
  </div>
</div>


      
		</div>
</div>
  
<?php } ?>

<?php get_footer(); ?>