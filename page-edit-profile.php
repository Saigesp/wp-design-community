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

  <?php include(locate_template('functions-validation.php')); ?>

  <?php if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) { ?>
    <section class="wrap wrap--frame wrap--author">
      <?php var_dump($_POST);?>
    </section>
  <?php } ?>





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
		</p>
    	<textarea name="description" class="description js-medium-editor tolisten"><?php echo $user->description;?></textarea>
  </section><!-- end of author -->

  <section class="wrap wrap--content wrap--form wrap--authordata">
  	<h3>Datos personales</h3>
  	<div class="wrap wrap--flex">
  		<div class="wrap wrap--frame__middle wrap--flex">
  			<div class="wrap wrap--frame__middle">
  				<label for="dbem_dnie">DNI</label>
  			</div>
  			<div class="wrap wrap--frame__middle">
				<input type="text" name="dbem_dnie" class="tolisten" value="<?php echo esc_attr(get_the_author_meta('dbem_dnie', $user->ID));?>"/>
  			</div>
  		</div>
  		<div class="wrap wrap--frame__middle wrap--flex">
  			<div class="wrap wrap--frame__middle">
  				<label for="dbem_address">Dirección</label>
  			</div>
  			<div class="wrap wrap--frame__middle">
				<input type="text" name="dbem_address" class="tolisten" value="<?php echo esc_attr(get_the_author_meta('dbem_address', $user->ID));?>"/>
  			</div>
  		</div>
  	</div>
  	<div class="wrap wrap--flex">
  		<div class="wrap wrap--frame__middle wrap--flex">
  			<div class="wrap wrap--frame__middle">
  				<label for="dbem_phone">Teléfono</label>
  			</div>
  			<div class="wrap wrap--frame__middle">
				<input type="text" name="dbem_phone" class="tolisten" value="<?php echo esc_attr(get_the_author_meta('dbem_phone', $user->ID));?>"/>
  			</div>
  		</div>
  		<div class="wrap wrap--frame__middle wrap--flex">
  			<div class="wrap wrap--frame__middle">
  				<label for="hola">Email</label>
  			</div>
  			<div class="wrap wrap--frame__middle">
  				<input type="text" name="email" class="tolisten" value="<?php echo esc_attr(get_the_author_meta('email', $user->ID));?>">
  			</div>
  		</div>
  	</div>
  </section>

  <section class="wrap wrap--content wrap--form wrap--authornetworks">
    <h3>Redes sociales</h3>
    <div class="wrap wrap--flex">
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="facebook">Facebook</label>
        </div>
        <div class="wrap wrap--frame__middle">
        <input type="text" name="facebook" class="tolisten" value="<?php echo get_user_meta($user->ID,facebook,true);?>"/>
        </div>
      </div>
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="dbem_address">Twitter</label>
        </div>
        <div class="wrap wrap--frame__middle">
        <input type="text" name="twitter" class="tolisten" value="<?php echo get_user_meta($user->ID,twitter,true);?>"/>
        </div>
      </div>
    </div>
    <div class="wrap wrap--flex">
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="linkedin">Linkedin</label>
        </div>
        <div class="wrap wrap--frame__middle">
        <input type="text" name="linkedin" class="tolisten" value="<?php echo get_user_meta($user->ID,linkedin,true);?>"/>
        </div>
      </div>
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="hola">Google+</label>
        </div>
        <div class="wrap wrap--frame__middle">
          <input type="text" name="googleplus" class="tolisten" value="<?php echo get_user_meta($user->ID,googleplus,true);?>">
        </div>
      </div>
    </div>
  </section>

  <?php if($other_user){ 
    $WP_User = new WP_User( $user->ID );
    $roles = array();
    foreach( $WP_User->roles as $role ) {
      $role = get_role( $role );
      if ( $role != null ) array_push($roles, $role->name);// change_role_name($role->name);
    } ?>
  <section class="wrap wrap--content wrap--form">
  	<h3>Datos del asociado</h3>
  	<div class="wrap wrap--flex">
  		<div class="wrap wrap--frame__middle wrap--flex">
  			<div class="wrap wrap--frame__middle">
  				<label for="position">Rol</label>
  			</div>
  			<div class="wrap wrap--frame__middle">
		        <select name="asociation_position" class="tolisten">
              <?php foreach (get_editable_roles() as $role_name => $role_info){
                if($role_name == 'contributor') continue;
                echo '<option value="'.$role_name.'">'.change_role_name($role_name).'</option>';
              } ?>
		        </select>
  			</div>
  		</div>
  		<div class="wrap wrap--frame__middle wrap--flex">
  			<div class="wrap wrap--frame__middle">
  				<label for="hola">Estado</label>
  			</div>
  			<div class="wrap wrap--frame__middle">
  				<select name="status" id="" class="tolisten">
              <option value="">Suspendido</option>
              <option value="">Registrado</option>
              <option value="">Pendiente de validar</option>
              <option value="">Validado</option>    
          </select>
  			</div>
  		</div>
  	</div>
    <div class="wrap wrap--flex">
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="dbem_phone">Fecha de registro</label>
        </div>
        <div class="wrap wrap--frame__middle">
        <p><?php echo date('d M Y H:i', strtotime($user->user_registered));?></p>
        </div>
      </div>
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="hola">Último login</label>
        </div>
        <div class="wrap wrap--frame__middle">
          <p><?php if(get_last_login($user->ID) != '') echo date('d M Y H:i', strtotime(get_last_login($user->ID)));?></p>
        </div>
      </div>
    </div>
    <div class="wrap wrap--flex">
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="dbem_phone">Karma</label>
        </div>
        <div class="wrap wrap--frame__middle">
        <input type="number" steps="1" name="karma" class="tolisten" value="<?php echo $op_user['karma'];?>"/>
        </div>
      </div>
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="hola">Invitaciones</label>
        </div>
        <div class="wrap wrap--frame__middle">
          <input type="number" steps="1" name="invitations" class="tolisten" value="<?php echo $op_user['invitations'];?>">
        </div>
      </div>
    </div>
  </section>

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

  <section class="wrap wrap--frame">
    <?php var_dump($user->user_registered);?>
  </section>



<?php }else header('Location: '.site_url().'?action=nologged' ); ?>

</div><!-- end of flexboxer -->
</form>

<?php get_footer(); ?>