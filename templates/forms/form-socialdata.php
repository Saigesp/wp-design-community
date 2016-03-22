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
          <label for="googleplus">Google+</label>
        </div>
        <div class="wrap wrap--frame__middle">
          <input type="text" name="googleplus" class="tolisten" value="<?php echo get_user_meta($user->ID,googleplus,true);?>">
        </div>
      </div>
    </div>
    <div class="wrap wrap--flex">
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="behance">Behance</label>
        </div>
        <div class="wrap wrap--frame__middle">
        <input type="text" name="behance" class="tolisten" value="<?php echo get_user_meta($user->ID,behance,true);?>"/>
        </div>
      </div>
      <div class="wrap wrap--frame__middle wrap--flex">
        <div class="wrap wrap--frame__middle">
          <label for="domestika">Domestika</label>
        </div>
        <div class="wrap wrap--frame__middle">
          <input type="text" name="domestika" class="tolisten" value="<?php echo get_user_meta($user->ID,domestika,true);?>">
        </div>
      </div>
    </div>
  </section>