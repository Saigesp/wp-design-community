<section id="newconcurso" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section">
  <h3 class="title title--section">Crear concurso</h3>

  <?php wpdc_the_input_text('concurso_name', '', 'Nombre del concurso', 'Nombre del concurso');?>

  <?php wpdc_the_input_text('concurso_org', '', 'Organismo convocante', 'Organismo');?>
  
  <?php wpdc_the_input_text('concurso_bases', '', 'Bases/Más información', 'http://');?>
  
  <?php wpdc_the_input_text('concurso_quantity', '', 'Máximo premio', '3000€, Viaje a Roma...');?>
  
  <?php wpdc_the_input_text('concurso_date', '', 'Cierre de convocatoria', '--->TODO');?>

  <div class="wrap wrap--flex">
    <textarea name="description" class="description js-medium-editor tolisten"><?php echo $user->description;?></textarea>
  </div>
  
  <?php wpdc_the_submit('updatefee', 'Crear concurso', 'new-concurso', '', 'Crear concurso');?>

  <?php include(locate_template('templates/sections/section-close.php')); ?>
</section>