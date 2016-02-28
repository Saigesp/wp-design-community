<?php get_header(); ?> 

<?php 
  $current_user_id = $current_user->ID;
?>

<div class="flexboxer flexboxer--author flexboxer--author__edit">
<?php if(is_user_logged_in()){ ?>

  <section class="wrap wrap--content wrap--author">
  	<form action="">
		<figure class="authorimagefoot authorbuble" style="background-color: #666;">
		<img src="<?php if(function_exists('get_wp_user_avatar_src') && get_wp_user_avatar_src($current_user_id, 100, 'medium') != '')
		  echo get_wp_user_avatar_src($current_user_id, 100, 'medium');
		  else echo get_stylesheet_directory_uri().'/img/default/nophoto.png'; ?>"/>
		</figure>
		<p class="authorarticlefoot">
		    <input type="text" value="<?php echo get_user_meta($current_user_id,'first_name', 1);?>" placeholder="Nombre"> <input type="text" value="<?php echo get_user_meta($current_user_id,'last_name', 1); ?>" placeholder="Apellidos">
		  <br>
		  <input type="text" value="<?php echo get_user_meta($current_user_id,position,true);?>" placeholder="Posición"> 
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
    	<input type="submit" value="Guardar" class="button button--submit">
    </form>
  </section><!-- end of author -->

  <section class="wrap wrap--frame">
    <div class="main-gallery js-flickity" data-flickity-options='{ "cellAlign": "left", "contain": true, "freeScroll": true, "wrapAround": true, "imagesLoaded": true }'>
      <div class="gallery-cell"><img src="http://localhost/wp-design-community/wp-content/uploads/2016/02/7716432650_a38ff8068c_h-300x195.jpg" alt=""></div>
      <div class="gallery-cell"><img src="http://localhost/wp-design-community/wp-content/uploads/2016/02/7716432650_a38ff8068c_h-300x195.jpg" alt=""></div>
      <div class="gallery-cell"><img src="http://localhost/wp-design-community/wp-content/uploads/2016/02/7716432650_a38ff8068c_h-300x195.jpg" alt=""></div>
      <div class="gallery-cell"><img src="data:image/jpeg;base64,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" alt=""></div>
    </div>
  </section>

  <section class="wrap wrap--content">
    <p class="description"><?php echo $current_user->description;?></p>
  </section>

  <section class="wrap wrap--frame wrap--empty">
    <h3 class="more more--section">Add a section</h3>
  </section>

<?php }else{ ?>

  <section class="wrap wrap--message wrap--message__mustlogin">
	<p class="description">You must be logged in.</p>
  </section>

<?php } ?>
</div><!-- end of flexboxer -->

<?php get_footer(); ?>