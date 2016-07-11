<section id="newuser" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section">
  <h3 class="title title--section">Nuevo usuario</h3>

  <?php wpdc_the_input_text('user_name', '', 'Nombre de usuario', 'usuario84');?>

  <?php wpdc_the_input_email('user_email', '', 'Email', 'user@email.com');?>
  
  <?php wpdc_the_submit('updateuser', 'Crear usuario', 'new-user', '', 'Crear usuario');?>

  <?php include(locate_template('templates/sections/section-close.php')); ?>
</section>