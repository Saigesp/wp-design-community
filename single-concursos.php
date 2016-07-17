<?php

get_header();
$concurso_org       = get_post_meta(get_the_ID(), 'concurso_org', true) == '' ? get_post_meta(get_the_ID(), 'wpcf-conorg')[0] : get_post_meta(get_the_ID(), 'concurso_org', true);
$concurso_bases     = get_post_meta(get_the_ID(), 'concurso_bases', true) == '' ? get_post_meta(get_the_ID(), 'wpcf-conbas')[0] : get_post_meta(get_the_ID(), 'concurso_bases', true);
$concurso_quantity  = get_post_meta(get_the_ID(), 'concurso_quantity', true);
$concurso_date      = get_post_meta(get_the_ID(), 'concurso_date', true) == '' ? date('Y-m-d H:i:s',get_post_meta(get_the_ID(), 'wpcf-confecha')[0]) : get_post_meta(get_the_ID(), 'concurso_date', true);


?>


<div class="flexboxer flexboxer--single flexboxer--single__concurso">

  <?php if (have_posts()) : ?>
    
    <section class="wrap wrap--frame wrap--shadow">
      <?php while (have_posts()) : the_post(); ?>

      <?php if(has_post_thumbnail()){ ?>
        <div class="wrap wrap--wrap wrap--fullwidth">
            <figure id="thumbnail" class="thumb--article js-fullheight js-fullheight-thumb">
              <?php the_post_thumbnail('full');  ?>
            </figure>
        </div>
      <?php }?>

        <div class="wrap wrap--content">
          <h3 class="title title--article__sub"><?php the_title(); ?></h3>

          <div class="wrap wrap--frame wrap--flex">
            <div class="wrap wrap--frame wrap--frame__middle">
              <span><strong>Convoca:</strong> <?php echo $concurso_org;?><br>
              <?php if($concurso_quantity != ''){ ?><strong>Primer premio:</strong> <?php echo $concurso_quantity;?><?php } ?></span>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
              <span><strong>Cierre de convocatoria:</strong> <span class="js-date"><?php echo $concurso_date;?></span><br>
              <?php if($concurso_bases != ''){ ?>Link a las <strong><a href="<?php echo $concurso_bases;?>" target="_blank">bases del concurso</a></strong><?php } ?></span>
            </div>
          </div>
          
          <div id="content-<?php the_ID(); ?>" class="wrap wrap--frame">
            <?php the_content(); ?>
          </div>
        </div>
        
        <?php if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_concursos' || is_user_role('administrator') || is_user_role('editor')){?>
          <?php wpdc_the_edit_icon(get_bloginfo('url').'/edit-concursos/?id='.get_the_ID());?>
        <?php } ?>

      <?php endwhile; ?>
    </section>

  <?php else : ?>

      <?php include(locate_template('templates/sections/404-noinfo.php')); ?>

  <?php endif; ?>
</div>
<?php get_footer();?>