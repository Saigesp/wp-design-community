<?php get_header(); ?> 

  <!-- flexboxer -->
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--page article">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
      
        <!-- thumbnail -->
          <section class="wrap wrap--frame wrap--shadow">
            <?php if(has_post_thumbnail()){ ?>
              <header id="header-<?php the_ID(); ?>" class="header header--article">
                <figure id="thumbnail" class="thumb--article js-thumbfull">
                  <?php the_post_thumbnail('full');  ?>
                </figure>
              </header>
            <?php }?><!-- end of thumbnail -->
            <div class="wrap wrap--content">
              <h2><?php the_title();?></h2>
              <?php the_content();?>
            </div>
          </section>

      <?php endwhile; ?>
    <?php else : ?>

      <?php include(locate_template('templates/sections/404-noinfo.php')); ?>

    <?php endif; ?>
  </div><!-- end of flexboxer -->
<?php get_footer(); ?>