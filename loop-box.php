<?php if(has_post_thumbnail()){ ?>
  
  <!-- thumbnail -->
  <section class="wrap wrap--frame">
    <header id="header-<?php the_ID(); ?>" class="header header--article">
      <figure id="thumbnail" class="thumb thumb--article js-thumbfull">
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
  </section><!-- end of thumbnail -->

<?php }else{?>

  <!-- content -->
  <section class="wrap wrap--content">
    <h2><?php the_title();?></h2>
    <?php the_content();?>
  </section><!-- end of content -->

<?php }?>