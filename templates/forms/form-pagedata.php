  <section class="wrap wrap--content wrap--form">
  	<h3>Datos del usuario</h3>
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