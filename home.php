<?php get_header(); 

global $post;

$args = array (
	'post_type' => array(' event'),
  'posts_per_page' => 5
);
$query = new WP_Query( $args );

?>

<div class="flexboxer flexboxer--home">

  <?php if ($query->have_posts()) { ?>

    <section class="wrap wrap--content wrap--content__toframe wrap--flex wrap--transparent">
        <div class="wrap wrap--frame wrap--frame__middle">
          <div class="wrap wrap--logo">
            <a href="<?php bloginfo('url'); ?>">
              <?php if(wp_get_attachment_url(get_theme_mod( 'logo_file', true )) != ''){ ?>
                <img alt="logo" src="<?php echo wp_get_attachment_url(get_theme_mod( 'logo_file', true )); ?>"/>
              <?php } else { ?>
                <img alt="logo" src="<?php echo get_template_directory_uri(); ?>/img/default/logo.png"/>
              <?php } ?>
            </a>
          </div>
        </div>
        <div class="wrap wrap--frame wrap--frame__middle">
            <p class="right">Otro menu</p>
        </div>
    </section>

    <section class="wrap wrap--frame wrap--flex wrap--slider">
      <div class="wrap wrap--frame__treequart">
        <div id="mainslider" class="main-gallery">
          <?php while ($query->have_posts()) { $query->the_post(); ?>
            <div class="gallery-cell">
              <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>" alt="" style="height:360px;" >
            </div>
          <?php }
          $query = new WP_Query( $args );
          ?>
        </div>
      </div>
      <div class="wrap wrap--frame__quart">
        <div class="wrap wrap--frame wrap--eventlist">
        <?php while ($query->have_posts()) { $query->the_post(); ?>
          <div class="wrap wrap--event">
            <?php the_title();?>
          </div>
        <?php } ?>
        </div>
        <div class="button-row">
          <div class="button-group button-group--cells">
<!--             <button class="button is-selected">1</button>
            <button class="button">2</button>
            <button class="button">3</button>
            <button class="button">4</button>
            <button class="button">5</button> -->
          </div>
        </div>
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