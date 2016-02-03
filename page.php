<?php get_header(); ?>

<?php if (get_field('pagemenu') == 'faqs') include( locate_template(  'menu-faqs.php' )); ?>

<div id="pagemain"  class="main">
  <div class="center twocolumn">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div id="page-<?php the_ID(); ?>" class="single page">
        <div id="pageheader-<?php the_ID(); ?>" class="header">
        	<h2><?php the_title();?></h2>
        </div>
        <div id="pagebody-<?php the_ID(); ?>" class="body">
        	<?php the_content();?>
        </div>
        <div id="pagefooter-<?php the_ID(); ?>" class="footer">
        </div>
      </div>
    <?php endwhile; else : echo "No hay post"; endif; ?>
  </div>
</div>

<?php get_footer(); ?>