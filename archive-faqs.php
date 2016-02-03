<?php get_header(); ?>

<?php include( locate_template(  'menu-faqs.php' )); ?>

<?php
$args = array (
	'post_type'              => 'faqs',
	'order'                  => 'ASC',
	'orderby'                => 'title',
);
$query = new WP_Query( $args );
?>
<div id ="faqmain" class="main">
  <div id="lateral">
    <div class="faqlist">
      <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <h3><a href="#faq<?php echo get_the_ID();?>"><?php the_title(); ?></a></h3> 
      <?php endwhile; endif; ?>
    </div>
  </div>
  <div id ="central">
  <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
    <div class="archive faq">
        <a id="faq<?php echo get_the_ID();?>"></a><h3><a href="#faq<?php echo get_the_ID();?>"><?php the_title(); ?></a>
      <?php if(is_user_role('administrator') || is_user_role('editor')){?>  <a href="<?php echo get_edit_post_link(get_the_ID()); ?>"><?php the_svg_icon("edit");?></a><?php } ?></h3>
        <?php the_content();?>
    </div>
  <?php endwhile; endif; ?>
  </div>
</div>

<?php get_footer(); ?>