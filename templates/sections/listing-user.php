<section id="" class="wrap wrap--content wrap--shadow wrap--userlist">
    <h2>Listado de socios</h2>
    <?php
    $users = $socios;
    if(is_object($users) && sizeof($users) > 1){
        foreach($users->results as $user){

            $user = get_userdata($user->ID);
            $usermeta = get_user_meta($user->ID);

            if(function_exists('get_wp_user_avatar_src') && get_wp_user_avatar_src($user->ID, 100, 'medium') != '')
                $user_photo = get_wp_user_avatar_src($user->ID, 100, 'medium');
            elseif ($user->userphoto_image_file != '')
                $user_photo = get_bloginfo('url').'/wp-content/uploads/userphoto/'.$user->userphoto_image_file;
            else
                $user_photo = get_stylesheet_directory_uri().'/img/default/nophoto.png';
            ?>
            <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
                    <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
                        <div class="wrap wrap--photo wrap--photo__mini" title="<?php echo get_the_author_meta('first_name',$user->ID).' '.get_the_author_meta('last_name',$user->ID);?>"><img src="<?php echo $user_photo;?>"></div>
                        <a href="<?php echo get_author_posts_url($user->ID);?>" class="username"><?php echo get_the_author_meta('first_name',$user->ID).' '.get_the_author_meta('last_name',$user->ID);?></a>
                    </div>
                    <div class="wrap wrap--frame wrap--frame__middle">
                        <?php
                        echo change_role_name(get_the_author_meta('asociation_position', $user->ID));
                        if(get_the_author_meta('asociation_position', $user->ID) != '' && get_the_author_meta('asociation_responsability', $user->ID) != '') echo ' / ';
                        echo change_role_name(get_the_author_meta('asociation_responsability', $user->ID));?>
                    </div>
                </div>
                <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
                    <div class="wrap wrap--frame wrap--frame__middle">
                        <?php echo get_user_meta($user->ID, 'asociation_status', true); ?>
                    </div>
                    <div class="wrap wrap--frame wrap--frame__middle">
                        <span class="help-info">
                            <?php
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
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php }

    }else{
        echo '<p>Todavía no hay usuarios en la página. <a href="">¿Quieres crear uno?</a></p>';
    } ?>
</section>