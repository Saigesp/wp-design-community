<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_jobs' || is_user_role('administrator')) {

  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_type' => 'jobs',
  );
  $wp_query = new wp_query( $args );

  $pageoptions = [
    "newjob" => "Nueva oferta",
    "managejob" => "Configurar trabajos",
  ];

  if(is_user_role('administrator') || is_user_role('editor')) { 
    include(locate_template('templates/functions/functions-validation.php'));
  }

  ?>

  <!-- flexboxer -->
  <form method="POST" action="">
    <div class="flexboxer flexboxer--configuration flexboxer--configuration__jobs">

      <?php // include(locate_template('templates/harry/harry.php')); ?>

      <!-- admin options -->
      <?php wpdc_the_pageoptions($pageoptions);?>

      <!-- new job -->
      <?php include(locate_template('templates/sections/job-create.php')); ?>

      <!-- config cjob -->
      <?php include(locate_template('templates/sections/job-config.php')); ?>

      

      <?php if (have_posts()) : ?>
        <section class="wrap wrap--content wrap--shadow">
          <h3 class="title title--section">Concursos</h3>
          <h4>Concursos</h4>
          <?php while (have_posts()) : the_post(); 
            //$postmeta = get_post_meta($post->ID);
            //var_dump($EM_Event);
            ?>

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
          <h3 class="title title--section">Ofertas laborales</h3>
          <p>Todavía no has creado ninguna oferta. <a onclick="ToggleSection(this)" data-section="newjob">¿Quieres crear una?</a></p>
        </section><!-- end of noinfo -->

      <?php endif; ?>

    
  </div><!-- end of flexboxer -->
  </form>

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>