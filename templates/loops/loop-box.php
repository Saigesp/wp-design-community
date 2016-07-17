<section id="article-<?php the_ID(); ?>" class="wrap wrap--frame wrap--shadow wrap--article ias-item
  <?php if($article_count == 0 && $pagec == 1) echo ' wrap--article__full wrap--article__special';?>
  <?php if($article_count%8 >= 0 && $article_count%8 < 2) echo ' wrap--article__medium';?>
  <?php if(round(rand(0,7)) >= 6) echo ' wrap--article__special';?>
  ">
  <?php if(has_post_thumbnail()){?>
    <figure class="thumb thumb--archive">
      <a href="<?php the_permalink() ?>">
        <?php the_post_thumbnail('full');?>
      </a>
    </figure>
  <?php } ?>
  <div class="wrap wrap--content content content--archive">
    <h2 class="title title--archive" ><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
    <p class="info info--post">
      <?php if(!is_user_role('administrator', get_the_author_meta('ID')))
        echo 'Por <a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.wpdc_get_user_name(get_the_author_meta('ID')).'</a> ';
      ?>
      <span class="js-date"><?php echo get_the_date('Y-m-d H:i:s');?></span>
    <p>
    <div class="content">
      <?php the_excerpt(); ?>
    </div>
  </div>
</section>

