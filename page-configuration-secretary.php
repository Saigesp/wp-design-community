<?php get_header();

include(locate_template('functions-validation.php'));

global $wpdb;
$blog_id = get_current_blog_id();

$all_users = get_users();

$socios = new WP_User_Query(
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

$subscribers = new WP_User_Query(
    array(
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => $wpdb->get_blog_prefix( $blog_id ) . 'capabilities',
                'value' => 'subscriber',
                'compare' => 'like'
            ),
            array(
                'key' => $wpdb->get_blog_prefix( $blog_id ) . 'capabilities',
                'value' => '',
                'compare' => 'like'
            )
        )
    )
);
?>

  <?php if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-secretary' ) { ?>
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
		<h3>Usuarios</h3>
		<p>Existen <strong><?php echo count($all_users);?></strong> usuarios registrados y <strong><?php echo count($socios->results);?></strong> socios.</p>
	</section>

	<section class="wrap wrap--content">
		<h3>Cambiar estatus de socio</h3>
        <div class="wrap wrap--frame">
            <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame__middle">
                    <label for="">Hacer socio</label>
                </div>
                <div class="wrap wrap--frame__middle">
					<select name="asociate[]" id="" class="select select-user chosen" multiple="multiple">
						<option value="0">Ninguno</option>
				        <?php foreach ( $subscribers->results as $subscriber ) {
				                echo '<option value="'.esc_html($subscriber->ID ).'" ';
				                echo ' >'.esc_html($subscriber->first_name).' '.esc_html($subscriber->last_name).'</option>';
				            } ?>
				    </select>
                </div>
            </div>
            <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame__middle">
                    <label for="">Dar de baja como socio</label>
                </div>
                <div class="wrap wrap--frame__middle">
					<select name="desasociate[]" id="" class="select select-user chosen" multiple="multiple">
						<option value="0">Ninguno</option>
				        <?php foreach ( $socios->results as $socio ) {
				                echo '<option value="'.esc_html($socio->ID ).'" ';
				                echo ' >'.esc_html($socio->first_name).' '.esc_html($socio->last_name).'</option>';
				            } ?>
				    </select>
                </div>
            </div>
        </div>
	</section>

	
  <section class="wrap wrap--frame wrap--empty wrap--submit">
    <p class="submit">
      <input name="updateuser" type="submit" id="submit-all" class="button button-primary" value="Guardar cambios">
      <input name="action" type="hidden" id="action" value="update-secretary" />
    </p>
  </section>
  
</div><!-- end of flexboxer -->
</form>



<?php get_footer(); ?>