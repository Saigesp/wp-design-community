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

    <!-- permisos -->
    <section id="capacities" class="wrap wrap--content wrap--form wrap--hidden active js-section">

        <!-- permisos generales -->
        <h3>Permisos</h3>
        <p>Estos permisos determinarán las capacidades de participación de los usuarios en la página.</p>
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle"><strong>Permisos generales de la página</strong></div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="capacity_mode" id="capacity_mode" placeholder="Selecciona una opción" onchange="ToggleSelect('capacity_mode')">
                    <option value="dictator" <?php if(get_option('capacity_mode') == 'dictator') echo 'selected ' ?>>Dictadura</option>
                    <option value="president" <?php if(get_option('capacity_mode') == 'president') echo 'selected ' ?>>Presidencia</option>
                    <option value="comrade" <?php if(get_option('capacity_mode') == 'comrade') echo 'selected ' ?>>Comuna</option>
                </select>
            </div>
        </div>
        <div id="js-select-dictator" class="wrap wrap--frame wrap--flex wrap--hidden wrap--hidden__flex js-select js-select-capacity_mode <?php if(get_option('capacity_mode') == 'dictator') echo 'active'?>">
            <div class="wrap wrap--frame wrap--frame__middle">
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <h4>Dictadura</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla quasi officia, tempora vitae non maxime impedit consequatur velit dolores quisquam error ut iste nisi reiciendis alias hic animi. Esse, accusantium.</p>
            </div>
        </div>
        <div id="js-select-president" class="wrap wrap--frame wrap--flex wrap--hidden wrap--hidden__flex js-select js-select-capacity_mode <?php if(get_option('capacity_mode') == 'president') echo 'active'?>">
            <div class="wrap wrap--frame wrap--frame__middle">
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <h4>Presidencia</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla quasi officia, tempora vitae non maxime impedit consequatur velit dolores quisquam error ut iste nisi reiciendis alias hic animi. Esse, accusantium.</p>
            </div>
        </div>
        <div id="js-select-comrade" class="wrap wrap--frame wrap--flex wrap--hidden wrap--hidden__flex js-select js-select-capacity_mode <?php if(get_option('capacity_mode') == 'comrade') echo 'active'?>">
            <div class="wrap wrap--frame wrap--frame__middle">
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <h4>Comuna</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla quasi officia, tempora vitae non maxime impedit consequatur velit dolores quisquam error ut iste nisi reiciendis alias hic animi. Esse, accusantium.</p>
            </div>
        </div><!-- end of permisos generales -->

        <!-- transparencia -->
        <h3>Transparencia</h3>
        <p>Esta opción determinará el nivel de transparencia en la gestión que se aplicará.</p>
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle"><strong>Transparencia</strong></div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="transparency_mode" id="transparency_mode" placeholder="Selecciona una opción" onchange="ToggleSelect('transparency_mode')">
                    <option value="dark">Opaco</option>
                    <option value="grey">Semitransparente</option>
                    <option value="white">Transparente</option>
                </select>
            </div>
        </div>
        <div id="js-select-dark" class="wrap wrap--frame wrap--flex wrap--hidden wrap--hidden__flex js-select js-select-transparency_mode <?php if(get_option('transparency_mode') == 'dark') echo 'active'?>">
            <div class="wrap wrap--frame wrap--frame__middle">
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <h4>Opacidad</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla quasi officia, tempora vitae non maxime impedit consequatur velit dolores quisquam error ut iste nisi reiciendis alias hic animi. Esse, accusantium.</p>
            </div>
        </div>
        <div id="js-select-grey" class="wrap wrap--frame wrap--flex wrap--hidden wrap--hidden__flex js-select js-select-transparency_mode <?php if(get_option('transparency_mode') == 'grey') echo 'active'?>">
            <div class="wrap wrap--frame wrap--frame__middle">
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <h4>Semitransparencia</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla quasi officia, tempora vitae non maxime impedit consequatur velit dolores quisquam error ut iste nisi reiciendis alias hic animi. Esse, accusantium.</p>
            </div>
        </div>
        <div id="js-select-white" class="wrap wrap--frame wrap--flex wrap--hidden wrap--hidden__flex js-select js-select-transparency_mode <?php if(get_option('transparency_mode') == 'white') echo 'active'?>">
            <div class="wrap wrap--frame wrap--frame__middle">
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <h4>Transparencia</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla quasi officia, tempora vitae non maxime impedit consequatur velit dolores quisquam error ut iste nisi reiciendis alias hic animi. Esse, accusantium.</p>
            </div>
        </div><!-- endo of transparencia -->


        <!-- habilitar secciones -->
        <h3>Habilitar secciones</h3>
        <p>Las secciones no incluídas no podrán consultarse ni gestionarse, pero su contenido permanecerá intacto.</p>
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle"><strong>Secciones activas</strong></div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="active_section[]" id="active_section" class="select chosen" multiple="multiple">
                    <option value="">Ninguno</option>
                    <option value="concursos" <?php if(in_array('concursos', get_option('active_section'))) echo 'selected ' ?>>Concursos</option>
                    <option value="events" <?php if(in_array('events', get_option('active_section'))) echo 'selected ' ?>>Eventos</option>
                    <option value="jobs" <?php if(in_array('jobs', get_option('active_section'))) echo 'selected ' ?>>Ofertas de trabajo</option>
                    <option value="posts" <?php if(in_array('posts', get_option('active_section'))) echo 'selected ' ?>>Artículos</option>
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
        <p>Los miembros de la Junta Directiva tienen capacidades de edición de todos los contenidos de la web, excepto la gestión de socios, exclusiva para el secretario, y la gestión de cuotas, exclusiva del tesorero. Para poder elegir a un usuario, éste antes ha de tener estatus de asociado.</p>

        <!-- vicepresidencia -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for=""><strong>Vicepresidencia</strong></label>
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
        </div>
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <p>La <strong>vicepresidencia</strong> no tiene ningún permiso especial asignado.</p><br>
            </div>
        </div><!-- end of vicepresidencia -->

        <!-- secretaría -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for=""><strong>Secretaría</strong></label>
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
        </div>
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <p>La <strong>secretaría</strong> gestiona las altas y bajas de socios, así como la publicación de documentos y convocatorias.</p><br>
            </div>
        </div><!-- end of secretaría -->

        <!-- tesorero -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for=""><strong>Tesorería</strong></label>
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
        </div>
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <p>La <strong>tesorería</strong> gestiona el sistema de cuotas de los socios.</p><br>
            </div>
        </div><!-- end of tesorero -->

        <!-- vocales -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for="vocales[]"><strong>Vocales</strong></label>
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
        </div>
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <p>Las <strong>vocalías</strong> no tienen ningún permiso especial asignado.</p><br>
            </div>
        </div><!-- end of vocales -->

        <h3>Responsables de contenido</h3>
        <p>Los responsables de contenido tienen permiso para publicar, supervisar y modificar el contenido de la sección que tienen asignada. Puede haber varios responsables por sección, y un mismo responsable puede llevar varias secciones. Los responsables deben tener al menos estatus de socio.</p>

        <!-- responsable de ofertas de trabajo -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for="rp_posts[]"><strong>Responsables de noticias</strong></label>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="rp_posts[]" id="rp_posts" class="select select-user chosen" multiple="multiple">
                    <option value="0">Ninguno</option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'" ';
                            if(get_the_author_meta('asociation_responsability', $user->ID) == 'rp_posts') echo 'selected';
                            echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div><!-- end of responsable de ofertas de trabajo -->
        
        <!-- responsable de eventos -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for="rp_events[]"><strong>Responsables de eventos</strong></label>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="rp_events[]" id="rp_events" class="select select-user chosen" multiple="multiple">
                    <option value="0">Ninguno</option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'" ';
                            if(get_the_author_meta('asociation_responsability', $user->ID) == 'rp_events') echo 'selected';
                            echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div><!-- end of responsable de eventos -->

        <!-- responsable de concursos -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for="rp_concursos[]"><strong>Responsables de concursos</strong></label>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="rp_concursos[]" id="rp_concursos" class="select select-user chosen" multiple="multiple">
                    <option value="0">Ninguno</option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'" ';
                            if(get_the_author_meta('asociation_responsability', $user->ID) == 'rp_concursos') echo 'selected';
                            echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                        } ?>
                </select>
            </div>
        </div><!-- end of responsable de consursos -->

        <!-- responsable de ofertas de trabajo -->
        <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
                <label for="rp_jobs[]"><strong>Responsables de ofertas de trabajo</strong></label>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <select name="rp_jobs[]" id="rp_concursos" class="select select-user chosen" multiple="multiple">
                    <option value="0">Ninguno</option>
                    <?php foreach ( $users->results as $user ) {
                            echo '<option value="'.esc_html($user->ID ).'" ';
                            if(get_the_author_meta('asociation_responsability', $user->ID) == 'rp_jobs') echo 'selected';
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
                <select name="presidente" id="" class="select select-user chosen">
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