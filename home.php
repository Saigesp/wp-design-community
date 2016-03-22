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
        include( locate_template(  'templates/loops/loop-archive.php' ));
      }
  	}
  ?>
</div>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div class="flexboxer flexboxer--home">
		<div class="wrap wrap--content">
      <?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>