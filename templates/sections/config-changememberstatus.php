<section id="changememberstatus" class="wrap wrap--content wrap--shadow wrap--hidden js-section">
    <h3 class="title title--section">Gestionar socios</h3>

    <h3 class="sep">Gestionar altas y bajas</h3>

    <!-- make associate -->
    <?php wpdc_the_input_select_user('asociate', 'Hacer socio', $subscribers, '_to_define', true);?>

    <!-- undo associate -->
    <?php wpdc_the_input_select_user('desasociate', 'Dar de baja como socio', $socios, '_to_define', true);?>

    <h3 class="sep">Cambiar estatus</h4>

    <!-- valide asociate -->
    <?php wpdc_the_input_select_user('members_tovalide', 'Validar usuarios', $subscribers, 'asociation_status', true);?>
    <?php /*
    <div class="wrap wrap--frame wrap--flex">
        <div class="wrap wrap--frame wrap--frame__middle">
            <label for="members_tovalide">Validar usuarios</label>
        </div>
        <div class="wrap wrap--frame wrap--frame__middle">
            <select name="members_tovalide[]" id="members_tovalide" class="select select-user chosen tolisten" multiple="multiple" data-placeholder="Selecciona usuarios">
                <?php
                if(is_object($socios)){
                    foreach($socios->results as $user){
                        if(get_user_meta($user->ID, 'asociation_status', true) == 'validado') continue;
                        echo '<option value="'.esc_html($user->ID ).'" ';
                        echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div> */ ?>

    <!-- suspend asociate -->
    <?php wpdc_the_input_select_user('members_tovalide', 'Validar usuarios', $subscribers, 'asociation_status', true);?>
    <?php /*
    <div class="wrap wrap--frame wrap--flex">
        <div class="wrap wrap--frame wrap--frame__middle">
            <label for="members_tosuspend[]">Suspender usuarios</label>
        </div>
        <div class="wrap wrap--frame wrap--frame__middle">
            <select name="members_tosuspend[]" id="" class="select select-user chosen tolisten" multiple="multiple" data-placeholder="Selecciona usuarios">
                <?php
                if(is_object($socios)){
                    foreach($socios->results as $user){
                        if(get_user_meta($user->ID, 'asociation_status', true) != 'validado') continue;
                        echo '<option value="'.esc_html($user->ID ).'" ';
                        echo ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div> */ ?>

    <!-- submit change status -->
    <?php wpdc_the_submit('updatesection', 'changestatus', 'update-secretary', 'Guardar cambios');?>

    <!-- close button -->
    <?php include(locate_template('templates/sections/section-close.php')); ?>

</section>