<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_concursos' || is_user_role('administrator')) {

  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_type' => 'concursos',
    //'orderby' => 'meta_value',
    //'meta_key'  => '_start_ts',
  );
  $wp_query = new wp_query( $args );


  if(is_user_role('administrator') || is_user_role('editor')) { 
    include(locate_template('templates/functions/functions-validation.php'));
    $pageoptions = [
      "newconcurso" => "Crear concurso",
      "setconcursosoptions" => "Configurar concursos",

    ];
  }

  ?>

  <!-- flexboxer -->
  <form method="POST" action="">
    <div class="flexboxer flexboxer--event">

      <?php// include(locate_template('templates/harry/harry.php')); ?>

      <!-- admin options -->
      <?php if(is_user_role('administrator') || is_user_role('editor')) wpdc_the_pageoptions($pageoptions);?>

      <!-- new concurso -->
      <?php include(locate_template('templates/sections/concurso-create.php')); ?>

      <!-- config concursos -->
      <?php include(locate_template('templates/sections/concurso-config.php')); ?>


    <?php if (have_posts()) : ?>
      <section class="wrap wrap--content wrap--shadow">
        <h2>Concursos</h2>
        <h3 class="sep">Listado de concursos</h3>
        <?php while (have_posts()) : the_post(); ?>

          <!-- content -->
            <div class="wrap wrap--frame wrap--flex">
              <div class="wrap wrap--frame__middle wrap--flex">
                <div class="wrap wrap--frame__middle">
                  <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </div>
                <div class="wrap wrap--frame__middle">
                  <span class="js-date">
                  <?php ?>
                  </span>
                  <span class="js-date-fromnow help-info"></span>
                </div>
              </div>
              <div class="wrap wrap--frame__middle wrap--flex">
                <div class="wrap wrap--frame__middle">
                  
                </div>
                <div class="wrap wrap--frame__middle">
                  
                </div>
              </div>
            </div>
        <?php endwhile; ?>
      </section><!-- end of content -->
      <?php else : ?>

        <!-- noinfo -->
        <section class="wrap wrap--content wrap--shadow">
          <h2>Concursos</h2>
          <p>Todavía no has creado ningún concurso. <a onclick="ToggleSection(this)" data-section="newconcurso">¿Quieres crear uno?</a></p>
        </section><!-- end of noinfo -->

      <?php endif; ?>

    
  </div><!-- end of flexboxer -->
  </form>

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>