  <section class="wrap wrap--content wrap--form wrap--shadow wrap--authordata">
  	<h3 class="title title--section">Datos de asociado</h3>

    <?php wpdc_the_input_text('dbem_dnie', esc_attr(get_the_author_meta('dbem_dnie', $user->ID)), 'DNI', '12345678T');?>
    
    <?php wpdc_the_input_text('bornday', esc_attr(get_the_author_meta('bornday', $user->ID)), 'Fecha de nacimiento', 'TODO');?>

    <?php wpdc_the_input_text('dbem_phone', esc_attr(get_the_author_meta('dbem_phone', $user->ID)), 'Teléfono', 'TODO');?>

    <?php wpdc_the_input_text('dbem_address', esc_attr(get_the_author_meta('dbem_address', $user->ID)), 'Dirección', 'TODO');?>

    <?php wpdc_the_input_text('titulacion', esc_attr(get_the_author_meta('titulacion', $user->ID)), 'Estudios', '');?>

    <?php wpdc_the_input_text('centro_de_estudios', esc_attr(get_the_author_meta('centro_de_estudios', $user->ID)), 'Centro de estudios', '');?>

  </section>