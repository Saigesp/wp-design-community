<section id="feeinfo" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section active">
  <h3 class="title title--section">Cuota <?php the_title(); ?></h3>
  <form method="POST" action="">

    <div class="wrap wrap--frame wrap--flex">
      <div class="wrap wrap--frame__middle">
        <p>Fecha: <?php echo get_post_meta(get_the_ID(), 'fee_date', true); ?></p>
      </div>
      <div class="wrap wrap--frame__middle">
        <p>
          <?php
          echo get_post_meta(get_the_ID(), 'fee_quantity', true).' € (';
          if($members_payed[get_current_user_id()] != ''){
            echo 'Abonado '.$members_payed[get_current_user_id()].'';
          }elseif($members_pending[get_current_user_id()] != ''){
            echo 'Pendiente desde '.$members_pending[get_current_user_id()].'';
          }else{
            echo 'Por abonar';
          }
          echo ')';
          ?>
        </p>
      </div>
    </div>

    <?php
    
    ?>

    <?php if($members_pending[get_current_user_id()] == '' && $members_payed[get_current_user_id()] == ''){ ?>
      <h3 class="sep">Abonar cuota</h3>
      <?php
      $pay_options = [
        "transferency" => "Pago mediante transferencia",
        "paypal" => "Pago por paypal",
      ];
      wpdc_the_input_select_option('paymethod', '', 'Método de pago', $pay_options, $multiple = false);
      ?>

      <?php wpdc_the_submit('updatesection', 'payfee', '', '', 'Pagar cuota');?>

    <?php } ?>
  </form>
</section>