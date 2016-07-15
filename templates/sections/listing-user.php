<section id="<?php echo $list_type;?>" class="wrap wrap--content wrap--shadow wrap--userlist wrap--userlist__<?php echo $list_type;?> js-section wrap--hidden <?php if($list_type == 'usuarios' ) echo ' active';?>">
    <h3 class="title title--section"><?php echo $list_type;?></h3>
    
    <?php if(is_object($users) && sizeof($users->results) > 0){ ?>
        <h3 class="sep">Listado de <?php echo $list_type;?></h3>
        <ul class="list">
            <?php foreach($users->results as $user){?>

                <li class="item wrap wrap--frame wrap--flex">
                    <div class="wrap wrap--frame wrap--frame__45">
                        <?php include(locate_template('templates/sections/profile-photo.php')); ?>
                    </div>
                    <div class="wrap wrap--frame wrap--frame__fourth">
                        <?php wpdc_the_user_name($user->ID);?>
                    </div>
                    <div class="wrap wrap--frame wrap--frame__fourth">
                        <?php wpdc_the_asociation_position($user->ID);?>
                    </div>
                    <div class="wrap wrap--frame wrap--frame__fourth">
                        <?php
                        echo '<span';
                        if(is_array(get_user_meta($user->ID, 'user_registry_track', true))){
                            $last_status = array_pop((array_slice(get_user_meta($user->ID, 'user_registry_track', true), -1)));
                            echo ' title="'.$last_status['status'].' desde '.$last_status['date'].'"';
                        }else{
                            echo ' title="..."';
                        }
                        echo '>';
                        echo get_user_meta($user->ID, 'asociation_status', true);
                        echo '</span>';
                        ?>
                    </div>
                    <div class="wrap wrap--frame wrap--frame__fifth">
                        <span class="help-info">
                            <?php /*
                            $missing_data = array();
                            if(get_the_author_meta('dbem_dnie', $user->ID) == '') array_push($missing_data,'DNI');
                            if(get_the_author_meta('dbem_phone', $user->ID) == '') array_push($missing_data,'Teléfono');
                            if(get_the_author_meta('dbem_address', $user->ID) == '') array_push($missing_data,'Dirección');
                            if(get_the_author_meta('bornday', $user->ID) == '') array_push($missing_data,'Fecha');

                            if(count($missing_data) > 0 ){
                                if(count($missing_data) == 1 ) echo 'Falta '.$missing_data[0];
                                else {
                                    echo 'Faltan ';
                                    foreach ($missing_data as $data) echo $data.', ';
                                }
                            } */
                            ?>
                        </span>
                    </div>

                </li>
            <?php } ?>
        </ul>
    <?php }else{
        echo '<p>Todavía no hay '.$list_type.' en la página.</p>';
    } ?>

    <!-- close -->
    <?php include(locate_template('templates/sections/section-close.php')); ?>

</section>