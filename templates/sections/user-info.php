<section class="wrap wrap--content wrap--shadow">
  <div class="wrap wrap--frame wrap--flex wrap--userinfo">
    <div class="wrap wrap--frame wrap--frame__100">
      <?php wpdc_the_profile_photo($user_info->ID);?>
    </div>
    <div class="wrap wrap--frame wrap--frame__middle">
      <p>
        <a href="<?php echo get_author_posts_url( $user_info->ID ); ?>">
          <?php echo wpdc_get_user_name($user_info->ID); ?>
        </a>
        <br><?php echo get_user_meta($user_info->ID, 'position', 1);?>
        <br><?php wpdc_the_asociation_position($user_info->ID); ?>
      </p>
    </div>
  </div>

  <?php wpdc_the_edit_icon(get_bloginfo('url').'/edit-profile/?id='.$user_info->ID);?>
    
  <div class="description">
    <?php echo html_entity_decode($user_info->description);?>
  </p>
</section>