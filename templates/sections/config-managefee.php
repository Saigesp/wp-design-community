<section id="managefee" class="wrap wrap--content wrap--shadow wrap--form js-section wrap--hidden">
  <h3 class="title title--section">Pagos de <?php the_title();?></h3>
  <form method="POST" action="" class="">

    <h3 class="sep"><?php if(get_post_meta(get_the_ID(), 'members_payed', true) != '') echo sizeof(get_post_meta(get_the_ID(), 'members_payed', true)); else echo '0';?> Socios con la cuota abonada</h3>
    <ul class="list list--userlist">
      <?php foreach($members_payed as $user_id => $time){
        $user = get_userdata($user_id);
        ?>
        <li class="item wrap wrap--frame wrap--flex">
          <div class="wrap wrap--frame wrap--frame__45">
              <?php wpdc_the_profile_photo($user_id);?>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
              <?php wpdc_the_user_name($user->ID);?>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
              <?php echo get_user_meta($user->ID, 'asociation_status', true); ?>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
          </div>
          <div class="wrap wrap--frame wrap--frame__fifth wrap--checkbox">
            <input type="checkbox" id="checkbox-pay-<?php echo $user_id;?>" name="members_paydown[]" value="<?php echo $user_id;?>"/>
            <label for="checkbox-pay-<?php echo $user_id;?>" class="remove"></label>
          </div>
        </li>
      <?php } ?>
    </ul>

    <?php wpdc_the_input_select_user_payed_fee('members_payed', 'Añadir abono (confirmado)', $asociates->results, true);?>

    <h3 class="sep"><?php if(get_post_meta(get_the_ID(), 'members_pending', true) != '') echo sizeof(get_post_meta(get_the_ID(), 'members_pending', true)); else echo '0';?> Socios con la cuota pendiente de validar</h3>
    <ul class="list list--userlist">
      <?php foreach($members_pending as $user_id => $time){
        $user = get_userdata($user_id);
        ?>
        <li class="item wrap wrap--frame wrap--flex">
          <div class="wrap wrap--frame wrap--frame__45">
              <?php wpdc_the_profile_photo($user->ID);?>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
              <?php wpdc_the_user_name($user->ID);?>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
              <?php echo get_user_meta($user->ID, 'asociation_status', true); ?>
          </div>
          <div class="wrap wrap--frame wrap--frame__fourth">
          </div>
          <div class="wrap wrap--frame wrap--frame__fifth wrap--checkbox">
            <input type="checkbox" id="checkbox-topay-<?php echo $user_id;?>" name="members_validate[]" value="<?php echo $user_id;?>"/>
            <label for="checkbox-topay-<?php echo $user_id;?>"></label>
            <input type="checkbox" id="checkbox-pay-<?php echo $user_id;?>" name="members_pendingdown[]" value="<?php echo $user_id;?>"/>
            <label for="checkbox-pay-<?php echo $user_id;?>" class="remove"></label>
          </div>
        </li>
      <?php } ?>
    </ul>

    <?php wpdc_the_input_select_user_payed_fee('members_pending', 'Añadir abono (pendientes)', $asociates->results, true);?>

    <h3 class="sep"><?php if(get_post_meta(get_the_ID(), 'members_pending', true) != '') echo sizeof(get_post_meta(get_the_ID(), 'members_pending', true)); else echo '0';?> Socios pendientes de pago</h3>
           
    <?php wpdc_the_submit('updatesection', 'updatefee', '', '', 'Actualizar cuota');?>

  </form>
</section>