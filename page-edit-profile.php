<?php get_header(); ?> 

<?php 
  global $current_user;
  $current_user_id = $current_user->ID;
?>

<div class="flexboxer flexboxer--author">
  <section class="wrap wrap--author">
  	<form action="">
		<figure class="authorimagefoot authorbuble" style="background-color: #666;">
		<img src="<?php if(function_exists('get_wp_user_avatar_src') && get_wp_user_avatar_src($current_user_id, 100, 'medium') != '')
		  echo get_wp_user_avatar_src($current_user_id, 100, 'medium');
		  else echo get_stylesheet_directory_uri().'/img/default/nophoto.png'; ?>"/>
		</figure>
		<p class="authorarticlefoot">
		  <a href="<?php echo get_author_posts_url( $current_user_id ); ?>">
		    <?php echo get_user_meta($current_user_id,'first_name', 1) . ' '. get_user_meta($current_user_id,'last_name', 1); ?>
		  </a>
		  <br>
		  <?php echo get_user_meta($current_user_id,position,true);?>
		  <br>
		  <?php if(get_user_meta($current_user_id,twitter,true) != '') { ?>
		  <a href="<?php echo 'https://twitter.com/'.get_user_meta($current_user_id,twitter,true);?>">
		    <?php the_svg_icon('twitter');?>
		  </a>
		  <?php } ?>
		  <?php if(get_user_meta($current_user_id,googleplus,true) != '') { ?>
		  <a rel="author" href="<?php echo get_user_meta($current_user_id,googleplus,true);?>">
		    <?php the_svg_icon('gplus');?>
		  </a>
		  <?php } ?>
		  <?php if(get_user_meta($current_user_id,linkedin,true) != '') { ?>
		  <a href="<?php echo get_user_meta($current_user_id,linkedin,true);?>">
		    <?php the_svg_icon('linkedin');?>
		  </a>
		  <?php } ?>
		</p>
    	<textarea class="description js-medium-editor"><?php echo $current_user->description;?></textarea>
    </form>
  </section><!-- end of author -->

  <section class="wrap wrap--slider">
    <div class="main-gallery js-flickity" data-flickity-options='{ "cellAlign": "left", "contain": true, "freeScroll": true, "wrapAround": true, "imagesLoaded": true }'>
      <div class="gallery-cell"><img src="http://localhost/wp-design-community/wp-content/uploads/2016/02/7716432650_a38ff8068c_h-300x195.jpg" alt=""></div>
      <div class="gallery-cell"><img src="http://localhost/wp-design-community/wp-content/uploads/2016/02/7716432650_a38ff8068c_h-300x195.jpg" alt=""></div>
      <div class="gallery-cell"><img src="http://localhost/wp-design-community/wp-content/uploads/2016/02/7716432650_a38ff8068c_h-300x195.jpg" alt=""></div>
      <div class="gallery-cell"><img src="http://localhost/wp-design-community/wp-content/uploads/2016/02/7716432650_a38ff8068c_h-300x195.jpg" alt=""></div>
    </div>
  </section>
  <section class="wrap wrap--cv">
    <p class="description"><?php echo $current_user->description;?></p>
  </section>

</div><!-- end of flexboxer -->

<?php get_footer(); ?>