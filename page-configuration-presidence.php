<?php get_header();

//$users = get_users( 'orderby=nicename&role=author' );
$users = get_users( 'orderby=nicename' );

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
		<h3>Equipo de gobierno</h3>
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
                <div class="wrap wrap--frame__middle">
                    <label for="">Vicepresidencia</label>
                </div>
                <div class="wrap wrap--frame__middle">
                    <select name="" id="" class="select select-user">
                        <?php foreach ( $users as $user ) {
                                echo '<option value="'.esc_html($user->ID ).'">'.esc_html($user->display_name).'</option>';
                            } ?>
                    </select>
                </div>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
                <div class="wrap wrap--frame__middle">
                    <label for="">Secretaría</label>
                </div>
                <div class="wrap wrap--frame__middle">
                    <select name="" id="" class="select select-user">
                        <?php foreach ( $users as $user ) {
                                echo '<option value="'.esc_html($user->ID ).'">'.esc_html($user->display_name).'</option>';
                            } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
                <div class="wrap wrap--frame__middle">
                    <label for="">Tesorería</label>
                </div>
                <div class="wrap wrap--frame__middle">
                    <select name="" id="" class="select select-user">
                        <?php foreach ( $users as $user ) {
                                echo '<option value="'.esc_html($user->ID ).'">'.esc_html($user->display_name).'</option>';
                            } ?>
                    </select>
                </div>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
                <div class="wrap wrap--frame__middle">
                    <label for="">Vocales</label>
                </div>
                <div class="wrap wrap--frame__middle">
                    <select name="" id="" class="select select-user" multiple="multiple">
                        <?php foreach ( $users as $user ) {
                                echo '<option value="'.esc_html($user->ID ).'">'.esc_html($user->display_name).'</option>';
                            } ?>
                    </select>
                </div>
            </div>
        </div>
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