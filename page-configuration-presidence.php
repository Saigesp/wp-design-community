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
          <p class=""></p>
      </div>
      <div class="wrap wrap--frame wrap--frame__middle">
          <p class="right"><a onclick="ToggleSection(this)" class="js-section-launch active" data-section="capacities">Configurar permisos</a></p>
          <p class="right"><a onclick="ToggleSection(this)" class="js-section-launch" data-section="gobteam">Configurar gobierno</a></p>
          <p class="right"><a onclick="ToggleSection(this)" class="js-section-launch" data-section="byemrpresident">Ceder la presidencia</a></p>
      </div>
    </section><!-- end of admin options -->

    <section class="wrap wrap--frame">
        <?php var_dump($_POST);?>
    </section>

    <!-- permisos -->
    <section id="capacities" class="wrap wrap--content wrap--form wrap--hidden active js-section">
        <h3>Configurar permisos</h3>
        <p>Estos permisos determinarán las capacidades de gestión de los usuarios, así como la información hecha pública.</p>

        <!-- permisos generales -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">Permisos generales de la página</div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="capacity_mode" id="capacity_mode" placeholder="Selecciona una opción">
                    <option value="dictator">Dictadura</option>
                    <option value="president">Monarquía parlamentaria</option>
                    <option value="comrade">Comuna Hippie</option>
                </select>
            </div>
        </div><!-- end of permisos generales -->

        <!-- transparencia -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">Transparencia</div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="transparency_mode" id="capacity_mode" placeholder="Selecciona una opción">
                    <option value="dark">Opaco</option>
                    <option value="grey">Semitransparente</option>
                    <option value="white">Transparente</option>
                </select>
            </div>
        </div><!-- endo of transparencia -->

        <h3>Habilitar secciones</h3>
        <p>Las secciones no incluídas no podrán consultarse ni gestionarse, pero su contenido permanecerá intacto.</p>

        <!-- habilitar secciones -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">Secciones activas:</div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="page_sections[]" id="page_sections" class="select chosen" multiple="multiple">
                    <option value="concursos">Concursos</option>
                    <option value="events">Eventos</option>
                    <option value="jobs">Ofertas de trabajo</option>
                    <option value="post">Artículos</option>
                </select>
            </div>
        </div><!-- end of habilitar secciones -->

        <!-- submit -->
        <div class="wrap wrap--flex wrap--submit">
          <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
          </div>
          <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
            <p class="submit">
                <button name="updatesection" value="changecapacities" type="submit" class="button button-primary">Cambiar permisos</button>
              <input name="action" type="hidden" id="action" value="update-presidence" />
            </p>
          </div>
        </div><!-- end of submit -->

        <div class="wrap wrap--icon wrap--icon__close js-section-launch" onclick="ToggleSection(this)" data-section="close">
            <?php the_svg_icon('close', 'icon--corner js-close-alert'); ?>
        </div>
    </section><!-- end of permisos -->

    <!-- gobierno section -->
	<section id="gobteam" class="wrap wrap--content wrap--form wrap--hidden js-section">
		<h3>Configurar gobierno</h3>
        <p>Los miembros de la Junta Directiva deben ser socios.</p>

        <!-- vicepresidencia -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for="">Vicepresidencia</label>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="vicepresidente" id="" class="select select-user chosen">
                    <option value="0">Ninguno</option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'" ';
                            if(get_the_author_meta('asociation_position', $user->ID) == 'vicepresidente') echo 'selected';
                            echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div><!-- end of vicepresidencia -->

        <!-- secretaría -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for="">Secretaría</label>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="secretario" id="" class="select select-user chosen">
                    <option value="0">Ninguno</option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'" ';
                            if(get_the_author_meta('asociation_position', $user->ID) == 'secretario') echo 'selected';
                            echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div><!-- end of secretaría -->

        <!-- tesorero -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for="">Tesorería</label>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="tesorero" id="" class="select select-user chosen">
                    <option value="0">Ninguno</option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'" ';
                            if(get_the_author_meta('asociation_position', $user->ID) == 'tesorero') echo 'selected';
                            echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div><!-- end of tesorero -->

        <!-- vocales -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for="vocales[]">Vocales</label>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="vocales[]" id="" class="select select-user chosen" multiple="multiple">
                    <option value="0">Ninguno</option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'" ';
                            if(get_the_author_meta('asociation_position', $user->ID) == 'vocal') echo 'selected';
                            echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div><!-- end of vocales -->

        <h3>Responsables</h3>
        <p>Los responsables de área deben ser socios.</p>
        
        <!-- responsable de eventos -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for="rp_events[]">Responsables de eventos</label>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="rp_events[]" id="rp_events" class="select select-user chosen" multiple="multiple">
                    <option value="0">Ninguno</option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'" ';
                            if(get_the_author_meta('asociation_position', $user->ID) == 'vocal') echo 'selected';
                            echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div><!-- end of responsable de eventos -->

        <!-- responsable de concursos -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for="rp_concursos[]">Responsables de concursos</label>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="rp_concursos[]" id="rp_concursos" class="select select-user chosen" multiple="multiple">
                    <option value="0">Ninguno</option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'" ';
                            if(get_the_author_meta('asociation_position', $user->ID) == 'vocal') echo 'selected';
                            echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div><!-- end of responsable de consursos -->

        <!-- responsable de ofertas de trabajo -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for="rp_concursos[]">Responsables de ofertas de trabajo</label>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="rp_jobs[]" id="rp_concursos" class="select select-user chosen" multiple="multiple">
                    <option value="0">Ninguno</option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'" ';
                            if(get_the_author_meta('asociation_position', $user->ID) == 'vocal') echo 'selected';
                            echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div><!-- end of responsable de ofertas de trabajo -->

        <!-- submit -->
        <div class="wrap wrap--flex wrap--submit">
          <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
          </div>
          <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
            <p class="submit">
              <button name="updatesection" value="changegovern" type="submit" class="button button-primary">Cambiar gobierno</button>
              <input name="action" type="hidden" id="action" value="update-presidence" />
            </p>
          </div>
        </div><!-- end of submit -->

    </section><!-- end of gobierno section -->

    <!-- dimitir section -->
    <section id="byemrpresident" class="wrap wrap--content wrap--form wrap--hidden js-section">
        <h3>Ceder la presidencia</h3>
        <p>Oh! Siempre te recordaremos como el gran lider que fuiste!</p>

        <!-- nuevo lider -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for="">¿Quién será el nuevo lider?</label>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="" id="" class="select select-user chosen">
                    <option value="0"></option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'">'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div><!-- end of nuevo lider -->

        <!-- submit -->
        <div class="wrap wrap--flex wrap--submit">
          <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
          </div>
          <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
            <p class="submit">
              <button name="updatesection" value="changepresident" type="submit" class="button button-primary">Ceder presidencia</button>
              <input name="action" type="hidden" id="action" value="update-presidence" />
            </p>
          </div>
        </div><!-- end of submit -->

        <div class="wrap wrap--icon wrap--icon__close js-section-launch" onclick="ToggleSection(this)" data-section="close">
            <?php the_svg_icon('close', 'icon--corner js-close-alert'); ?>
        </div>
	</section><!-- end of dimitir section -->
  
</div><!-- end of flexboxer -->
</form>



<?php get_footer(); ?>