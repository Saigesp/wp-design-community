<?php get_header(); 

global $post;

$args = array (
	'post_type' => array( 'post', ' event' ),
);
$query = new WP_Query( $args );

?>

<div class="flexboxer flexboxer--home">

  <?php if ($query->have_posts()) { ?>

    <section class="wrap wrap--frame">
      <div class="main-gallery js-flickity" data-flickity-options='{ "cellAlign": "left", "contain": true, "freeScroll": true, "wrapAround": true, "imagesLoaded": true }'>
        <?php while ($query->have_posts()) { $query->the_post(); ?>
          <div class="gallery-cell">
            <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>" alt="" style="height:300px">
          </div>
        <?php } ?>
      </div>
    </section>

  <?php } ?>
  <?php
  $query = new WP_Query( $args );
  if ($query->have_posts()) {
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