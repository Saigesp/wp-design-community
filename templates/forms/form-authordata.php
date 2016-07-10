  <section class="wrap wrap--content wrap--form wrap--authordata">
  	<h3>Datos personales</h3>
  	<div class="wrap wrap--flex">
  		<div class="wrap wrap--frame__middle wrap--flex">
  			<div class="wrap wrap--frame__middle">
  				<label for="dbem_dnie">DNI</label>
  			</div>
  			<div class="wrap wrap--frame__middle">
				<input type="text" name="dbem_dnie" value="<?php echo esc_attr(get_the_author_meta('dbem_dnie', $user->ID));?>"/>
  			</div>
  		</div>
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="hola">Fecha de nacimiento</label>
        </div>
        <div class="wrap wrap--frame__middle">
          <input type="date" name="bornday" value="<?php echo esc_attr(get_the_author_meta('bornday', $user->ID));?>">
        </div>
      </div>
  	</div>
  	<div class="wrap wrap--flex">
  		<div class="wrap wrap--frame__middle wrap--flex">
  			<div class="wrap wrap--frame__middle">
  				<label for="dbem_phone">Teléfono</label>
  			</div>
  			<div class="wrap wrap--frame__middle">
				<input type="text" name="dbem_phone" value="<?php echo esc_attr(get_the_author_meta('dbem_phone', $user->ID));?>"/>
  			</div>
  		</div>
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="dbem_address">Dirección</label>
        </div>
        <div class="wrap wrap--frame__middle">
        <input type="text" name="dbem_address" value="<?php echo esc_attr(get_the_author_meta('dbem_address', $user->ID));?>"/>
        </div>
      </div>
  	</div>
    <div class="wrap wrap--flex">
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="titulacion">Titulación</label>
        </div>
        <div class="wrap wrap--frame__middle">
        <input type="text" name="titulacion" value="<?php echo esc_attr(get_the_author_meta('titulacion', $user->ID));?>"/>
        </div>
      </div>
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="centro_de_estudios">Centro de estudios</label>
        </div>
        <div class="wrap wrap--frame__middle">
          <input type="text" name="centro_de_estudios" value="<?php echo esc_attr(get_the_author_meta('centro_de_estudios', $user->ID));?>">
        </div>
      </div>
    </div>
  </section>