<?php get_header(); 

global $post;

$args = array (
	'post_type' => array('event'),
  'posts_per_page' => 5
);
$query = new WP_Query( $args );

?>

<div class="flexboxer flexboxer--home">

  <section class="wrap wrap--fullwidth wrap--harry">
    <div class="wrap wrap--frame wrap--flex">
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
    </div>
  </section>

  <?php if ($query->have_posts()) { ?>
    <section class="wrap wrap--fullwidth wrap--slider">
      <div id="mainslider" class="main-gallery">
        <?php while ($query->have_posts()) { $query->the_post(); ?>
          <div class="gallery-cell">
            <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>" alt="" style="height:360px;" >
          </div>
        <?php } ?>
      </div>
    </section>
  <?php } ?>

    <section class="wrap wrap--content wrap--transparent wrap--titlesection">
      <h3>Acerca de AEDI</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint odio, veniam possimus et distinctio amet eos suscipit optio, nam nesciunt, facilis labore architecto assumenda minus. Delectus quaerat quibusdam consequuntur tempora?</p>
    </section>

  <?php
  $args = array (
    'post_type' => array('event'),
    'posts_per_page' => 5,
    'offset' => 5
  );
  $query = new WP_Query( $args );

  if ($query->have_posts()) { 
    $article_count = 0;
    ?>

    <section class="wrap wrap--content wrap--transparent wrap--titlesection">
      <h3>Últimas actividades</h3>
    </section>

    <?php while ($query->have_posts()) { 
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