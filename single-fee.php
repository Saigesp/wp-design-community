<?php get_header(); ?> 
<?php if(is_user_role('administrator') || is_user_role('editor') || is_user_role('author')) { ?>

<?php

$exclude_list = array();
$admins = get_users( array('role' => 'administrator') );
foreach ($admins as $admin) array_push($exclude_list, $admin->ID);

$args = array( 
  'exclude' => $exclude_list, // Exclude admins
  'role' => 'author', // Partners
  'order' => 'DESC',
  'number' => 9999,
);
$user_query = new WP_User_Query($args);


?>


  <!-- flexboxer -->
  <div id="flexboxer-<?php the_ID(); ?>" class="flexboxer flexboxer--fee">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?> 


        <?php if(is_user_role('administrator') || is_user_role('editor')) { ?>
          <?php if($user_query->total_users > 0){ ?>

            <!-- list of users -->
            <section class="wrap wrap--content wrap--content__fullwidth">
              <h2>Cuota <?php the_title();?></h2>
              <?php the_content();?>
              <table>
                <tr>
                  <th>Nombre</th>
                </tr>
                <?php foreach ( $user_query->results as $user ) { 
                  $user_id = $user->ID;
                  ?>
                  <tr>
                    <td><?php echo get_the_author_meta('first_name',$user_id ). ' '.get_the_author_meta('last_name',$user_id );?></td>
                  </tr>
                <?php } ?>
              </table>
            </section><!-- end of list of users -->

          <?php }else{ // No authors in list ?>

            <!-- message no authors -->
            <section class="wrap wrap--content">
              <p>No hay usuarios <em>authors</em></p>
            </section><!-- end of message no authors -->

          <?php } ?>
        <?php }else{ // If is author ?>

          <section class="wrap wrap--content">
            <h2>Cuota <?php the_title();?></h2>
            <?php the_content();?>
          </section>

          <section class="wrap wrap--frame">
            <p class="submit">
              <input type="hidden" name="pay_fee" value="true" />
              <input type="submit" class="button button-primary" value="Pagar cuota">
            </p>
          </section>


        <?php } ?>

      <?php endwhile; ?>
    <?php else : ?>

      <!-- noinfo -->
      <section class="wrap wrap--content">
        <h2>No se ha encontrado la información</h2>
      </section><!-- end of noinfo -->

    <?php endif; ?>
  </div><!-- end of flexboxer -->
<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>
<?php get_footer(); ?>