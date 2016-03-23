<?php get_header(); ?> 
<?php if(is_user_role('administrator') || is_user_role('editor') || is_user_role('author')) { 

include(locate_template('functions-validation.php'));

$subscribers = new WP_User_Query(
    array(
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => $wpdb->get_blog_prefix( $blog_id ) . 'capabilities',
                'value' => 'subscriber',
                'compare' => 'like'
            ),
            array(
                'key' => $wpdb->get_blog_prefix( $blog_id ) . 'capabilities',
                'value' => '',
                'compare' => 'like'
            )
        )
    )
);
?>

<form method="POST" action="">
  <!-- flexboxer -->
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--fee">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?> 


        <?php if(is_user_role('administrator') || is_user_role('editor')) { ?>
          <?php if($subscribers->total_users > 0){ ?>

            <section class="wrap wrap--content">
              <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
              <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame__middle">
                  <p>Fecha: <?php echo get_post_meta(get_the_ID(), 'fee_date', true); ?></p>
                </div>
                <div class="wrap wrap--frame__middle">
                  <p>Cantidad: <?php echo get_post_meta(get_the_ID(), 'fee_quantity', true); ?> €</p>
                </div>
              </div>
              <div class="wrap wrap--frame wrap--userlist ">
                <h4>Socios con la cuota abonada</h4>
                <table>
                  <?php
                  $users = get_post_meta(get_the_ID(), 'members_payed', true);
                  include(locate_template('templates/loops/loop-userlist.php'));
                  ?>
                </table>
              </div>
              <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame__middle wrap--flex">
                  <div class="wrap wrap--frame__middle">
                    <label for="members_payed[]">Añadir abonos:</label>
                  </div>
                  <div class="wrap wrap--frame__middle">
                    <select name="members_payed[]" id="" class="select select-user chosen" multiple="multiple">
                      <option value="0">Ninguno</option>
                      <?php foreach ( $subscribers->results as $subscriber ) {
                              if(in_array($subscriber->ID, $users)) continue;
                              echo '<option value="'.esc_html($subscriber->ID ).'" ';
                              echo ' >'.esc_html($subscriber->first_name).' '.esc_html($subscriber->last_name).'</option>';
                          } ?>
                    </select>
                  </div>
                </div>
                <div class="wrap wrap--frame__middle wrap--flex">
                  <div class="wrap wrap--frame__middle">
                    <label for="members_topay[]">Quitar abonos:</label>
                  </div>
                  <div class="wrap wrap--frame__middle">
                    <select name="members_paydown[]" id="" class="select select-user chosen" multiple="multiple">
                      <option value="0">Ninguno</option>
                      <?php foreach ( $subscribers->results as $subscriber ) {
                              if(!in_array($subscriber->ID, $users)) continue;
                              echo '<option value="'.esc_html($subscriber->ID ).'" ';
                              echo ' >'.esc_html($subscriber->first_name).' '.esc_html($subscriber->last_name).'</option>';
                          } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="wrap wrap--frame wrap--userlist">
                <h4>Socios con la couta pendiente de validar</h4>
                <table>
                  <?php
                  $users = get_post_meta(get_the_ID(), 'members_pending', true);
                  include(locate_template('templates/loops/loop-userlist.php'));
                  ?>
                </table>
              </div>
              <div class="wrap wrap--frame wrap--flex">
                <div class="wrap wrap--frame__middle wrap--flex">
                  <div class="wrap wrap--frame__middle">
                    <label for="members_pending[]">Añadir abono pendiente</label>
                  </div>
                  <div class="wrap wrap--frame__middle">
                    <select name="members_pending[]" id="" class="select select-user chosen" multiple="multiple">
                      <option value="0">Ninguno</option>
                      <?php foreach ( $subscribers->results as $subscriber ) {
                              if(in_array($subscriber->ID, $users)) continue;
                              echo '<option value="'.esc_html($subscriber->ID ).'" ';
                              echo ' >'.esc_html($subscriber->first_name).' '.esc_html($subscriber->last_name).'</option>';
                          } ?>
                    </select>
                  </div>
                </div>
                <div class="wrap wrap--frame__middle wrap--flex">
                  <div class="wrap wrap--frame__middle">
                    <label for="members_pendingdown[]">Quitar abono pendiente</label>
                  </div>
                  <div class="wrap wrap--frame__middle">
                    <select name="members_pendingdown[]" id="" class="select select-user chosen" multiple="multiple">
                      <option value="0">Ninguno</option>
                      <?php foreach ( $subscribers->results as $subscriber ) {
                              if(!in_array($subscriber->ID, $users)) continue;
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
            <h2>Cuota <?php the_title();?></h2>
            <?php the_content();?>
          </section>

          <section class="wrap wrap--frame">
            <p class="submit">
              <input type="hidden" name="pay_fee" value="true" />
              <input type="submit" class="button button-primary" value="Pagar cuota">
            </p>
          </section>


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