  <section class="wrap wrap--content wrap--form">
  	<h3>Datos del asociado</h3>
  	<div class="wrap wrap--flex">
  		<div class="wrap wrap--frame__middle wrap--flex">
  			<div class="wrap wrap--frame__middle">
  				<label for="position">Fecha de alta</label>
  			</div>
  			<div class="wrap wrap--frame__middle">
          <input type="text">
  			</div>
  		</div>
  		<div class="wrap wrap--frame__middle wrap--flex">
  			<div class="wrap wrap--frame__middle">
  				 <label for="hola">Fecha de baja</label>
  			</div>
  			<div class="wrap wrap--frame__middle">
          <input type="text">
  			</div>
  		</div>
  	</div>
    <div class="wrap wrap--flex">
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="position">Rol</label>
        </div>
        <div class="wrap wrap--frame__middle">
            <select name="roles" class="tolisten">
              <?php foreach (get_my_editable_roles() as $role_name => $role_info){
                if($role_name == 'contributor') continue;
                echo '<option value="'.$role_name.'"';
                if(empty($roles) && $role_name == 'subscriber') echo 'selected';
                if(in_array($role_name, $roles)) echo 'selected';
                echo ' >'.change_role_name($role_name).'</option>';
              } ?>
            </select>
        </div>
      </div>
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
           <?php  if(!in_array('subscriber', $roles)) {?><label for="hola">Estado</label><?php } ?>
        </div>
        <div class="wrap wrap--frame__middle">
          <?php  if(!in_array('subscriber', $roles)) {?>
          <select name="asociation_position" multiple="multiple">
                <option value="" <?php if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == '') echo 'selected';?>>Ninguno</option>
                <option value="fundador" <?php if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == 'fundador') echo 'selected';?>>Socio Fundador</option>
                <option value="presidente" <?php if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == 'presidente') echo 'selected';?>>Presidente</option>
                <option value="vicepresidente" <?php if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == 'vicepresidente') echo 'selected';?>>Vicepresidente</option>
                <option value="tesorero" <?php if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == 'tesorero') echo 'selected';?>>Tesorero</option>
                <option value="secretario" <?php if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == 'secretario') echo 'selected';?>>Secretario</option>
                <option value="vocal" <?php if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == 'vocal') echo 'selected';?>>Vocal</option>
          </select>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>