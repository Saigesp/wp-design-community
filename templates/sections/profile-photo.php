<?php
$user = get_userdata($user->ID);
$usermeta = get_user_meta($user->ID);

if(function_exists('get_wp_user_avatar_src') && get_wp_user_avatar_src($user->ID, 100, 'medium') != '')
    $user_photo = get_wp_user_avatar_src($user->ID, 100, 'medium');
elseif ($user->userphoto_image_file != '')
    $user_photo = get_bloginfo('url').'/wp-content/uploads/userphoto/'.$user->userphoto_image_file;
else
    $user_photo = get_stylesheet_directory_uri().'/img/default/nophoto.png';

?>

<div class="wrap wrap--photo" title="<?php wpdc_the_user_name;?>">
	<a href="<?php echo get_author_posts_url($user->ID);?>">
		<img src="<?php echo $user_photo;?>" alt="<?php wpdc_the_user_name;?> Profile Photo">
	</a>
</div>