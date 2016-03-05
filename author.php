<?php get_header(); ?> 

<?php 
  $pagec = $_GET['pag'] == '' ? '1' : $_GET['pag'];
  $post_per_page = get_option( 'posts_per_page', '10' );
  $term_slug = get_query_var( 'author' );
  $user_info = get_userdata($term_slug);
?>

<?php
  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'author' => $term_slug,
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
    'author' => $term_slug,
  );
  $wp_query = new wp_query( $args );
?>
<div class="flexboxer flexboxer--author">
  <section class="wrap wrap--content">
      <figure class="authorimagefoot authorbuble" style="background-color: #666;">
        <img src="<?php if(function_exists('get_wp_user_avatar_src') && get_wp_user_avatar_src($term_slug, 100, 'medium') != '')
          echo get_wp_user_avatar_src($term_slug, 100, 'medium');
          else echo get_stylesheet_directory_uri().'/img/default/nophoto.png'; ?>"/>
      </figure>
    <p class="authorarticlefoot">
      <a href="<?php echo get_author_posts_url( $term_slug ); ?>">
        <?php echo get_the_author_meta('first_name', 1) . ' '. get_the_author_meta('last_name', 1); ?>
      </a>
      <br>
      <?php echo get_user_meta($term_slug,position,true);?>
      <br>
      <?php if(get_user_meta($term_slug,twitter,true) != '') { ?>
      <a href="<?php echo 'https://twitter.com/'.get_user_meta($term_slug,twitter,true);?>">
        <?php the_svg_icon('twitter');?>
      </a>
      <?php } ?>
      <?php if(get_user_meta($term_slug,googleplus,true) != '') { ?>
      <a rel="author" href="<?php echo get_user_meta($term_slug,googleplus,true);?>">
        <?php the_svg_icon('gplus');?>
      </a>
      <?php } ?>
      <?php if(get_user_meta($term_slug,linkedin,true) != '') { ?>
      <a href="<?php echo get_user_meta($term_slug,linkedin,true);?>">
        <?php the_svg_icon('linkedin');?>
      </a>
      <?php } ?>
    </p>
    <p class="description"><?php echo $user_info->description;?></p>
  </section><!-- end of author -->
  <section class="wrap wrap--frame">
    <div class="main-gallery js-flickity" data-flickity-options='{ "cellAlign": "left", "contain": true, "freeScroll": true, "wrapAround": true, "imagesLoaded": true }'>
      <div class="gallery-cell"><img src="http://localhost/wp-design-community/wp-content/uploads/2016/02/7716432650_a38ff8068c_h-300x195.jpg" alt=""></div>
      <div class="gallery-cell"><img src="http://localhost/wp-design-community/wp-content/uploads/2016/02/7716432650_a38ff8068c_h-300x195.jpg" alt=""></div>
      <div class="gallery-cell"><img src="http://localhost/wp-design-community/wp-content/uploads/2016/02/7716432650_a38ff8068c_h-300x195.jpg" alt=""></div>
      <div class="gallery-cell"><img src="http://localhost/wp-design-community/wp-content/uploads/2016/02/7716432650_a38ff8068c_h-300x195.jpg" alt=""></div>
    </div>
  </section>
  <section class="wrap wrap--content">
    <p class="description"><?php echo $user_info->description;?></p>
  </section>
</div><!-- end of flexboxer -->

<?php get_footer(); ?>