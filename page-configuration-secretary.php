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
    		<h3>Cambiar estatus</h3>

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
            <?php 
            $users = $socios;
            include(locate_template('templates/loops/loop-userlist.php'));
            ?>
        </section><!-- end of userlist -->
      
    </div><!-- end of flexboxer -->
    </form>

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>