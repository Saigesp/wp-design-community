<?php get_header(); ?>
<div id="menufaqcontainer" class="menudir">
  <img src="http://xn--diseadoresindustriales-nec.es/img/blog.png" title="Diseñadoresindustriales.es Blog" style="width: 100%; max-width: 260px; margin: 0 auto; display: block;"/>
</div>

<div id="blogmain"  class="main">
	<div class="center twocolumn">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    	<div id="blog-<?php the_ID(); ?>" class="archive blog">
        <div id="blogheader-<?php the_ID(); ?>" class="header">
          <h2><?php the_title();?></h2>
          <p class="info"><?php echo get_the_date();?> | Diseñadoresindustriales.es</p>
        </div>
        <div class="body">
          <?php the_content();?>
        </div>
        <div class="footer">
        </div>
      </div>
		<?php endwhile; else : echo "No hay post"; endif; ?>
	</div>
</div>
<?php get_footer(); ?>