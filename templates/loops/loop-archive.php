<section id="article-<?php the_ID(); ?>" class="wrap wrap--frame wrap--article js-showonload js-showonload-active <?php if($article_count == 0) echo 'wrap--article__first';?>">
  <?php if(has_post_thumbnail()){?>
    <figure class="thumb thumb--archive js-imagefill">
      <a href="<?php the_permalink() ?>">
        <?php the_post_thumbnail('full');?>
      </a>
    </figure>
  <?php } ?>
  <div class="wrap wrap--content content content--archive">
    <h2 class="title title--archive" ><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
    <div class="description description--archive">
      <?php the_excerpt(); ?>
    </div>
  </div>
</section>
<?php $article_count++; ?>

