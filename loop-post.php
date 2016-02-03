<?php if (have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
<h2 class="">
  <a href="<?php echo get_permalink();?>">
    <?php echo get_the_title();?>
  </a>
</h2>

<p class="">
  <?php echo get_the_date();?>
</p>

<p class="">
  <?php the_excerpt();?>        
</p>
  
<?php wp_reset_postdata(); ?>
<?php endwhile; ?>
<?php else : ?>
<?php endif; ?>