<?php

/*if (!empty($_GET["action"])) { 
	$msg = '<div class="wrap wrap--content alert alert--';
	switch ($_GET["action"]) {

  	case "nologged" :	 	$msg .= 'error'; 
  							$msg .= '"><p>';
  							$msg .= 'Es necesario que <a href="">inicies sesión</a> para acceder al contenido';
  							break;

    case "wronglogin" :   $msg .= 'error'; 
                $msg .= '"><p>';
                $msg .= 'Usuario o contraseña incorrectos';
                break;

  	case "nopermission":	$msg .= 'error'; 
  							$msg .= '"><p>';
  							$msg .= 'No tienes suficientes permisos para eso';
  							break;

  	default: $msg .= 'error"><p>Error'; break;
  	}
	$msg .= '</p>';

	echo $msg;

	echo '<div class="wrap wrap--icon wrap--icon__close">';
	the_svg_icon('close', 'js-close-alert');
	echo '</div></div>';
}*/



?>
<div class="flexboxer">
  <section id="alerts" class="wrap wrap--frame wrap--alerts">
    <?php if (!empty($_GET["action"])) { 
      if(esc_attr($_GET["action"]) == 'register'){
        if(esc_attr($_GET["failed"]) == 'username_exists') echo '<div class="alert alert--error">Usuario existente, por favor, escoge otro</div>';
        if(esc_attr($_GET["failed"]) == 'username_exists') echo '<div class="alert alert--error">Email ya existente. ¿Has olvidado la contraseña?</div>';
        if(esc_attr($_GET["failed"]) == 'username_exists') echo '<div class="alert alert--error">Algunos campos no son válidos</div>';
        if(esc_attr($_GET["failed"]) == 'username_exists') echo '<div class="alert alert--error">Error en el registro</div>';
      }elseif(esc_attr($_GET["action"]) == 'login'){
        if(esc_attr($_GET["success"])) echo '<div class="alert alert--success">Bienvenido</div>';
        else echo '<div class="alert alert--error">Algo raro sucedió :/</div>';
      }
     } ?>
  </section> 
</div>
