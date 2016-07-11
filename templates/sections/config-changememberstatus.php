<section id="changememberstatus" class="wrap wrap--content wrap--shadow wrap--form wrap--hidden js-section">
    <h3 class="title title--section">Gestionar socios</h3>

    <h3 class="sep">Gestionar altas y bajas</h3>

    <!-- make associate -->
    <?php wpdc_the_input_select_user('asociate', 'Hacer socio', $subscribers->results, '_to_define', true);?>

    <!-- undo associate -->
    <?php wpdc_the_input_select_user('desasociate', 'Dar de baja como socio', $socios->results, '_to_define', true);?>

    <?php wpdc_the_submit('updatesection', 'change_member_status', 'action', 'update-secretary', 'Actualizar asociados');?>

    <h3 class="sep">Cambiar estado de validación</h4>

    <!-- valide asociate -->
    <?php wpdc_the_input_select_user('members_tovalide', 'Validar usuarios', $subscribers, 'asociation_status', true);?>

    <!-- suspend asociate -->
    <?php wpdc_the_input_select_user('members_tosuspend', 'Validar usuarios', $subscribers, 'asociation_status', true);?>

    <!-- submit change status -->
    <?php wpdc_the_submit('updatesection', 'validatemembers', 'update-secretary', '', 'Actualizar pendientes');?>

    <!-- close button -->
    <?php include(locate_template('templates/sections/section-close.php')); ?>

</section>