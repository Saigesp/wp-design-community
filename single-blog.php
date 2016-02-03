<?php get_header(); ?>
<div id="blogmain"  class="main">
  <div class="center twocolumn">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div id="blog-<?php the_ID(); ?>" class="single blog">
        <div id="blogheader-<?php the_ID(); ?>" class="header">
        	<h2><?php the_title();?></h2>
          <p class="info"><?php echo get_the_date();?> | Diseñadoresindustriales.es</p>
        </div>
        <div id="blogbody-<?php the_ID(); ?>" class="body">
        	<?php the_content();?>
        </div>
        <div id="blogfooter-<?php the_ID(); ?>" class="footer">
        </div>
      </div>
    <?php endwhile; else : echo "No hay post"; endif; ?>
  </div>
</div>

<?php get_footer(); ?>