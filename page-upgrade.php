<?php get_header(); ?>
<div class="flexboxer flexboxer--page flexboxer--page__upgrade">


<?php if(!is_user_logged_in() && get_option('users_can_register')){?>

	<?php include(locate_template('templates/sections/upgrade-registry.php')); ?>

<?php } elseif(is_user_role('subscriber') && get_option('users_can_asociate')){?>

	<?php include(locate_template('templates/sections/upgrade-asociate.php')); ?>

<?php }elseif(is_user_role('author') || is_user_role('editor') || is_user_role('administrator')){ ?>
	
	<?php include(locate_template('templates/sections/upgrade-payfee.php')); ?>

<?php }else{ ?>

	<?php include(locate_template('templates/sections/404-noinfo.php')); ?>

<?php } ?>



</div>
<?php get_footer();?>