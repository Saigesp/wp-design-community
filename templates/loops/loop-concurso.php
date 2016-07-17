<?php
$concurso_org       = get_post_meta(get_the_ID(), 'concurso_org', true) == '' ? get_post_meta(get_the_ID(), 'wpcf-conorg')[0] : get_post_meta(get_the_ID(), 'concurso_org', true);
$concurso_bases     = get_post_meta(get_the_ID(), 'concurso_bases', true) == '' ? get_post_meta(get_the_ID(), 'wpcf-conbas')[0] : get_post_meta(get_the_ID(), 'concurso_bases', true);
$concurso_quantity  = get_post_meta(get_the_ID(), 'concurso_quantity', true);
$concurso_date      = get_post_meta(get_the_ID(), 'concurso_date', true) == '' ? date('Y-m-d H:i:s',get_post_meta(get_the_ID(), 'wpcf-confecha')[0]) : get_post_meta(get_the_ID(), 'concurso_date', true);
?>

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
    <div class="wrap wrap--frame wrap--flex">
      <div class="wrap wrap--frame wrap--frame__middle">
        <span><strong>Convoca:</strong> <?php echo $concurso_org;?><br>
        <?php if($concurso_quantity != ''){ ?><strong>Primer premio:</strong> <?php echo $concurso_quantity;?><?php } ?></span>
      </div>
      <div class="wrap wrap--frame wrap--frame__middle">
        <span><strong>Cierre de convocatoria:</strong> <span class="js-date"><?php echo $concurso_date;?></span><br>
        <?php if($concurso_bases != ''){ ?>Link a las <strong><a href="<?php echo $concurso_bases;?>" target="_blank">bases del concurso</a></strong><?php } ?></span>
      </div>
    </div>
    <div class="content">
      <?php the_excerpt(); ?>
    </div>
  </div>
</section>

