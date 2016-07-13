<?php get_header(); ?> 
<?php if(is_user_role('administrator') || is_user_role('editor') || is_user_role('author')) { 

include(locate_template('templates/functions/functions-validation.php'));

$asociates = new WP_User_Query(
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

$pageoptions = [
    "feeinfo" => "Pagar cuota",
    "managefee" => "Gestionar pagos",
];

?>




  <!-- flexboxer -->
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--single flexboxer--single__fee">

    <?php do_action( 'front_end_box/singlefee' );?>

    <?php if(is_user_role('administrator') && !empty($_POST)){ ?>
      <section class="wrap wrap--content wrap--shadow">
        <h3 class="title title--section">$_POST</h3>
        <?php
        if(is_array($_POST)) { echo '<strong>Array()</strong><br>';
          foreach ($_POST as $key => $value) {
            if (is_array($value)){ foreach ($value as $k => $v) { echo $key . '[' . $k . ']: ' . $v . '<br>'; } }
            else echo $key . ': ' . $value . '<br>';
          } }else{ var_dump($_POST);}
        ?>
      </section>
    <?php } ?>

    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?> 

        <?php if(is_user_role('administrator') || is_user_role('editor')) { ?>

          <?php wpdc_the_pageoptions($pageoptions);?>
          
          <?php if($asociates->total_users > 0){?>

            <!-- gestión de pago de cuotas -->
            <?php include(locate_template('templates/sections/config-managefee.php')); ?>

          <?php }else{ // No authors in list ?>

            <section class="wrap wrap--content wrap--transparent">
              <p>No hay suscriptores :(</p>
            </section>

          <?php } ?>

        <?php } //End of admin part ?>

        <?php include(locate_template('templates/sections/fee-pay.php')); ?>

      <?php endwhile; ?>
    <?php else : ?>

      <!-- noinfo -->
      <section class="wrap wrap--content wrap--transparent">
        <h2>No encontramos lo que pedías :(</h2>
      </section><!-- end of noinfo -->

    <?php endif; ?>
  </div><!-- end of flexboxer -->
<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>
<?php get_footer(); ?>