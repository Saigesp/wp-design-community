<section class="wrap wrap--content wrap--form wrap--shadow">
  <h3 class="title title--section">Datos del asociado</h3>

  <?php wpdc_the_input_date('asociate_up_date', '', 'Fecha de alta');?>

  <?php wpdc_the_input_date('asociate_down_date', '', 'Fecha de baja');?>

  <?php wpdc_the_input_select_role('roles', 'Tipo de usuario');?>

  <?php
  $charge_array = ['', 'vicepresidente', 'tesorero', 'secretario', 'vocal'];
  wpdc_the_input_select_position('asociation_position', 'Cargo organizativo', $charge_array);
  ?>

  <?php
  $charge_array = ['', 'rp_events', 'rp_concursos', 'rp_jobs', 'rp_posts'];
  wpdc_the_input_select_position('responsability', 'Responsable de área', $charge_array);
  ?>

  <?php
  $opt_array = [ 'false'=> 'No', 'true'=> 'Si', ];
  wpdc_the_input_select_option('fundator', '', 'Socio fundador', $opt_array);
  ?>

</section>