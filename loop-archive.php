<section id="article-<?php the_ID(); ?>" class="wrap wrap--frame">
  <?php if(has_post_thumbnail()){?>
    <figure class="thumb thumb--archive js-imagefill" style="height: 300px;">
      <a href="<?php the_permalink() ?>">
        <?php the_post_thumbnail('full');?>
      </a>
    </figure>
  <?php } ?>
  <div class="wrap wrap--content content content--archive">
    <h2 class="title title--archive" ><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
    <div class="description description--archive">
      <?php the_excerpt();?>
    </div>
  </div>
</section>

