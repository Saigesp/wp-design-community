<section id="feeinfo" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section active">
  <h3 class="title title--section">Cuota <?php the_title(); ?></h3>
  <div class="wrap wrap--frame wrap--flex">
    <div class="wrap wrap--frame__middle">
      <p><strong>Inicio:</strong> <?php echo get_post_meta(get_the_ID(), 'fee_date_start', true); ?><br>
      <strong>Fin:</strong> <?php echo get_post_meta(get_the_ID(), 'fee_date_end', true); ?></p>
    </div>
    <div class="wrap wrap--frame__middle">
      <p><strong>Cantidad:</strong> <?php echo get_post_meta(get_the_ID(), 'fee_quantity', true).' €';?><br>
         <strong>Estado:</strong>
        <?php
        if($members_payed[get_current_user_id()] != ''){
          echo 'Abonado '.$members_payed[get_current_user_id()].'';
        }elseif($members_pending[get_current_user_id()] != ''){
          echo 'Pendiente desde '.$members_pending[get_current_user_id()].'';
        }else{
          echo 'Por abonar';
        }
        ?>
      </p>
    </div>
  </div>
  <div class="wrap wrap--frame">
    <?php echo html_entity_decode(get_option("text_asociate_payfee")); ?>
    </div>

    <?php if($members_pending[get_current_user_id()] == '' && $members_payed[get_current_user_id()] == ''){ ?>
      <h3 class="sep">Abonar cuota</h3>

      <?php
      $pay_options = [
        "" => "Selecciona método de pago",
        "transferency" => "Pago mediante transferencia",
        "paypal" => "Pago por paypal",
      ];
      wpdc_the_input_select_option('paymethod', '', 'Método de pago', $pay_options, false, false, 'paymethod');
      ?>

      <?php if(get_option('bank_account') != ''){ ?> 
        <div id="js-select-transferency" class="wrap wrap--frame wrap--hidden js-select js-select-paymethod">
          <form method="POST" action="">
            <p>Cuenta donde realizar el ingreso bancario: <strong><?php echo get_option('bank_account');?></strong></p>
            <?php echo html_entity_decode(get_option("text_asociate_payfee_banks"));?>
            <input type="hidden" name="paymethod" value="transferency">
            <?php wpdc_the_submit('updatesection', 'payfee', '', '', 'Pagar cuota');?>
          </form>
        </div>      
      <?php } ?>

      <?php if(get_option('paypal_account') == ''){ ?> 
        <div id="js-select-paypal" class="wrap wrap--frame wrap--hidden js-select js-select-paymethod">
          <form method="POST" action="https://www.paypal.com/cgi-bin/webscr" target="_top">
            <p>Pago mediante PayPal</p>
            <input type="hidden" name="paymethod" value="paypal">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="<?php echo get_option('paypal_button_fee');?>">
            <?php wpdc_the_submit('updatesection', 'payfee', '', '', 'Pagar con Paypal');?>
          </form>
        </div>     
      <?php } ?>
      

    <?php } ?>
</section>