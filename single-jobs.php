<?php
get_header();
$post_id = get_the_ID();
$job_bussiness = get_post_meta($post_id, 'job_bussiness', true);
$job_info = get_post_meta($post_id, 'job_info', true);
?>


<div class="flexboxer flexboxer--single flexboxer--single__job">

  <?php if(is_user_role('author') || is_user_role('editor') || is_user_role('administrator')){ ?>
    <?php include(locate_template('templates/sections/meeseeks.php')); ?>
  <?php } ?>

  <?php if (have_posts()) : ?>
    
    <section class="wrap wrap--content wrap--shadow">
      <?php while (have_posts()) : the_post(); ?>
        <h3 class="title title--article__sub"><?php the_title(); ?></h3>

        <div class="wrap wrap--frame wrap--flex">
          <div class="wrap wrap--frame wrap--frame__middle">
            <span><strong>Empresa:</strong> <?php echo $job_bussiness;?></span>
          </div>
          <div class="wrap wrap--frame wrap--frame__middle">
            <span><strong><a href="<?php echo $job_info;?>" target="_blank">Más información</a></strong></span>
          </div>
        </div>
      
        <div id="content-<?php the_ID(); ?>" class="wrap wrap--frame">
          <?php the_content(); ?>
        </div>
        
        <?php if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_jobs' || is_user_role('administrator')){?>
          <?php wpdc_the_edit_icon(get_bloginfo('url').'/edit-jobs/?id='.get_the_ID());?>
        <?php } ?>

      <?php endwhile; ?>
    </section>

  <?php else : ?>

      <?php include(locate_template('templates/sections/404-noinfo.php')); ?>

  <?php endif; ?>
</div>
<?php get_footer();?>