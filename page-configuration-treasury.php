<?php get_header();
?>

<?php if (isset($_POST["update_settings"])) {

    	//if (!isset($_POST["tweet_prueba"])) echo '<div id="message" class="updated">Configuración guardada</div>';
		} else {

      }

?>


<!-- flexboxer -->
<form method="POST" action="">
<div class="flexboxer flexboxer--event">
  
	<section class="wrap wrap--content">
		<h3>Cuentas bancaria</h3>
        <p>Especifica la cuenta a la que realizar las transferencias para el pago de cuotas.</p>
	</section>

	
	<section class="wrap wrap--frame wrap--submit">
		<p class="submit">
			<input type="hidden" name="update_settings" value="Y" />
			<input type="submit" class="button button-primary" value="Guardar cambios">
		</p>
	</section>
  
</div><!-- end of flexboxer -->
</form>



<?php get_footer(); ?>