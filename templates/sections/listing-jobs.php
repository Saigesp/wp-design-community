<?php if ($job_query->have_posts()) : ?>

  <section id="joblist" class="wrap wrap--content wrap--shadow wrap--hidden js-section active">
    <h2>Ofertas de trabajo</h2>
    <h3 class="sep">Listado de ofertas de trabajo</h3>
    <ul class="list">
      <?php while ($job_query->have_posts()) : $job_query->the_post(); ?>
        <?php
        $post_id = get_the_ID();
        $job_bussiness = get_post_meta($post_id, 'job_bussiness', true);
        ?>
        <li class="item wrap wrap--frame wrap--flex">
          <div class="wrap wrap--frame wrap--frame__fourth">
            <a href="<?php the_permalink();?>"><?php the_title();?></a>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
            <?php echo $job_bussiness; ?>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
            <a href="<?php echo $job_info; ?>"><span class="js-date"><?php echo get_the_date('Y-m-d h:i:s'); ?></span></a>
              <span class="js-date-fromnow help-info"><?php echo get_the_date('Y-m-d h:i:s'); ?></span>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
          </div>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>

<?php else : ?>

  <?php include(locate_template('templates/sections/404-nojob.php')); ?>

<?php endif; ?>