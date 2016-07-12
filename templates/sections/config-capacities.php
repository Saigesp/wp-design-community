<?php
$page_permission = [
    "dictator" => "Dictadura",
    "president" => "Presidencia",
    "comrade" => "Comuna",
];

$page_transparency = [
    "dark" => "Opaco",
    "grey" => "Semitransparente",
    "white" => "Transparente",
];

$page_sections = [
    "0" => "Ninguna",
    "concursos" => "Concursos",
    "events" => "Eventos",
    "jobs" => "Ofertas de trabajo",
    "posts" => "Artículos",
];

?>

<section id="capacities" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section">
    <h3 class="title title--section">Gestión de permisos y roles</h3>
    
    <form method="POST" action="">
        <?php /*
        <!-- permisos generales -->
        <h3 class="sep">Permisos</h3>
        <p class="help help--section">Estos permisos determinarán las capacidades de participación de los usuarios en la página.</p>
        <?php wpdc_the_input_select_option('capacity_mode', '', 'Permisos generales', $page_permission);?>

        <!-- transparencia -->
        <h3 class="sep">Transparencia</h3>
        <p class="help help--section">Esta opción determinará el nivel de transparencia en la gestión que se aplicará.</p>
        <?php wpdc_the_input_select_option('transparency_mode', '', 'Transparencia', $page_transparency);?>
        
        <!-- habilitar secciones -->
        <h3 class="sep">Habilitar secciones</h3>
        <p class="help help--section">Las secciones no incluídas no podrán consultarse ni gestionarse, pero su contenido permanecerá intacto.</p>
        <?php wpdc_the_input_select_option('sections_active', '', 'Secciones habilitadas', $page_sections, true);?>
        */?>

        <!-- submit -->
        <?php wpdc_the_submit('updatesection', 'changecapacities', '', '', 'Cambiar permisos');?>
    </form>

    <?php include(locate_template('templates/sections/section-close.php')); ?>
</section>