<section id="gobteam" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section">
    <h3 class="title title--section">Configurar gobierno</h3>

	<h3 class="sep">Junta directiva</h3>
    <p class="help help--section">Los miembros de la Junta Directiva tienen capacidades de edición de todos los contenidos de la web, excepto la gestión de socios, exclusiva para el secretario, y la gestión de cuotas, exclusiva del tesorero. Para poder elegir a un usuario, éste antes ha de tener estatus de asociado.</p>

    <!-- vicepresidencia -->
    <?php wpdc_the_input_select_user('vicepresidente', 'Vicepresidencia', $users, 'asociation_position');?>

    <!-- secretaría -->
    <?php wpdc_the_input_select_user('secretario', 'Secretaría', $users, 'asociation_position');?>
    
    <!-- tesorero -->
    <?php wpdc_the_input_select_user('tesorero', 'Tesorería', $users, 'asociation_position');?>

    <!-- vocales -->
    <?php wpdc_the_input_select_user('vocal', 'Vocales', $users, 'asociation_position', true);?>

    <h3 class="sep">Responsables de contenido</h3>
    <p class="help help--section">Los responsables de contenido tienen permiso para publicar, supervisar y modificar el contenido de la sección que tienen asignada. Puede haber varios responsables por sección, y un mismo responsable puede llevar varias secciones. Los responsables deben tener al menos estatus de socio.</p>

    <!-- responsable de ofertas de trabajo -->
    <?php wpdc_the_input_select_user('rp_posts', 'Responsables de noticias', $users, 'asociation_responsability', true);?>
    
    <!-- responsable de eventos -->
    <?php wpdc_the_input_select_user('rp_events', 'Responsables de eventos', $users, 'asociation_responsability', true);?>

    <!-- responsable de concursos -->
    <?php wpdc_the_input_select_user('rp_concursos', 'Responsables de concursos', $users, 'asociation_responsability', true);?>
    
    <!-- responsable de ofertas de trabajo -->
    <?php wpdc_the_input_select_user('rp_jobs', 'Responsables de ofertas de trabajo', $users, 'asociation_responsability', true);?>

    <!-- submit -->
    <?php wpdc_the_submit('updatesection', 'changegovern', 'update-presidence', 'Cambiar gobierno');?>


</section>