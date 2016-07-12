<section id="byemrpresident" class="wrap wrap--content wrap--shadow wrap--form wrap--hidden js-section">
    <h3 class="title title--section">Ceder la presidencia</h3>
    <p class="help help--section">Oh! Siempre te recordaremos como el gran lider que fuiste!</p>

	<form method="POST" action="">
	    <!-- nuevo lider -->
	    <?php wpdc_the_input_select_user('presidente', '¿Quién será el nuevo lider?', $users, 'asociation_position');?>

	    <!-- submit -->
	    <?php wpdc_the_submit('updatesection', 'changepresident', '', '', 'Ceder presidencia');?>
    </form>
    
    <!-- close -->
    <?php include(locate_template('templates/sections/section-close.php')); ?>

</section>