<?php get_header(); ?> 
<?php if(is_user_role('administrator') || is_user_role('editor') || is_user_role('author')) { 

include(locate_template('functions-validation.php'));

$subscribers = new WP_User_Query(
    array(
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => $wpdb->get_blog_prefix( $blog_id ) . 'capabilities',
                'value' => 'author',
                'compare' => 'like'
            )
        )
    )
);

$members_payed = is_array(get_post_meta(get_the_ID(), 'members_payed', true)) ? get_post_meta(get_the_ID(), 'members_payed', true) : array();
$members_pending = is_array(get_post_meta(get_the_ID(), 'members_pending', true)) ? get_post_meta(get_the_ID(), 'members_pending', true) : array();

?>

<form method="POST" action="">
  <!-- flexboxer -->
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--fee">

    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?> 


        <?php if(is_user_role('administrator') || is_user_role('editor')) { ?>
          <?php if($subscribers->total_users > 0){


            ?>

            <section class="wrap wrap--content">
              <h2><?php the_title();?></h2>
              <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame__middle">
                  <p>Fecha: <?php echo get_post_meta(get_the_ID(), 'fee_date', true); ?></p>
                </div>
                <div class="wrap wrap--frame__middle">
                  <p>Cantidad: <?php echo get_post_meta(get_the_ID(), 'fee_quantity', true); ?> €</p>
                </div>
              </div>
              <div class="wrap wrap--frame wrap--userlist ">
                <h4><?php if(get_post_meta(get_the_ID(), 'members_payed', true) != '') echo sizeof(get_post_meta(get_the_ID(), 'members_payed', true)); else echo '0';?> Socios con la cuota abonada</h4>
                <table>
                  <?php
                  foreach($members_payed as $user_id => $time){
                    $user = get_userdata($user_id);
                    $usermeta = get_user_meta($user_id);

                    if(function_exists('get_wp_user_avatar_src') && get_wp_user_avatar_src($user_id, 100, 'medium') != '')
                        $user_photo = get_wp_user_avatar_src($user_id, 100, 'medium');
                    elseif ($user->userphoto_image_file != '')
                        $user_photo = get_bloginfo('url').'/wp-content/uploads/userphoto/'.$user->userphoto_image_file;
                    else
                        $user_photo = get_stylesheet_directory_uri().'/img/default/nophoto.png';

                    echo '<tr>'; 
                    echo '<td class="hideonmobile"><div class="wrap wrap--photo wrap--photo__mini" title="'.get_the_author_meta('first_name',$user_id).' '.get_the_author_meta('last_name',$user_id).'"><img src="'.$user_photo.'"></div><td>';
                    echo '<td><a href="'.get_author_posts_url($user_id).'">'.get_the_author_meta('first_name',$user_id).' '.get_the_author_meta('last_name',$user_id).'</a></td>';
                    echo '<td>'.$time.'</td>';
                    echo '<td><input type="checkbox" class="hidden" id="checkbox-pay-'.$user_id.'" name="members_paydown[]" value="'.$user_id.'"><label for="checkbox-pay-'.$user_id.'">';
                    the_svg_icon('close', 'icon--corner');
                    echo '</label></td>';
                    echo '</tr>';
                  }
                  ?>
                </table>
              </div>
              <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame__middle wrap--flex">
                </div>
                <div class="wrap wrap--frame__middle wrap--flex">
                  <div class="wrap wrap--frame__middle">
                    <label for="members_payed[]">Añadir abonos:</label>
                  </div>
                  <div class="wrap wrap--frame__middle">
                    <select name="members_payed[]" id="" class="select select-user chosen" multiple="multiple" data-placeholder="Selecciona usuarios">
                      <option value="0">Ninguno</option>
                      <?php foreach ( $subscribers->results as $subscriber ) {
                              if($members_pending[$subscriber->ID] != '' || $members_payed[$subscriber->ID] != '') continue;
                              echo '<option value="'.esc_html($subscriber->ID ).'" ';
                              echo ' >'.esc_html($subscriber->first_name).' '.esc_html($subscriber->last_name).'</option>';
                          } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="wrap wrap--frame wrap--userlist">
                <h4><?php if(get_post_meta(get_the_ID(), 'members_pending', true) != '') echo sizeof(get_post_meta(get_the_ID(), 'members_pending', true)); else echo '0';?> Socios con la cuota pendiente de validar</h4>
                <table>
                  <?php
                  
                  foreach($members_pending as $user_id => $time){
                    $user = get_userdata($user_id);
                    $usermeta = get_user_meta($user_id);

                    if(function_exists('get_wp_user_avatar_src') && get_wp_user_avatar_src($user_id, 100, 'medium') != '')
                        $user_photo = get_wp_user_avatar_src($user_id, 100, 'medium');
                    elseif ($user->userphoto_image_file != '')
                        $user_photo = get_bloginfo('url').'/wp-content/uploads/userphoto/'.$user->userphoto_image_file;
                    else
                        $user_photo = get_stylesheet_directory_uri().'/img/default/nophoto.png';

                    echo '<tr>'; 
                    echo '<td class="hideonmobile"><div class="wrap wrap--photo wrap--photo__mini" title="'.get_the_author_meta('first_name',$user_id).' '.get_the_author_meta('last_name',$user_id).'"><img src="'.$user_photo.'"></div><td>';
                    echo '<td><a href="'.get_author_posts_url($user_id).'">'.get_the_author_meta('first_name',$user_id).' '.get_the_author_meta('last_name',$user_id).'</a></td>';
                    echo '<td>'.$time.'</td>';
                    echo '<td><input type="checkbox" class="hidden" id="checkbox-pen-'.$user_id.'" name="members_pendingdown[]" value="'.$user_id.'"><label for="checkbox-pen-'.$user_id.'">';
                    the_svg_icon('close', 'icon--corner');
                    echo '</label></td>';
                    echo '<td><input type="checkbox" class="hidden" id="checkbox-topay-'.$user_id.'" name="members_validate[]" value="'.$user_id.'"><label for="checkbox-topay-'.$user_id.'">';
                    the_svg_icon('check', 'icon--corner icon--corner__second');
                    echo '</label></td>';
                    echo '</tr>';
                  }
                  ?>
                </table>
              </div>
              <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame__middle wrap--flex">
                </div>
                <div class="wrap wrap--frame__middle wrap--flex">
                  <div class="wrap wrap--frame__middle">
                    <label for="members_pending[]">Añadir abono pendiente</label>
                  </div>
                  <div class="wrap wrap--frame__middle">
                    <select name="members_pending[]" id="" class="select select-user chosen" multiple="multiple" data-placeholder="Selecciona usuarios">
                      <option value="0">Ninguno</option>
                      <?php foreach ( $subscribers->results as $subscriber ) {
                              if($members_pending[$subscriber->ID] != '' || $members_payed[$subscriber->ID] != '') continue;
                              echo '<option value="'.esc_html($subscriber->ID ).'" ';
                              echo ' >'.esc_html($subscriber->first_name).' '.esc_html($subscriber->last_name).'</option>';
                          } ?>
                    </select>
                  </div>
                </div>
              </div>
            </section>

            <section class="wrap wrap--frame wrap--empty wrap--submit">
              <p class="submit">
                <input name="fee_id" type="hidden" id="fee_id" value="<?php the_ID();?>">
                <input name="updatefee" type="submit" id="submit-all" class="button button-primary" value="Actualizar cuota">
                <input name="action" type="hidden" id="action" value="update-fee" />
              </p>
            </section>        

          <?php }else{ // No authors in list ?>

            <!-- message no authors -->
            <section class="wrap wrap--content">
              <p>No hay usuarios</p>
            </section><!-- end of message no authors -->

          <?php } ?>
        <?php }else{ // If is author ?>

        <section class="wrap wrap--content">
          <h2><?php the_title(); ?></h2>
          <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame__middle">
              <p>Fecha: <?php echo get_post_meta(get_the_ID(), 'fee_date', true); ?></p>
            </div>
            <div class="wrap wrap--frame__middle">
              <p>Cantidad: <?php echo get_post_meta(get_the_ID(), 'fee_quantity', true); ?> €</p>
            </div>
          </div>
          <?php
          if($members_payed[get_current_user_id()] != ''){
            echo '<p>Estatus: Abonado '.$members_payed[get_current_user_id()].'</p>';
          }elseif($members_pending[get_current_user_id()] != ''){
            echo '<p>Estatus: Pendiente (en cola desde '.$members_pending[get_current_user_id()].')</p>';
          }else{
            echo '<p>Estatus: Por abonar</p>';
          }
          ?>
          <?php if($members_pending[get_current_user_id()] == '' && $members_payed[get_current_user_id()] == ''){ ?>
            <div class="wrap wrap--frame wrap--flex">
              <div class="wrap wrap--frame__middle">
                Método de pago
              </div>
              <div class="wrap wrap--frame__middle">
                <select name="paymethod" id="paymethod" onchange="ToggleSelect('paymethod')">
                  <option selected="true" disabled="disabled">Selecciona método de pago</option> 
                  <option value="transferency">Pago mediante transferencia</option>
                  <option value="paypal">Pago por paypal</option>
                </select>
              </div>
            </div>
            <div id="js-select-transferency" class="wrap wrap--frame wrap--hidden js-select">
              Pago por transferencia
            </div>
            <div id="js-select-paypal" class="wrap wrap--frame wrap--hidden js-select">
              Paypal
            </div>        
        </section>

        <section class="wrap wrap--frame wrap--empty wrap--submit">
          <p class="submit">
            <input name="payfee" type="submit" id="submit-all" class="button button-primary" value="Pagar cuota">
            <input name="action" type="hidden" id="action" value="pay-fee" />
          </p>
        </section>

        <?php } ?>


        <?php } ?>

      <?php endwhile; ?>
    <?php else : ?>

      <!-- noinfo -->
      <section class="wrap wrap--content">
        <h2>No se ha encontrado la información</h2>
      </section><!-- end of noinfo -->

    <?php endif; ?>
  </div><!-- end of flexboxer -->
</form>
<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>
<?php get_footer(); ?>