<?php if ($job_query->have_posts()) : ?>

  <section id="joblist" class="wrap wrap--content wrap--shadow wrap--hidden js-section active">
    <h2>Concursos</h2>
    <h3 class="sep">Listado de concursos</h3>
    <ul class="list">
      <?php while ($job_query->have_posts()) : $job_query->the_post(); ?>
        <?php
        $post_id = get_the_ID();
        $concurso_org = get_post_meta($post_id, 'concurso_org', true);
        ?>
        <li class="item wrap wrap--frame wrap--flex">
          <div class="wrap wrap--frame wrap--frame__fourth">
            <a href="<?php the_permalink();?>"><?php the_title();?></a>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
            <?php echo $concurso_org; ?>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
            <a href="<?php echo $concurso_bases; ?>"><span class="js-date"><?php echo $concurso_date; ?></span></a>
            <span class="js-date-fromnow help-info"><?php echo $concurso_date; ?></span>
          </div>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>

<?php else : ?>

  <?php include(locate_template('templates/sections/404-nojob.php')); ?>

<?php endif; ?>