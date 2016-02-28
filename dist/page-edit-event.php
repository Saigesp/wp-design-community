<?php get_header(); ?> 

<?php 
  $current_user_id = $current_user->ID;
?>

<div class="flexboxer flexboxer--event flexboxer--event__edit">

  <section class="wrap wrap--content">
  	<?php if(is_user_role('author') || is_user_role('editor') || is_user_role('administrator')){?>
		<?php em_event_form(); ?>
	<?php }else header('Location: '.site_url() ); ?>
  </section>


</div><!-- end of flexboxer -->

<?php get_footer(); ?>