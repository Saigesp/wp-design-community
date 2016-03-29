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



<!-- flexboxer -->
<form method="POST" action="">
<div class="flexboxer flexboxer--event">

    <?php include(locate_template('templates/harry/harry.php')); ?>

        <!-- admin options -->
      <section class="wrap wrap--content wrap--content__toframe wrap--flex wrap--transparent wrap--menu">
          <div class="wrap wrap--frame wrap--frame__middle">
              <p class=""><a onclick="ToggleSection(this)" class="js-section-launch active" data-section="gobteam">Configurar gobierno</a></p>
          </div>
          <div class="wrap wrap--frame wrap--frame__middle">
              <p class="right"></p>
          </div>
      </section><!-- end of admin options -->
  
	<section id="gobteam" class="wrap wrap--content wrap--hidden active js-section">
		<h3>Equipo de gobierno</h3>
        <p>Los miembros de la Junta Directiva deben ser socios.</p>

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

        <h3>Responsables de área</h3>
        <p>Los responsables de área deben ser socios.</p>

        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame__middle">
                <label for="rp_events[]">Responsable de eventos</label>
            </div>
            <div class="wrap wrap--frame__middle">
                <select name="rp_events[]" id="rp_events" class="select select-user chosen" multiple="multiple">
                    <option value="0">Ninguno</option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'" ';
                            if(get_the_author_meta('asociation_position', $user->ID) == 'vocal') echo 'selected';
                            echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div>

        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame__middle">
                <label for="rp_concursos[]">Responsable de concursos</label>
            </div>
            <div class="wrap wrap--frame__middle">
                <select name="rp_concursos[]" id="rp_concursos" class="select select-user chosen" multiple="multiple">
                    <option value="0">Ninguno</option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'" ';
                            if(get_the_author_meta('asociation_position', $user->ID) == 'vocal') echo 'selected';
                            echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div>

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
        <div class="wrap wrap--flex wrap--submit">
          <div class="wrap wrap--frame__middle wrap--flex">
          </div>
          <div class="wrap wrap--frame__middle wrap--flex">
            <p class="submit">
              <input name="updatefee" type="submit" id="submit-all" class="button button-primary" value="Cambiar gobierno">
              <input name="action" type="hidden" id="action" value="new-fee" />
            </p>
          </div>
        </div>
        <div class="wrap wrap--icon wrap--icon__close js-section-launch" onclick="ToggleSection(this)" data-section="close">
            <?php the_svg_icon('close', 'icon--corner js-close-alert'); ?>
        </div>
	</section>
  
</div><!-- end of flexboxer -->
</form>



<?php get_footer(); ?>