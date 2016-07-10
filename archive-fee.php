<?php

get_header(); 

$args = array (
  'order' => 'DESC',
  'posts_per_page' => -1,
  'post_type' => 'fee',
  'orderby' => 'meta_value',
  'meta_key'  => 'fee_date',
);
$wp_query = new wp_query( $args );

// Variables generales del usuario
$payed_in = 0;
$pending_in = 0;
$must_pay = 0;

if (have_posts()) : while (have_posts()) : the_post();

  // Si la cuota es futura, saltar
  if(date(strtotime(get_post_meta(get_the_ID(), 'fee_date', true))) > date(strtotime('now')) && is_user_role('author')) continue; // Cuota futura

  // Si la cuota es anterior al registro del usuario, saltar
  if(date(strtotime(get_post_meta(get_the_ID(), 'fee_date', true))) < date(strtotime(get_the_author_meta('user_registered', get_current_user_id())))) continue;

  $members_payed = is_array(get_post_meta(get_the_ID(), 'members_payed', true)) ? get_post_meta(get_the_ID(), 'members_payed', true) : array();
  $members_pending = is_array(get_post_meta(get_the_ID(), 'members_pending', true)) ? get_post_meta(get_the_ID(), 'members_pending', true) : array();

  if($members_payed[get_current_user_id()] != '')  $payed_in++;
  elseif($members_pending[get_current_user_id()] != '')  $pending_in++;
  else $must_pay++;

endwhile; endif;

?>
  <!-- flexboxer -->
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--fees">

    <?php if (have_posts()) : ?>
    <section class="wrap wrap--content wrap--shadow">
      <h2>Cuotas</h2>
      <p><?php
        if($must_pay == 0 && $pending_in == 0) echo 'Bien! No tienes cuotas pendientes!';
        elseif($pending_in == 1) echo '1 cuota en proceso';
        elseif($pending_in > 1) echo $pending_in.' cuotas en proceso';
        elseif($must_pay == 1) echo 'Ey! tienes una cuota pendiente!';
        elseif($must_pay > 1) echo 'Ey! tienes '.$must_pay.' cuotas pendientes!';
        ?></p>
      <h4>Cuotas</h4>
      <?php while (have_posts()) : the_post(); 
        $members_payed = is_array(get_post_meta(get_the_ID(), 'members_payed', true)) ? get_post_meta(get_the_ID(), 'members_payed', true) : array();
        $members_pending = is_array(get_post_meta(get_the_ID(), 'members_pending', true)) ? get_post_meta(get_the_ID(), 'members_pending', true) : array();
        if(date(strtotime(get_post_meta(get_the_ID(), 'fee_date', true))) > date(strtotime('now'))) continue;
        if(date(strtotime(get_post_meta(get_the_ID(), 'fee_date', true))) < date(strtotime(get_the_author_meta('user_registered', get_current_user_id())))) continue;
        ?>

        <!-- content -->
          <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame__middle wrap--flex">
              <div class="wrap wrap--frame__middle">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
              </div>
              <div class="wrap wrap--frame__middle">
                <?php echo get_post_meta(get_the_ID(), 'fee_date', true); ?>
              </div>
            </div>
            <div class="wrap wrap--frame__middle wrap--flex">
              <div class="wrap wrap--frame__middle">
                <?php echo get_post_meta(get_the_ID(), 'fee_quantity', true); ?> €
              </div>
              <div class="wrap wrap--frame__middle">
            <?php if(is_user_role('administrator') || is_user_role('editor')) { ?>
              <?php if(get_post_meta(get_the_ID(), 'members_payed', true) != '') echo sizeof(get_post_meta(get_the_ID(), 'members_payed', true)); else echo '0';?> Abonados, <?php if(get_post_meta(get_the_ID(), 'members_pending', true) != '') echo sizeof(get_post_meta(get_the_ID(), 'members_pending', true)); else echo '0'; ?> Pendientes
            <?php }else{
              if($members_pending[get_current_user_id()] != '' || $members_payed[get_current_user_id()] != ''){
                if($members_pending[get_current_user_id()] != '') {
                  echo 'En proceso';
                }else{
                  echo 'Abonado';
                }
              } else {
                if(date(strtotime(get_post_meta(get_the_ID(), 'fee_date', true))) > date(strtotime('now'))){
                  echo 'Cuota futura';
                }elseif(date(strtotime(get_post_meta(get_the_ID(), 'fee_date', true))) < date(strtotime(get_the_author_meta('user_registered', get_current_user_id())))){
                  echo 'Cuota anterior al registro';
                }else{
                  echo 'No abonado';
                }
              } 
            } ?>
              </div>
            </div>
          </div>
      <?php endwhile; ?>
    </section><!-- end of content -->
    <?php else : ?>

      <!-- noinfo -->
      <section class="wrap wrap--content wrap--transparent">
        <h2>No hay cuotas creadas</h2>
      </section><!-- end of noinfo -->

    <?php endif; ?>
  </div><!-- end of flexboxer -->
<?php get_footer(); ?>