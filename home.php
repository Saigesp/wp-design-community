<?php get_header(); 

global $post;

$args = array (
	'post_type' => array( 'post', ' event' ),
);
$query = new WP_Query( $args );

?>

<div class="flexboxer flexboxer--home">
  <?php if ($query->have_posts()) {
      while ($query->have_posts()) { 
        $query->the_post();
        include( locate_template(  'loop-archive.php' ));
      }
  	}
  ?>
</div>
<?php get_footer(); ?>