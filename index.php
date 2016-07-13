<?php get_header(); ?>
<div class="flexboxer flexboxer--index">

  <?php if (have_posts()) : ?>
    
    <?php while (have_posts()) : the_post(); ?>
      <section class="wrap wrap--content wrap--shadow">
        <h3 class="title title--article__sub"><?php the_title(); ?></h3>
        <?php if(function_exists('the_subtitle')){?><h3 class="subtitle subtitle--article"><?php the_subtitle(); ?></h3><?php } ?>
        <div id="content-<?php the_ID(); ?>" class="content">
          <?php the_content(); ?>
        </div>
      </section>
    <?php endwhile; ?>

  <?php else : ?>

    <!-- noinfo -->
    <section class="wrap wrap--content wrap--transparent">
      <h3 class="title title--section">Ups!</h3>
      <p>No hemos encontrado la información que buscabas :(</p>
    </section>

  <?php endif; ?>
</div>
<?php get_footer();?>