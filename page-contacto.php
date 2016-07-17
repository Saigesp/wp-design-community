<?php get_header(); ?> 

  <!-- flexboxer -->
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--page">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>


        <?php if(is_user_role('author') || is_user_role('editor') || is_user_role('administrator')){
            $title_section = 'Mensajes con '.get_option('blogname');
            wpdc_the_section_messages(get_user_notification_track(get_current_user_id(), 'type', 'message'), 'user_messages', $title_section);
          } else { ?>

          <!-- content -->
          <section class="wrap wrap--content wrap--shadow">
            <h3 class="title title--section"><?php the_title();?></h3>
            <?php if(get_option('asoc_email') != '' || get_option('asoc_adress') != '' || get_option('asoc_tlf') != '' ) {?>
              <div class="wrap wrap--frame text--right">
                <?php if(get_option('asoc_name') != '') echo '<strong>'.get_option('asoc_name').'</strong><br>';?>
                <?php if(get_option('asoc_adress') != '') echo '<strong>Dirección</strong>: '.get_option('asoc_adress').'<br>';?>
                <?php if(get_option('asoc_email') != '') echo '<strong>Email</strong>: '.get_option('asoc_email').'<br>';?>
                <?php if(get_option('asoc_tlf') != '') echo '<strong>Teléfono</strong>: '.get_option('asoc_tlf').'<br>';?>

              </div>
            <?php }?>
            <?php the_content();?>
          </section><!-- end of content -->

        <?php } ?>

      <?php endwhile; ?>
    <?php else : ?>

      <?php include(locate_template('templates/sections/404-noinfo.php')); ?>

    <?php endif; ?>
  </div><!-- end of flexboxer -->
<?php get_footer(); ?>