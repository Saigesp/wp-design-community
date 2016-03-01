<section id="article-<?php the_ID(); ?>" class="wrap <?php if(has_post_thumbnail()) echo 'wrap--frame'; else echo 'wrap--content';?>">
  <?php if(has_post_thumbnail()){?>
    <figure class="thumb thumb--archive">
      <a href="<?php the_permalink() ?>">
        <?php the_post_thumbnail('medium');?>
      </a>
    </figure>
  <?php } ?>
  <div class="content content--archive">
    <h2 class="title title--archive" ><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
    <div class="description description--archive">
      <?php the_excerpt();?>
    </div>
  </div>
</section>

