<?php get_header(); ?> 
<?php if(is_user_role('administrator') || is_user_role('editor') || is_user_role('author')) { 

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

    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?> 

        <?php if(is_user_role('administrator') || is_user_role('editor')) { ?>

          <!-- page optiona -->
          <?php wpdc_the_pageoptions($pageoptions);?>
          
          <?php if($asociates->total_users > 0){?>

            <!-- gestión de pago de cuotas -->
            <?php include(locate_template('templates/sections/config-managefee.php')); ?>

          <?php }else{ ?>

            <?php include(locate_template('templates/sections/404-nousers.php')); ?> 

          <?php } ?>

        <?php } ?>

        <?php include(locate_template('templates/sections/fee-pay.php')); ?>

      <?php endwhile; ?>
    <?php else : ?>

      <?php include(locate_template('templates/sections/404-noinfo.php')); ?>    

    <?php endif; ?>
  </div><!-- end of flexboxer -->
<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>
<?php get_footer(); ?>