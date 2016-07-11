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

  <?php if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) { ?>
    <section class="wrap wrap--frame wrap--author">
      <?php var_dump($_POST);?>
    </section>
  <?php } ?>



<?php include_once(locate_template('templates/forms/form-userdata.php')); ?>

<?php include_once(locate_template('templates/forms/form-authordata.php')); ?>

<?php include_once(locate_template('templates/forms/form-socialdata.php')); ?>

  <?php if($other_user){ 
    $WP_User = new WP_User( $user->ID );
    $roles = array();
    foreach( $WP_User->roles as $role ) {
      $role = get_role( $role );
      if ( $role != null ) array_push($roles, $role->name);// change_role_name($role->name);
    } ?>

    <?php include_once(locate_template('templates/forms/form-asociatedata.php')); ?>
    <?php include_once(locate_template('templates/forms/form-pagedata.php')); ?>


  <?php } ?>

  <section class="wrap wrap--frame wrap--empty">
    <h3 class="more more--section">Add a section</h3>
  </section>

  <section class="wrap wrap--frame wrap--empty wrap--submit">
    <p class="submit">
      <input name="updateuser" type="submit" id="submit-all" class="button button-primary" value="Guardar cambios">
      <input name="action" type="hidden" id="action" value="update-user" />
    </p>
  </section>


<?php }else header('Location: '.site_url().'?action=nologged' ); ?>

</div><!-- end of flexboxer -->
</form>

<?php get_footer(); ?>