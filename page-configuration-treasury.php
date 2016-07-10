<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_position', true) == 'tesorero' || is_user_role('administrator')) {

  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_type' => 'fee',
    'orderby' => 'meta_value',
    'meta_key'  => 'fee_date',
  );
  $wp_query = new wp_query( $args );


/*  if(is_user_role('administrator') || is_user_role('editor')) { 
    include(locate_template('functions-validation.php'));
  }
*/

  $pageoptions = [
      "feelist" => "X Cuotas",
      "createfee" => "Crear cuota",
      "setbankaccount" => "Configurar cuentas",
  ];
  ?>

  <!-- flexboxer -->
  <form method="POST" action="">
    <div class="flexboxer flexboxer--event">

      <?php// include(locate_template('templates/harry/harry.php')); ?>

      <!-- admin options -->
      <?php wpdc_the_pageoptions($pageoptions);?>

      <!-- create fee options -->
      <?php include(locate_template('templates/sections/fee-create.php')); ?>

      <!-- bank account options -->
      <?php include(locate_template('templates/sections/config-bankaccount.php')); ?>
          
      <!-- fee list -->
      <?php if (have_posts()) { ?>
        <?php include(locate_template('templates/sections/config-bankaccount.php')); ?>
      <?php } else { ?>
        <section id="feelist" class="wrap wrap--content wrap--shadow js-section wrap--hidden active">
          <h2>Cuotas</h2>
          <p>Todavía no hay cuotas creadas. <a onclick="ToggleSection(this)" class="js-section-launch" data-section="createfee">¿Quieres crear una?</a></p>
        </section>
      <?php } ?>
      
    </div>
  </form>

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>