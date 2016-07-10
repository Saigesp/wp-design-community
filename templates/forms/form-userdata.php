  <section class="wrap wrap--content wrap--author">
		<?php the_profile_photo($user);?>
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