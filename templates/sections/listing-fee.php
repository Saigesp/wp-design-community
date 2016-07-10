<section id="feelist" class="wrap wrap--content wrap--shadow">
  <h2>Cuotas</h2>
  <h4>Cuotas</h4>
  <?php while (have_posts()) : the_post(); 
    $members_payed = is_array(get_post_meta(get_the_ID(), 'members_payed', true)) ? get_post_meta(get_the_ID(), 'members_payed', true) : array();
    $members_pending = is_array(get_post_meta(get_the_ID(), 'members_pending', true)) ? get_post_meta(get_the_ID(), 'members_pending', true) : array();
    ?>

    <!-- content -->
      <div class="wrap wrap--frame wrap--flex">
        <div class="wrap wrap--frame__middle wrap--flex">
          <div class="wrap wrap--frame__middle">
            <a href="<?php the_permalink();?>"><?php the_title();?></a>
          </div>
          <div class="wrap wrap--frame__middle">
            <span class="js-date"><?php echo date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'fee_date', true)));?></span>
            <span class="js-date-fromnow help-info"><?php echo get_post_meta(get_the_ID(), 'fee_date', true);?></span>
          </div>
        </div>
        <div class="wrap wrap--frame__middle wrap--flex">
          <div class="wrap wrap--frame__middle">
            <?php
            echo get_post_meta(get_the_ID(), 'fee_quantity', true).' €'; 
            if(get_post_meta(get_the_ID(), 'members_payed', true) != '')
              echo ' <span class="help-info">Recaudados '.get_post_meta(get_the_ID(), 'fee_quantity', true)*sizeof(get_post_meta(get_the_ID(), 'members_payed', true)).' €</span>';
            ?>
          </div>
          <div class="wrap wrap--frame__middle">
        <?php if(date(strtotime(get_post_meta(get_the_ID(), 'fee_date', true))) > date(strtotime('now'))){
        		echo 'Evento futuro';
        	  } else {
                if(get_post_meta(get_the_ID(), 'members_payed', true) != '') echo sizeof(get_post_meta(get_the_ID(), 'members_payed', true));
                else echo '0';
                echo ' Abonos, ';
                if(get_post_meta(get_the_ID(), 'members_pending', true) != '') echo sizeof(get_post_meta(get_the_ID(), 'members_pending', true));
                else echo '0';
                echo ' En proceso';
        	  }	?>
          </div>
        </div>
      </div>
  <?php endwhile; ?>
</section>