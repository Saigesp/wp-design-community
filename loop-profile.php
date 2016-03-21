<?php
    $op_user = get_user_meta($user->ID, 'op_user', true );
?>

<div class="wrap wrap--user">
  <figure class="wrap wrap--photo">
    <a href="<?php echo get_author_posts_url( $user->ID ); ?>">
      <img src="<?php
      if(function_exists('get_wp_user_avatar_src') && get_wp_user_avatar_src($user->ID, 100, 'medium') != '')
        echo get_wp_user_avatar_src($user->ID, 100, 'medium');
      elseif ($user->userphoto_image_file != '') {
          echo get_bloginfo('url').'/wp-content/uploads/userphoto/'.$user->userphoto_image_file;
      } else
        echo get_stylesheet_directory_uri().'/img/default/nophoto.png'; ?>"/>
      <div class="overflow overflow--black">
        <p>
          <?php if(get_the_author_meta('asociation_position', $user->ID) != '') echo '<strong>'.change_role_name(get_the_author_meta('asociation_position', $user->ID)).'</strong>';?>
          <?php echo '<br>'.get_the_author_meta('first_name', $user->ID).'<br>'.get_the_author_meta('last_name', $user->ID);?>
        </p>
      </div>
    </a>
  </figure>  
</div>
 