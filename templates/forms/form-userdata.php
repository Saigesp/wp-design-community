  <section class="wrap wrap--content wrap--author">
		<figure class="wrap wrap--photo wrap--photo__author wrap--photo__block" style="background-color: #666;">
		<img src="<?php
        if(function_exists('get_wp_user_avatar_src') && get_wp_user_avatar_src($user->ID, 100, 'medium') != '')
          echo get_wp_user_avatar_src($user->ID, 100, 'medium');
        elseif ($user->userphoto_image_file != '') 
            echo get_bloginfo('url').'/wp-content/uploads/userphoto/'.$user->userphoto_image_file;
        else
          echo get_stylesheet_directory_uri().'/img/default/nophoto.png'; ?>"/>
		</figure>
		<p class="authorarticlefoot">
		    <input type="text" name="first-name" class="tolisten" value="<?php echo get_user_meta($user->ID,'first_name', 1);?>" placeholder="Nombre">
        <input type="text" name="last-name"  class="tolisten" value="<?php echo get_user_meta($user->ID,'last_name',  1);?>" placeholder="Apellidos">
		  <br>
		  <input type="text" class="tolisten" value="<?php echo get_user_meta($user->ID,position,true);?>" placeholder="Posición"> 
      <br>
      <input type="text" name="email" value="<?php echo esc_attr(get_the_author_meta('email', $user->ID));?>">
		</p>
    	<textarea name="description" class="description js-medium-editor tolisten"><?php echo $user->description;?></textarea>
  </section><!-- end of author -->