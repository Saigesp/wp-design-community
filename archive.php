<?php get_header(); ?>

<!-- flexboxer -->
<div class="flexboxer flexboxer--page">

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    
      
      <?php if(has_post_thumbnail()){ ?>
        
        <!-- thumbnail -->
        <section class="wrap wrap--frame">
          <header id="header-<?php the_ID(); ?>" class="headerarticle">
            <figure id="thumbnail" class="thumbarticle">
              <?php the_post_thumbnail('full');  ?>
            </figure>
            <div class="overflow overflow--black"></div>
            <div id="title" class="titlearticle">
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
        </section><!-- end of thumbnail -->

      <?php }else{?>

        <!-- content -->
        <section class="wrap wrap--content">
          <?php if(!has_post_thumbnail()){ ?>
            <h2><?php the_title();?></h2>
          <?php }?>
          <?php the_content();?>
        </section><!-- end of content -->

      <?php }?>

    <?php endwhile; ?>
  <?php else : ?>

    <!-- noinfo -->
    <section class="wrap wrap--content">
      <h2>No info</h2>
    </section><!-- end of noinfo -->

  <?php endif; ?>

</div><!-- end of flexboxer -->

<?php get_footer(); ?>




  
