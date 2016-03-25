<?php
$args = array( 'post_id' => get_the_ID());
$comments = get_comments( $args ); 

?>
<section class="wrap wrap--fullwidth wrap--harry">
  <div class="wrap wrap--frame">
    <h4>Hola <?php echo get_userdata(get_current_user_id())->first_name;?></h4>
    <p><?php comments_number( 'Todo está en regla. ¡Que tengas un buen día!', 'Tienes una tarea pendiente:', 'Tienes <span class="number">%</span> tareas pendientes:' ); ?></p>
    <?php if($comments){ ?>
      <ul>
      <?php foreach ( $comments as $comment ) { ?>
        <?php 
        echo '<li id="notification-'.$comment->comment_ID.'" class="notification">'.$comment->comment_content.' <span class="js-date-fromnow">'.$comment->comment_date.'</span> <span class="remove" data-id="'.$comment->comment_ID.'" data-nonce="'.wp_create_nonce('my_delete_post_nonce').'" onclick="deleteNotification(this)" >Ok</span></li>';
        ?>
      <?php } ?>
      </ul>
    <?php } ?>
  </div>
</section>