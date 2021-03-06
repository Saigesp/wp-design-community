<section id="feelist" class="wrap wrap--content wrap--shadow js-section wrap--hidden active">
  <h3 class="title title--section">Cuotas</h3>
  
  <h3 class="sep">Listado de cuotas</h3>
  <ul class="list">
    <?php while (have_posts()) : the_post(); 
      $members_payed = is_array(get_post_meta(get_the_ID(), 'members_payed', true)) ? get_post_meta(get_the_ID(), 'members_payed', true) : array();
      $members_pending = is_array(get_post_meta(get_the_ID(), 'members_pending', true)) ? get_post_meta(get_the_ID(), 'members_pending', true) : array();
      $fee_date_start = get_post_meta(get_the_ID(), 'fee_date_start', true);
      $fee_date_end = get_post_meta(get_the_ID(), 'fee_date_end', true);
      ?>
        <li class="item wrap wrap--flex">
          <div class="wrap wrap--frame wrap--frame__fourth">
            <a href="<?php the_permalink();?>"><?php the_title();?></a>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
          <span>
          <?php
          if(strtotime($fee_date_start) > time()) echo 'Programado para el <span class="js-date">'.$fee_date_start.'</span>';
          elseif(strtotime($fee_date_end) < time()) echo 'Finalizado el <span class="js-date">'.$fee_date_end.'</span>';
          else echo 'Activo hasta el <span class="js-date">'.$fee_date_end.'</span>';
          ?>
          <span>
          <?php /*
            <span class="js-date"><?php echo $fee_date_start;?></span>
            <span class="js-date-fromnow help-info"><?php echo $fee_date_start;?></span>
            */ ?>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
            <?php
            echo get_post_meta(get_the_ID(), 'fee_quantity', true).' €'; 
            if(get_post_meta(get_the_ID(), 'members_payed', true) != '')
              echo ' <span class="help-info">Recaudados '.get_post_meta(get_the_ID(), 'fee_quantity', true)*sizeof(get_post_meta(get_the_ID(), 'members_payed', true)).' €</span>';
            ?>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
            <?php
            if(date(strtotime(get_post_meta(get_the_ID(), 'fee_date', true))) > date(strtotime('now'))){
          		echo 'Evento futuro';
          	  } else {
                  if(get_post_meta(get_the_ID(), 'members_payed', true) != '') echo sizeof(get_post_meta(get_the_ID(), 'members_payed', true));
                  else echo '0';
                  echo ' Abonos';
                  if(get_post_meta(get_the_ID(), 'members_pending', true) != '') echo ' ('.sizeof(get_post_meta(get_the_ID(), 'members_pending', true));
                  else echo ' (0';
                  echo ' En proceso)';
          	}	?>
          </div>
        </li>
    <?php endwhile; ?>
  </ul>
</section>