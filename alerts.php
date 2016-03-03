<?php

if (!empty($_GET["action"])) { 
	$msg = '<div class="wrap wrap--content alert alert--';
	switch ($_GET["action"]) {

  	case "nologged" :	 	$msg .= 'error'; 
  							$msg .= '"><p>';
  							$msg .= 'Es necesario que <a href="">inicies sesión</a> para acceder al contenido';
  							break;

  	case "nopermission":	$msg .= 'error'; 
  							$msg .= '"><p>';
  							$msg .= 'No tienes suficientes permisos para eso';
  							break;

  	default: $msg .= 'error"><p>Error'; break;
  	}
	$msg .= '</p>';

	echo $msg;


	/* Close button */
	echo '<div class="wrap wrap--icon wrap--icon__close">';
	the_svg_icon('close', 'js-close-alert');
	echo '</div></div>';
}

?>