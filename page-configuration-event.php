<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_events' || is_user_role('administrator')) {

  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_type' => 'event',
    'orderby' => 'meta_value',
    'meta_key'  => '_start_ts',
  );
  $wp_query = new wp_query( $args );


  if(is_user_role('administrator') || is_user_role('editor')) { 
    include(locate_template('functions-validation.php'));
  }

  ?>

  <!-- flexboxer -->
  <form method="POST" action="">
  <div class="flexboxer flexboxer--event">

        <?php include(locate_template('templates/harry/harry.php')); ?>

  		<!-- admin options -->
        <section class="wrap wrap--content wrap--content__toframe wrap--flex wrap--transparent wrap--menu">
            <div class="wrap wrap--frame wrap--frame__middle">
                <p></p>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
              <p class="right"><a href="<?php echo get_bloginfo('url');?>/edit-event" target="_blank" class="">Crear evento</a></p>
              <p class="right"><a onclick="ToggleSection(this)" class="js-section-launch" data-section="seteventoptions">Configurar eventos</a></p>
            </div>
        </section><!-- end of admin options -->

        <section id="seteventoptions" class="wrap wrap--content wrap--form wrap--hidden js-section">
          <h3>Configurar eventos</h3>
          <div class="wrap wrap--flex">
            <div class="wrap wrap--frame__middle">
              <label for="">Lorem ipsum</label>
            </div>
            <div class="wrap wrap--frame__middle">
              <input type="text" name="" value=""/>
            </div>
          </div>
          <div class="wrap wrap--icon wrap--icon__close js-section-launch" onclick="ToggleSection(this)" data-section="close">
              <?php the_svg_icon('close', 'icon--corner js-close-alert'); ?>
          </div>
        </section>

  <?php if (have_posts()) : ?>
      <section class="wrap wrap--content">
        <h2>Eventos</h2>
        <h4>Eventos</h4>
        <?php while (have_posts()) : the_post(); 
          $EM_Event = em_get_event($post->ID, 'post_id');
          $event_start_date = new DateTime($EM_Event->event_start_date.' '.$EM_Event->event_start_time);
          $event_end_date = new DateTime($EM_Event->event_end_date.' '.$EM_Event->event_end_time);
          ?>

          <!-- content -->
            <div class="wrap wrap--frame wrap--flex">
              <div class="wrap wrap--frame__middle wrap--flex">
                <div class="wrap wrap--frame__middle">
                  <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </div>
                <div class="wrap wrap--frame__middle">
                  <span class="js-date">
                  <?php
                  if($event_start_date->format('H:i:s') != '00:00:00') echo $event_start_date->format('d-m-Y H:i');
                  else {
                    $duration = date(strtotime($event_end_date->format('Y-m-d H:i')) - strtotime($event_start_date->format('Y-m-d H:i')));
                    echo $event_start_date->format('d-m-Y').' ('.date('j', $duration).' días)';
                  }
                  ?>
                  </span>
                  <span class="js-date-fromnow help-info"><?php echo $event_start_date->format('Y-m-d H:i:s');?></span>
                </div>
              </div>
              <div class="wrap wrap--frame__middle wrap--flex">
                <div class="wrap wrap--frame__middle">
                  <?php
                    echo $EM_Event->output('#_EVENTPRICERANGEALL');
                  ?>
                </div>
                <div class="wrap wrap--frame__middle">
                  <?php
                  if($EM_Event->output('#_SPACES') > 0){
                    echo 'Reservas: '.($EM_Event->output('#_SPACES') - $EM_Event->output('#_AVAILABLESPACES')).' / '.$EM_Event->output('#_SPACES');
                    if($EM_Event->output('#_PENDINGSPACES') > 0){
                      echo '/'
                      .$EM_Event->output('#_PENDINGSPACES')
                      .' pendientes';
                    }
                  }else{
                    echo 'Sin reservas';
                  }
                  if(date(strtotime('now')) > strtotime($EM_Event->event_end_date.' '.$EM_Event->event_end_time))
                    echo ' <span class="help-info">Finalizado</span>';
                  elseif(date(strtotime('now')) > strtotime($EM_Event->event_start_date.' '.$EM_Event->event_start_time) && date(strtotime('now')) > strtotime($EM_Event->event_end_date.' '.$EM_Event->event_end_time))
                    echo ' <span class="help-info">En transcurso</span>';
                  elseif(date(strtotime('now')) < strtotime($EM_Event->event_start_date.' '.$EM_Event->event_start_time))
                    echo ' <span class="help-info">Programado</span>';
                  
                  ?>
                </div>
              </div>
            </div>
        <?php endwhile; ?>
      </section><!-- end of content -->
      <?php else : ?>

        <!-- noinfo -->
        <section class="wrap wrap--content">
          <h2>No hay eventos creados</h2>
        </section><!-- end of noinfo -->

      <?php endif; ?>

    
  </div><!-- end of flexboxer -->
  </form>

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>