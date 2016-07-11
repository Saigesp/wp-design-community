<?php get_header(); ?> 

<?php 
	//$user_to_edit = $_GET['id'] == '' ? 'rand' : $_GET['order'];
	$user = $current_user;

	if(is_user_logged_in() && current_user_can( 'edit_users' ) && $_GET['id'] > 0 ) {
		$user_id    = $_GET['id'];
    $user       = get_userdata($user_id);
    $user_meta  = get_user_meta($user_id);
    $op_user    = get_the_author_meta('op_user',$user_id, true);
    $other_user = true;
	}
?>
<form method="post" action="">
<div class="flexboxer flexboxer--author flexboxer--author__edit">
<?php if(is_user_logged_in()){ ?>

  <?php include(locate_template('templates/functions/functions-validation.php')); ?>

  <?php include_once(locate_template('templates/forms/form-userdata.php')); ?>

  <?php include_once(locate_template('templates/forms/form-authordata.php')); ?>

  <?php include_once(locate_template('templates/forms/form-socialdata.php')); ?>

  <?php if($other_user){ ?>

    <?php include_once(locate_template('templates/forms/form-asociatedata.php')); ?>

    <?php include_once(locate_template('templates/forms/form-pagedata.php')); ?>

  <?php } ?>

  <section class="wrap wrap--frame wrap--transparent">
    <h3 class="more more--section">Add a section</h3>
  </section>

  <section class="wrap wrap--frame wrap--transparent">
    <?php wpdc_the_submit('updateuser', 'Guardar cambios', 'action', 'update-user', 'Guardar cambios');?>
  </section>


<?php }else header('Location: '.site_url().'?action=nologged' ); ?>

</div><!-- end of flexboxer -->
</form>

<?php get_footer(); ?>