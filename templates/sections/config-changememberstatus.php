<section id="changememberstatus" class="wrap wrap--content wrap--shadow wrap--form wrap--hidden js-section">
    <h3 class="title title--section">Gestionar socios</h3>
    <form method="POST" action="">

        <h3 class="sep">Gestionar altas y bajas</h3>

        <!-- make associate -->
        <?php wpdc_the_input_select_user('asociate', 'Hacer socio', $subscribers->results, '_to_define', true);?>

        <!-- undo associate -->
        <?php wpdc_the_input_select_user('desasociate', 'Dar de baja como socio', $socios->results, '_to_define', true);?>

        <?php wpdc_the_submit('updatesection', 'change_member_status', '', '', 'Actualizar asociados');?>

        <h3 class="sep">Usuarios pendientes de validación</h3>

        <!-- valide asociate -->
        <?php wpdc_the_input_select_user('members_tovalide', 'Validar usuarios', $subscribers_pending->results, 'asociation_status', true);?>

        <!-- suspend asociate -->
        <?php wpdc_the_input_select_user('members_tosuspend', 'Eliminar de pendientes', $subscribers_pending->results, 'asociation_status', true);?>

        <!-- submit change status -->
        <?php wpdc_the_submit('updatesection', 'validatemembers', '', '', 'Actualizar socios');?>

        <!-- close button -->
        <?php include(locate_template('templates/sections/section-close.php')); ?>
    </form>
</section>