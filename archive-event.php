<?php

get_header(); 

$pagec = $_GET['pag'] == '' ? '1' : $_GET['pag'];
$post_per_page = get_option( 'posts_per_page', '10' );

$args = array (
  'order' => 'DESC',
  'posts_per_page' => -1,
  'post_type' => 'event'
);
$post_count_query = new wp_query( $args );
$post_count = $post_count_query->found_posts;
$total_post = $post_count ? count($post_count) : 1;
$total_pages = 1;
$offset = $post_per_page * ($pagec - 1);
$total_pages = ceil($total_post / $post_per_page);
$args = array( 
  'order' => 'DESC',
  'posts_per_page' => $post_per_page,
  'offset'    => $offset,
  'post_type' => 'event'
);
$wp_query = new wp_query( $args );

?>

<script>
  jQuery(document).ready(function($) {
/* var container = document.querySelector('#usermain');
        var msnry = new Masonry( container, {
          columnWidth: 5,
          itemSelector: '.masonry',
          isAnimated: true,
          animationOptions: {
            duration: 400,
            easing: 'linear',
            queue: false
          }
        });*/
        console.log();

        var ias = $.ias({
          container: "#flexborexarchiveevents",
          item: ".wrap--article",
          pagination: ".navigation",
          next: "a.next"
        });   

        ias.on('render', function(items) {
          $(items).css({ opacity: 0 });
        });

        ias.on('rendered', function(items) {
          $('.js-imagefill').imagefill();
          beautydate();
          $(items).css({ opacity: 1 });
        });  

        ias.extension(new IASSpinnerExtension());            // shows a spinner (a.k.a. loader)
        ias.extension(new IASTriggerExtension({offset: 3})); // shows a trigger after page 3
        ias.extension(new IASNoneLeftExtension({
          text: 'There are no more pages left to load.'      // override text when no pages left
        }));

/*        $(window).scroll(function() {
          if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
            //ias.next();
            alert('100');
        }*/
});
</script>

<!-- flexboxer -->
<div id="flexborexarchiveevents" class="flexboxer flexboxer--archive flexborex--archive__events">

  <section class="wrap wrap--frame wrap--header wrap--flex wrap--transparent">
    <div class="wrap wrap--frame wrap--frame__middle">
      <div class="wrap wrap--logo">
        <a href="<?php bloginfo('url'); ?>">
          <?php if(wp_get_attachment_url(get_theme_mod( 'logo_file', true )) != ''){ ?>
            <img alt="logo" src="<?php echo wp_get_attachment_url(get_theme_mod( 'logo_file', true )); ?>"/>
          <?php } else { ?>
            <img alt="logo" src="<?php echo get_template_directory_uri(); ?>/img/default/logo.png"/>
          <?php } ?>
        </a>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
      </div>
    </div>
    <div class="wrap wrap--frame wrap--frame__middle">
        <p class="right">Otro menu</p>
        <div class="wrap wrap--frame wrap--social">
          <?php the_svg_icon('twitter'); ?>
          <?php the_svg_icon('facebook'); ?>
          <?php the_svg_icon('instagram'); ?>
        </div>
    </div>
  </section>

  <section class="wrap wrap--content wrap--transparent wrap--titlesection">
    <h3>Eventos</h3>
  </section>

  <?php if (have_posts()) : while (have_posts()) : the_post();
    include(locate_template('templates/loops/loop-event.php'));
  endwhile; endif; ?>

</div><!-- end of flexboxer -->

<!-- navigation -->
<div class="navigation">
  <?php $base = get_bloginfo( 'url' ). '%_%';
  echo paginate_links( array(
    'base' => $base,
    'total' => $wp_query->max_num_pages,
    'format'   => '/events/?pag=%#%',
    'current'  => $pagec,
  )); ?>
</div><!-- end of navigation -->

<?php get_footer(); ?>