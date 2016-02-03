<?php get_header(); ?>

<?php include( locate_template(  'menu-faqs.php' )); ?>

<div id="faqmain"  class="main">
  <div class="center twocolumn">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div id="faq-<?php the_ID(); ?>" class="single faq">
        <div class="header">
        	<h2><?php the_title();?></h2>
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