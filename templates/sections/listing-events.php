<section id="eventlist" class="wrap wrap--content wrap--shadow">
        <h3 class="title title--section">Eventos</h3>
        <h3 class="sep">Listado de eventos</h3>
        <?php if (have_posts()) : ?>
          <ul class="list">
        <?php while (have_posts()) : the_post(); 
          $EM_Event = em_get_event($post->ID, 'post_id');
          $event_start_date = new DateTime($EM_Event->event_start_date.' '.$EM_Event->event_start_time);
          $event_end_date = new DateTime($EM_Event->event_end_date.' '.$EM_Event->event_end_time);
          ?>

          <!-- content -->
            <li class="item wrap wrap--frame wrap--flex">

              <div class="wrap wrap--frame__middle">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
              </div>

              <div class="wrap wrap--frame__fourth">
                <span class="js-date">
                  <?php
                  if($event_start_date->format('H:i:s') != '00:00:00') echo $event_start_date->format('d-m-Y H:i');
                  else {
                    $duration = date(strtotime($event_end_date->format('Y-m-d H:i')) - strtotime($event_start_date->format('Y-m-d H:i')));
                    echo $event_start_date->format('d-m-Y').' ('.date('j', $duration).' días)';
                  }
                  ?>
                </span>
              </div>

              <div class="wrap wrap--frame__fourth">
                <?php
                if($EM_Event->output('#_SPACES') > 0){
                  echo 'Reservas: '.($EM_Event->output('#_SPACES') - $EM_Event->output('#_AVAILABLESPACES')).'/'.$EM_Event->output('#_SPACES');
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

            </li>
        <?php endwhile; ?>
        </ul>
        <?php else : ?>

        <h2>No hay eventos creados</h2>

      <?php endif; ?>
      </section>