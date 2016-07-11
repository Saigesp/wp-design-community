<section id="managedocs" class="wrap wrap--content wrap--form wrap--shadow wrap--hidden js-section">
    <h3 class="title title--section">Gestionar documentos</h3>
    
    <!-- document list -->
    <?php if ( $documents->have_posts() ) { ?>
        <h3 class="sep">Listado de documentos</h3>
            <ul class="list">
            <?php while ( $documents->have_posts() ) {
                $documents->the_post();
                $postmeta = get_post_meta($post->ID);
                $old_files = $postmeta['wpcf-docfile'][0];
                $media = get_attached_media( 'application', $post->ID);
                ?>
                <li class="item wrap wrap--flex">
                    <div class="wrap wrap--frame wrap--frame__middle">
                        <?php if($old_files != '') { ?>
                            <a target="_blank" href="<?php echo $old_files; ?>"><?php the_title(); ?></a>
                        <?php }else{ 
                            if(count($media) > 1){
                                the_title();
                                $filesnum = 0;
                                foreach($media as $media_id){
                                    $filesnum++;
                                    echo ' <a target="_blank" href="'.$media_id->guid.'" title="'.$media_id->post_name.'">[Doc'.$filesnum.']</a> ';
                                }
                            } else {
                                foreach($media as $media_id){
                                    echo ' <a target="_blank" href="'.$media_id->guid.'" title="'.$media_id->post_name.'">'.get_the_title().'</a> ';
                                }
                            }
                        }?>
                    </div>
                    <div class="wrap wrap--frame wrap--frame__middle wrap--flex">
                        <div class="wrap wrap--frame wrap--frame__middle">
                            <?php echo get_the_date(); ?>
                        </div>
                        <div class="wrap wrap--frame wrap--frame__middle wrap--buttons">
                            <input type="checkbox" class="tolisten hidden" id="checkbox-doc-<?php the_ID(); ?>" name="docs_remove[]" value="<?php the_ID(); ?>">
                            <label class="remove" for="checkbox-doc-<?php the_ID(); ?>"></label>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>

        <!-- remove document -->
        <?php wpdc_the_submit('updatesection', 'removedoc', '', '', 'Eliminar documentos');?>
        
    <?php } else { ?>
        <p>No hay documentos todavía. Cuando añadas uno, se verá aquí.</p>
    <?php } wp_reset_postdata(); ?><!-- end of document list -->

    <!-- upload document -->
    <h3 class="sep">Nuevo documento</h3>
    <p class="help help--section">Los documentos deben ser archivos PDF o ZIP</p>
    <div class="wrap wrap--frame wrap--flex">
        <div class="wrap wrap--frame wrap--frame__middle">
            <input type="text" placeholder="Nombre" name="doc_name" id="docname">
        </div>
        <div class="wrap wrap--frame wrap--frame__middle">
            <input id="inputfiles" type="file" name="files[]" accept=".pdf,.zip" class ="files-data form-control" multiple />
        </div>
    </div>

    <?php
    $visibility_options = [
        "administrator" => "Administradores",
        "editor" => "Junta Directiva",
        "socios" => "Asociados",
        "subscribers" => "Registrados",
        "visitors" => "Todos",
    ];
    wpdc_the_input_select_option('doc_visivility', '', 'Quién puede verlo', $visibility_options, true);
    ?>

    <!-- submit document -->
    <?php wpdc_the_submit('updatesection', 'uploaddoc', 'update-doc', '', 'Añadir documento');?>

    <!-- close -->
    <?php include(locate_template('templates/sections/section-close.php')); ?>

</section>