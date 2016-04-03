<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_position', true) == 'secretario' || is_user_role('administrator')) {

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
                array(
                    'key' => $wpdb->get_blog_prefix( $blog_id ) . 'capabilities',
                    'value' => 'subscriber',
                    'compare' => 'like'
                )
            )
        )
    );
    ?>

    <!-- flexboxer -->
    <form method="POST" action="">
    <div class="flexboxer flexboxer--event">

        <?php include(locate_template('templates/harry/harry.php')); ?>

        <!-- admin options -->
        <section class="wrap wrap--content wrap--content__toframe wrap--flex wrap--transparent">
            <div class="wrap wrap--frame wrap--frame__middle">
                <p><strong><?php echo count($all_users);?></strong> usuarios registrados</p>
                <p><strong><?php echo count($socios->results);?></strong> socios</p>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
                <p class="right"><a class="js-section-launch" onclick="ToggleSection(this)" data-section="changememberstatus">Gestionar socios</a></p>
            </div>
        </section><!-- end of admin options -->

        <!-- change status to members -->
    	<section id="changememberstatus" class="wrap wrap--content wrap--hidden js-section">
    		<h3>Gestionar socios</h3>

            <!-- make associate -->
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
            </div><!-- end of make associate -->

            <!-- undo associate -->
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
            </div><!-- end of undo associate -->

            <!-- submit -->
            <div class="wrap wrap--flex wrap--submit">
              <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
              </div>
              <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
                <p class="submit">
                  <button name="updatesection" value="changestatus" type="submit" class="button button-primary">Cambiar estatus</button>
                  <input name="action" type="hidden" id="action" value="update-secretary" />
                </p>
              </div>
            </div><!-- end of submit -->

            <!-- close button -->
            <div class="wrap wrap--icon wrap--icon__close js-section-launch" onclick="ToggleSection(this)" data-section="close">
                <?php the_svg_icon('close', 'icon--corner js-close-alert'); ?>
            </div><!-- end of close button -->

    	</section><!-- end of change status to members -->

        <!-- userlist -->
        <section id="" class="wrap wrap--content wrap--userlist">
            <h3>Lista de socios</h3>
            <h4>Socios</h4>
            <?php
            $users = $socios;
            if(is_object($users)){
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
                                <?php
                                if(get_the_author_meta('asociation_status') == '') echo 'Validado';
                                else echo get_the_author_meta('asociation_status');
                                ?>
                            </div>
                            <div class="wrap wrap--frame wrap--frame__middle">
                                <span class="help-info">
                                    <?php
                                    $missing_data = array();
                                    if(get_the_author_meta('dbem_dnie', $user->ID) == '') array_push($missing_data,'DNI');
                                    if(get_the_author_meta('dbem_phone', $user->ID) == '') array_push($missing_data,'Teléfono');
                                    if(get_the_author_meta('dbem_address', $user->ID) == '') array_push($missing_data,'Dirección');
                                    if(get_the_author_meta('bornday', $user->ID) == '') array_push($missing_data,'Fecha de nacimiento');

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
                // TODO No object
            } ?>
        </section><!-- end of userlist -->
      
    </div><!-- end of flexboxer -->
    </form>

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>