<?php
  $cont = 0;
  $args = array (
    'order' => 'DESC',
    'posts_per_page' => 5,
  );
  $query_mas = new WP_Query( $args );
?>

<div id="masonrywrap" class="masonrycontainer">
 <?php if ($query_mas->have_posts()) : ?>
    <?php while ($query_mas->have_posts()) : $query_mas->the_post(); ?>
      <div class="masonryitem <?php echo ($cont == 0) ? 'masonrysizer2' : 'masonrysizer';?>">
        <article id="archiclemasonry-<?php the_ID(); ?>" class="articlemasonry">
          <?php  if ( has_post_thumbnail() ) { ?>
            <figure id="masonry-thumbmasonry-<?php the_ID(); ?>" class="thumbmasonry <?php echo ($cont == 0) ? 'masonrysizer2' : 'masonrysizer';?>">
              <a href="<?php the_permalink() ?>">
                <div class="overflow overflow--blend overflow--blue"></div>
                <!-- <div class="overflow overflow--black"></div> -->
                <?php the_post_thumbnail('medium');  ?>
              </a>
            </figure>
            <section id="masonry-section-<?php the_ID(); ?>" class="sectionarch">
              <div class="categoryarch">
                <p><?php the_category(', ');?></p>
              </div>
              <div id="masonry-header-<?php the_ID(); ?>" class="headerarch">
                <header id="masonry-title-<?php the_ID(); ?>" class="titlearch">
                  <h2 class="titletextarch titletextmasonry" ><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                </header>
              </div>
              <div class="contentauthor">
                <p class="authorarch"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></p>
                <p class="datearch"><?php echo get_the_date();?></p>
              </div>
            </section>
          <?php }  ?>
        </article>
      </div>
    <?php
      $cont++;
      endwhile;
    ?>
  <?php else : ?>
  <?php
    endif;
    wp_reset_postdata();
  ?>
</div>