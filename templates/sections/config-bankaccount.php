<section id="setbankaccount" class="wrap wrap--content wrap--shadow wrap--form wrap--hidden js-section">
  <h3 class="title title--section">Configuración de cuentas</h3>

  <h3 class="sep">Cuenta bancaria</h3>
  <p class="help help--section">Especifica a los usuarios de tu sitio dónde hacer los ingresos bancarios.</p>
  <?php wpdc_the_input_text('bank_account', '', 'Código cuenta bancaria', 'IBAN ES 01 0123 0123 01 0123456789');?>
  
  <h3 class="sep">Paypal</h3>
  <p class="help help--section">Cuenta donde se harán los ingresos puntuales.</p>
  <?php wpdc_the_input_email('paypal_account', '', 'Email usuario Paypal', 'user@example.com');?>
  
  <?php include(locate_template('templates/sections/section-close.php')); ?>
</section>