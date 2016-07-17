<?php if ($concurso_query->have_posts()) : ?>

  <section id="concursolist" class="wrap wrap--content wrap--shadow">
    <h3 class="title title--section">Concursos</h3>
    <h3 class="sep">Listado de concursos</h3>
    <ul class="list">
      <?php while ($concurso_query->have_posts()) : $concurso_query->the_post(); ?>
        <?php
        $post_id = get_the_ID();
        $concurso_org       = get_post_meta(get_the_ID(), 'concurso_org', true) == '' ? get_post_meta(get_the_ID(), 'wpcf-conorg')[0] : get_post_meta(get_the_ID(), 'concurso_org', true);
        $concurso_bases     = get_post_meta(get_the_ID(), 'concurso_bases', true) == '' ? get_post_meta(get_the_ID(), 'wpcf-conbas')[0] : get_post_meta(get_the_ID(), 'concurso_bases', true);
        $concurso_quantity  = get_post_meta(get_the_ID(), 'concurso_quantity', true);
        $concurso_date      = get_post_meta(get_the_ID(), 'concurso_date', true) == '' ? date('Y-m-d H:i:s',get_post_meta(get_the_ID(), 'wpcf-confecha')[0]) : get_post_meta(get_the_ID(), 'concurso_date', true);

        ?>
        <li class="item wrap wrap--frame wrap--flex">
          <div class="wrap wrap--frame wrap--frame__middle">
            <a href="<?php the_permalink();?>"><?php the_title();?></a>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth <?php if(strlen($concurso_org) > 24) echo 'wrap--linestrech' ?>">
            <?php echo $concurso_org; ?>
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

  <?php include(locate_template('templates/sections/404-noconcurso.php')); ?>

<?php endif; ?>