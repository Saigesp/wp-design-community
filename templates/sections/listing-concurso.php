<?php if ($concurso_query->have_posts()) : ?>

  <section id="concursolist" class="wrap wrap--content wrap--shadow wrap--hidden js-section active">
    <h2>Concursos</h2>
    <h3 class="sep">Listado de concursos</h3>
    <?php while ($concurso_query->have_posts()) : $concurso_query->the_post(); ?>

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
  </section>

<?php else : ?>

  <?php include(locate_template('templates/sections/404-noconcurso.php')); ?>

<?php endif; ?>