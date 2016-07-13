<section id="newconcurso" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section">
  <h3 class="title title--section">Crear concurso</h3>
  <form method="POST" action="">
    <?php wpdc_the_input_text('concurso_name', '', 'Nombre del concurso', 'Nombre del concurso');?>

    <?php wpdc_the_input_text('concurso_org', '', 'Organismo convocante', 'Organismo');?>
    
    <?php wpdc_the_input_text('concurso_bases', '', 'Bases/Más información', 'http://');?>
    
    <?php wpdc_the_input_text('concurso_quantity', '', 'Máximo premio', '3000€, Viaje a Roma...');?>
    
    <?php wpdc_the_input_date('concurso_date', '', 'Cierre de convocatoria');?>

    <?php wpdc_the_input_textarea('description', '', 'Descripción del concurso');?>
    
    <?php wpdc_the_submit('updatesection', 'newconcurso', '', '', 'Crear concurso');?>
  </form>
  <?php include(locate_template('templates/sections/section-close.php')); ?>
</section>