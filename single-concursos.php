<?php

get_header();
$concurso_org = get_post_meta(get_the_ID(), 'concurso_org', true);
$concurso_bases = get_post_meta(get_the_ID(), 'concurso_bases', true);
$concurso_quantity = get_post_meta(get_the_ID(), 'concurso_quantity', true);
$concurso_date = get_post_meta(get_the_ID(), 'concurso_date', true);

?>


<div class="flexboxer flexboxer--single flexboxer--single__concurso">

  <?php if (have_posts()) : ?>
    
    <section class="wrap wrap--content wrap--shadow">
      <?php while (have_posts()) : the_post(); ?>
        <h3 class="title title--article__sub"><?php the_title(); ?></h3>

        <div class="wrap wrap--frame wrap--flex">
          <div class="wrap wrap--frame wrap--frame__middle">
            <span><strong>Convoca:</strong> <?php echo $concurso_org;?><br>
            <strong>Primer premio:</strong> <?php echo $concurso_quantity;?></span>
          </div>
          <div class="wrap wrap--frame wrap--frame__middle">
            <span><strong>Cierre de convocatoria:</strong> <?php echo $concurso_date;?><br>
            <strong><a href="<?php echo $concurso_org;?>" target="_blank">Bases del concurso</a></strong></span>
          </div>
        </div>
        
        <div id="content-<?php the_ID(); ?>" class="wrap wrap--frame">
          <?php the_content(); ?>
        </div>

      <?php endwhile; ?>
    </section>

  <?php else : ?>

      <?php include(locate_template('templates/sections/404-noinfo.php')); ?>

  <?php endif; ?>
</div>
<?php get_footer();?>