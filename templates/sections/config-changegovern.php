<section id="byemrpresident" class="wrap wrap--content wrap--shadow wrap--form wrap--hidden js-section">

    <h2 class="title title--section">Ceder la presidencia</h2>
    <p class="help help--section">Oh! Siempre te recordaremos como el gran lider que fuiste!</p>

    <!-- nuevo lider -->
    <?php wpdc_the_input_select_user('presidente', '¿Quién será el nuevo lider?', $users, 'asociation_position');?>

    <!-- submit -->
    <?php wpdc_the_submit('updatesection', 'changepresident', 'update-presidence', 'Ceder presidencia');?>
    
    <!-- close -->
    <?php include(locate_template('templates/sections/section-close.php')); ?>

</section>