<?php get_header(); 

global $post;

$args = array (
	'post_type' => array('event', 'post', 'concursos'),
  'posts_per_page' => 6,
);
$slider_query = new WP_Query( $args );
?>


  <?php if (get_option('show_slider')) { ?>
    <?php if ($slider_query->have_posts() && get_option('show_slider')) { ?>
      <div class="flexboxer flexboxer--full js-showonload js-showonload-active">
        <section class="wrap wrap--fullwidth wrap--slider">
          <div id="mainslider" class="main-gallery">
            <?php while ($slider_query->have_posts()) { $slider_query->the_post(); ?>
              <div class="gallery-cell">
                <img src="<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); echo $thumb[0];?>" alt="" style="height:360px;">
              </div>
            <?php } ?>
          </div>
        </section>
      </div>
    <?php } ?>
  <?php } ?>

<div class="flexboxer flexboxer--home">

  <?php if (get_option('show_text_about_us')) { ?>
    <section class="wrap wrap--content wrap--shadow">
      <?php echo html_entity_decode(get_option('text_about_us'));?>
      <?php
      $original_query = $wp_query;
      $args = array( 
          'exclude' => array( 1 ),
          'role' => 'author',
          'orderby' => 'rand',
          'number' => 999,
      );
      $user_query = new WP_User_Query($args); ?>
      <?php if (!empty( $user_query->results)) { ?>
        <div class="wrap wrap--masonry <?php if ($user_query->results > 30) echo ' wrap--masonry__50 ' ?> <?php if ($user_query->results > 100) echo 'wrap--masonry__100' ?> ">
          <?php 
          $cont = 0;
          $limit = 11;
          foreach ( $user_query->results as $user ) {
            if($cont >= $limit) continue;
            $have_photo = false;
            if(function_exists('get_wp_user_avatar_src') && get_wp_user_avatar_src($user->ID, 100, 'medium') != '') $have_photo = true;
            elseif ($user->userphoto_image_file != '') $have_photo = true;
            if(!$have_photo) continue;
            wpdc_the_profile_photo($user);
            $cont++;
          }
          if(get_option('users_can_asociate')){ ?>
            <div class="wrap wrap--photo wrap--photo__upgrade" title="">
              <a href="<?php echo site_url('upgrade');?>">Asóciate</a>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </section>
  <?php } ?>

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

    <section class="wrap wrap--content wrap--transparent wrap--titlesection wrap--spaced wrap--spaced__top">
      <h3>Últimas actividades</h3>
    </section>

    <?php while ($query->have_posts()) { 
      $query->the_post();
      include( locate_template(  'templates/loops/loop-event.php' ));
    }
	}
  ?>

</div>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div class="flexboxer flexboxer--home">
		<div class="wrap wrap--content wrap--transparent">
      <?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>