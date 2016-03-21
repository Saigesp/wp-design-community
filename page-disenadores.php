<?php get_header(); ?>
<div class="flexboxer flexboxer--disenadores">

  <div class="wrap wrap--user">
    <figure class="wrap wrap--photo wrap--photo__position">
      <h2>Junta
      <br>Directiva</h2>
    </figure>  
  </div>
  
  <?php
  $original_query = $wp_query;
  $args = array( 
      'exclude' => array( 1 ),
      'role' => 'editor',
      'order' => 'DESC',
      'number' => 9999,
  );
  $user_query = new WP_User_Query($args);
  if (!empty( $user_query->results)) { 
    foreach ( $user_query->results as $user ) {
      include( locate_template( 'loop-profile.php' ));
    }
  }
  ?> 

  <div class="wrap wrap--user">
    <figure class="wrap wrap--photo wrap--photo__position">
      <h2>Socios</h2>
    </figure>  
  </div>
  <?php
  $original_query = $wp_query;
  $args = array( 
      'exclude' => array( 1 ),
      'role' => 'author',
      'order' => 'DESC',
      'number' => 9999,
  );
  $user_query = new WP_User_Query($args);
  if (!empty( $user_query->results)) { 
    foreach ( $user_query->results as $user ) {
      include( locate_template( 'loop-profile.php' ));
    }
  }
  ?>
</div>




<?php get_footer(); ?>
