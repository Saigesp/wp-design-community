<?php
  $word_limit = 30;
  $more_txt = 'read more about:'; // The read more text
  $txt_end = '...'; // Display text end 
?>

<div class="iasitem">
  <?php  if ( has_post_thumbnail() ) { ?>
  <hr class="separatorarch">
  <?php }  ?>
  <article id="archiclearch-<?php the_ID(); ?>" class="articlearch <?php if(!has_post_thumbnail()) echo 'articlearch--nothumb';?>">
    <?php if(has_post_thumbnail()){?>
      <figure id="thumbarch-<?php the_ID(); ?>" class="thumbarch">
          <a href="<?php the_permalink() ?>">
            <?php the_post_thumbnail('medium');  ?>
            <div class="overflow overflow--blue__hover overflow--blend__hover"></div>
        </a>
      </figure>
    <?php } ?>
    <section id="section-<?php the_ID(); ?>" class="sectionarch">
      <div id="header-<?php the_ID(); ?>" class="headerarch">
        <header id="title-<?php the_ID(); ?>" class="titlearch">
          <h2 class="titletextarch" ><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
        </header>
        <div id="content-<?php the_ID(); ?>" class="contentarch">
          <p class="contentp"><?php echo wp_trim_words(strip_tags(get_the_excerpt()), $word_limit, $txt_end, $more_txt); ?></p>
        </div>
      </div>
      <?php if(has_category()){?>
      <div class="categoryarch">
        <p><?php the_category(', ');?></p>
      </div>
      <?php } ?>
      <div class="contentauthor">
        <p class="authorarch"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></p>
        <p class="datearch"><?php echo get_the_date();?></p>
        <?php if(function_exists('wpp_get_views')){ ?><p class="datearch viewarch"><?php the_svg_icon('eye');?> <?php echo wpp_get_views(get_the_ID(),'all');?></p><?php } ?>
      </div>
   	</section>
  </article>
  <?php
    $cont++;
    if($cont != '' && $cont == 5){
      ?>
      <hr class="separatorarch">
        <?php if($pagec%3 == 1){?>

        <div class="morecontent morecontent--blue">
          <h2>Lo más leido esta semana</h2>
          <div class="list">
            <?php echo do_shortcode('[wpp range=weekly stats_views=0 order_by=views limit=5]');?>
          </div>
          <div class="listthumb">
            <?php echo do_shortcode('[wpp range=weekly stats_views=0 order_by=views limit=1 thumbnail_width=218 thumbnail_height=218 post_html="<li>{thumb}</li>" );]');?>
          </div>
        </div>
        <?php }elseif($pagec%3 == 2){ ?>
        <div class="morecontent morecontent--red">
          <h2>Lo más leido este mes</h2>
          <div class="list">
            <?php echo do_shortcode('[wpp range="monthly" stats_views=0 order_by=views limit=5]');?>
          </div>
          <div class="listthumb">
            <?php echo do_shortcode('[wpp range="monthly" stats_views=0 order_by=views limit=1 thumbnail_width=218 thumbnail_height=218 post_html="<li>{thumb}</li>" );]');?>
          </div>
        </div>
        <?php }else{ ?>
        <div class="morecontent morecontent--green">
          <h2>Lo más leido</h2>
          <div class="list">
            <?php echo do_shortcode('[wpp range="all" stats_views=0 order_by=views limit=5]');?>
          </div>
          <div class="listthumb">
            <?php echo do_shortcode('[wpp range="all" stats_views=0 order_by=views limit=1 thumbnail_width=218 thumbnail_height=218 post_html="<li>{thumb}</li>" );]');?>
          </div>
        </div>
        <?php } ?>

  <?php } ?>
</div>

