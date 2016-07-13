<section id="doclist" class="wrap wrap--content wrap--shadow wrap--doclist js-section wrap--hidden">
    <h3 class="title title--section">Documentos</h3>


    
   <?php if($documents->have_post()){ ?>
        <h3 class="sep">Listado de documentos</h3>
        <ul class="list">
            <?php while ($documents->have_posts()) { $documents->the_post(); ?>

                <li class="item wrap wrap--frame wrap--flex">
                    <div class="wrap wrap--frame wrap--frame__fourth">

                    </div>
                    <div class="wrap wrap--frame wrap--frame__fourth">

                    </div>
                    <div class="wrap wrap--frame wrap--frame__fourth">

                    </div>
                    <div class="wrap wrap--frame wrap--frame__fourth">

                    </div>
                </li>
            <?php } ?>
        </ul>
    <?php }else{
        echo '<p>Todavía no hay documentos subidos que mostrar.</p>';
    }   ?>

    <?php wp_reset_query();?>

    <!-- close -->
    <?php include(locate_template('templates/sections/section-close.php')); ?>

</section>