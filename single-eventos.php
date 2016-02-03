<?php
get_header();
if (have_posts()) : while (have_posts()) : the_post();
header ("Location: ".get_field('enlace'));
endwhile; endif;
get_footer();
?>