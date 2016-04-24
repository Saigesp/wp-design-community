<section id="article-<?php the_ID(); ?>" class="wrap wrap--frame wrap--article
  <?php if($article_count == 0 && $pagec == 1) echo ' wrap--article__full wrap--article__special';?>
  <?php if($article_count > 7 && $article_count < 10) echo ' wrap--article__medium';?>
  <?php if(round(rand(0,5)) == 5) echo ' wrap--article__special';?>
  ">
  <?php if(has_post_thumbnail()){?>
    <figure class="thumb thumb--archive js-imagefill">
      <a href="<?php the_permalink() ?>">
        <div class="overflow overflow--black"></div>
        <?php the_post_thumbnail('full');?>
      </a>
    </figure>
  <?php } ?>
  <div class="wrap wrap--content content content--archive">
    <h2 class="title title--archive" ><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
    <div class="dates dates--archive">
      <span class="js-date">
        <?php
        $EM_Event = em_get_event($post->ID, 'post_id');
        $event_start_date = new DateTime($EM_Event->event_start_date.' '.$EM_Event->event_start_time);
        echo $event_start_date->format('Y-m-d H:i:s');
        ?>
      </span>

    </div>
    <div class="description description--archive">
      <?php the_excerpt(); ?>
    </div>
  </div>
</section>
<?php $article_count++; ?>

