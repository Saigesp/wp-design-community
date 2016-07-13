<?php get_header(); ?> 

  <!-- flexboxer -->
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--page">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
      
        <!-- thumbnail -->
        <?php if(has_post_thumbnail()){ ?>
          <section class="wrap wrap--frame">
            <header id="header-<?php the_ID(); ?>" class="header header--article">
              <figure id="thumbnail" class="thumb--article js-thumbfull">
                <?php the_post_thumbnail('full');  ?>
              </figure>
              <div class="overflow overflow--black"></div>
              <div id="title" class="title title--article">
                <div class="divtextarticle">
                  <h2 class="titletextarticle titlesarticle" ><?php the_title(); ?></h2>
                  <?php if(function_exists('the_subtitle')){?>
                    <h3 class="subtitletextarticle titlesarticle"><?php the_subtitle(); ?></h3>
                  <?php } ?>
                </div>
              </div>
              <div class="categoryarticle">
                <p><?php the_category(', ');?></p>
              </div>
            </header>
          </section>
        <?php }?><!-- end of thumbnail -->

        <!-- content -->
        <section class="wrap wrap--content wrap--shadow">
          <?php if(!has_post_thumbnail()){ ?>
            <h2><?php the_title();?></h2>
          <?php }?>
          <?php the_content();?>
        </section><!-- end of content -->

      <?php endwhile; ?>
    <?php else : ?>

      <?php include(locate_template('templates/sections/404-noinfo.php')); ?>

    <?php endif; ?>
  </div><!-- end of flexboxer -->
<?php get_footer(); ?>