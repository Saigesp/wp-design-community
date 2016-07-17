<?php if ($posts_query->have_posts()) : ?>

  <section id="postslist" class="wrap wrap--content wrap--shadow wrap--hidden js-section active">
    <h2>Artículos</h2>
    <h3 class="sep">Listado de artículos publicados</h3>
    <ul class="list">
      <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
        <?php
        $post_id = get_the_ID();
        ?>
        <li class="item wrap wrap--frame wrap--flex">
          <div class="wrap wrap--frame wrap--frame__middle">
            <a href="<?php the_permalink();?>"><?php the_title();?></a>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php echo wpdc_get_user_name(get_the_author_meta('ID'));?></a>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
            <a href="<?php echo site_url('/edit-posts/?id='.$post_id); ?>"><span class="js-date"><?php echo get_the_date('Y-m-d h:i:s'); ?></span></a>
              <span class="js-date-fromnow help-info"><?php echo get_the_date('Y-m-d h:i:s'); ?></span>
          </div>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>

<?php else : ?>

  <?php include(locate_template('templates/sections/404-nojob.php')); ?>

<?php endif; ?>