<?php get_header(); 

$wpdc_docs = array (
    'post_type' => 'documentos',
    'posts_per_page' => '-1',
);
$docs = new WP_Query( $wpdc_docs );


?>

  <!-- flexboxer -->
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--docs">

    <section id="doclist" class="wrap wrap--content wrap--shadow wrap--doclist">
        <h3 class="title title--section">Documentos</h3>

       <?php if($docs->have_post()){ ?>
            <h3 class="sep">Listado de documentos</h3>
            <ul class="list">
                <?php while ($docs->have_posts() ) {
                    $docs->the_post();
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
                                <input type="checkbox" id="checkbox-doc-<?php the_ID(); ?>" name="docs_remove[]" value="<?php the_ID(); ?>">
                                <label class="remove" for="checkbox-doc-<?php the_ID(); ?>"></label>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php }else{
            echo '<p>Todavía no hay documentos subidos que mostrar.</p>';
        }  wp_reset_query(); ?>


    </section>

  </div><!-- end of flexboxer -->
<?php get_footer(); ?>