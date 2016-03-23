<?php get_header();

global $wpdb;
$blog_id = get_current_blog_id();

$users = new WP_User_Query(
    array(
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => $wpdb->get_blog_prefix( $blog_id ) . 'capabilities',
                'value' => 'author',
                'compare' => 'like'
            ),
            array(
                'key' => $wpdb->get_blog_prefix( $blog_id ) . 'capabilities',
                'value' => 'editor',
                'compare' => 'like'
            )
        )
    )
);

?>

<?php include(locate_template('functions-validation.php')); ?>

  <?php if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-govern' ) { ?>
    <section class="wrap wrap--frame wrap--author">
      <section class="wrapwrap--content alert alert--success">
          <p>Cambios guardados correctamente.</p>
      </section>
    </section>
  <?php } ?>


<!-- flexboxer -->
<form method="POST" action="">
<div class="flexboxer flexboxer--event">
  
	<section class="wrap wrap--content">
		<h3>Equipo de gobierno</h3>
        <p>Los miembros de la Junta Directiva deben ser socios.</p>
        <div class="wrap wrap--frame">
            <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame__middle">
                    <label for="">Vicepresidencia</label>
                </div>
                <div class="wrap wrap--frame__middle">
                    <select name="vicepresidente" id="" class="select select-user chosen">
                        <option value="0">Ninguno</option>
                        <?php foreach ( $users->results as $user ) {
                                echo '<option value="'.esc_html($user->ID ).'" ';
                                if(get_the_author_meta('asociation_position', $user->ID) == 'vicepresidente') echo 'selected';
                                echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                            } ?>
                    </select>
                </div>
            </div>
            <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame__middle">
                    <label for="">Secretaría</label>
                </div>
                <div class="wrap wrap--frame__middle">
                    <select name="secretario" id="" class="select select-user chosen">
                        <option value="0">Ninguno</option>
                        <?php foreach ( $users->results as $user ) {
                                echo '<option value="'.esc_html($user->ID ).'" ';
                                if(get_the_author_meta('asociation_position', $user->ID) == 'secretario') echo 'selected';
                                echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                            } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="wrap wrap--frame">
            <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame__middle">
                    <label for="">Tesorería</label>
                </div>
                <div class="wrap wrap--frame__middle">
                    <select name="tesorero" id="" class="select select-user chosen">
                        <option value="0">Ninguno</option>
                        <?php foreach ( $users->results as $user ) {
                                echo '<option value="'.esc_html($user->ID ).'" ';
                                if(get_the_author_meta('asociation_position', $user->ID) == 'tesorero') echo 'selected';
                                echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                            } ?>
                    </select>
                </div>
            </div>
            <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame__middle">
                    <label for="vocales[]">Vocales</label>
                </div>
                <div class="wrap wrap--frame__middle">
                    <select name="vocales[]" id="" class="select select-user chosen" multiple="multiple">
                        <option value="0">Ninguno</option>
                        <?php foreach ( $users->results as $user ) {
                                echo '<option value="'.esc_html($user->ID ).'" ';
                                if(get_the_author_meta('asociation_position', $user->ID) == 'vocal') echo 'selected';
                                echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                            } ?>
                    </select>
                </div>
            </div>
        </div>
	</section>

    <section class="wrap wrap--content">
        <h3>Ceder la presidencia</h3>
        <p>Oh! Siempre te recordaremos como el gran lider que fuiste!.</p>
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame__middle">
                <label for="">¿Quién será el nuevo lider?</label>
            </div>
            <div class="wrap wrap--frame__middle">
                <select name="" id="" class="select select-user chosen">
                    <option value="0"></option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'">'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div>
    </section>

	
  <section class="wrap wrap--frame wrap--empty wrap--submit">
    <p class="submit">
      <input name="updateuser" type="submit" id="submit-all" class="button button-primary" value="Guardar cambios">
      <input name="action" type="hidden" id="action" value="update-govern" />
    </p>
  </section>
  
</div><!-- end of flexboxer -->
</form>



<?php get_footer(); ?>