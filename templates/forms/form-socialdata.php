  <section class="wrap wrap--content wrap--form wrap--shadow wrap--authornetworks">
    <h3 class="title title--section">Redes sociales</h3>

    <?php wpdc_the_input_text('facebook', get_user_meta($user->ID,facebook,true), 'Usuario de facebook', 'usuario');?>

    <?php wpdc_the_input_text('twitter', get_user_meta($user->ID,twitter,true), 'Usuario de twitter', 'usuario');?>
    
    <?php wpdc_the_input_text('linkedin', get_user_meta($user->ID,linkedin,true), 'Url de linkedin', 'http://');?>

    <?php wpdc_the_input_text('googleplus', get_user_meta($user->ID,googleplus,true), 'Usuario de Google+', 'usuario');?>

    <?php wpdc_the_input_text('behance', get_user_meta($user->ID,behance,true), 'Usuario de Behance', 'usuario');?>

    <?php wpdc_the_input_text('domestika', get_user_meta($user->ID,domestika,true), 'Usuario de Domestika', 'usuario');?>

  </section>