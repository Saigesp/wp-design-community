<?php
  $args = array( 'post_id' => get_the_ID());
  $args_trash = array( 'post_id' => get_the_ID(), 'status' => 'trash');
  $comments = get_comments( $args );
  $comments_trash = get_comments( $args_trash );
?>
<?php if( is_home() ||
  ( is_user_logged_in() && (
    is_page('Edit Profile') ||
    is_page('Configuration') ||
    is_page('Configuration presidence') ||
    is_page('Configuration treasury') ||
    is_page('Configuration secretary') ||
    is_page('Configuration concursos') ||
    is_page('Configuration jobs') ||
    is_page('Configuration posts') ||
    is_singular('fee') ||
    is_author()
    )
  )
){ ?>
<section class="wrap wrap--fullwidth wrap--meeseeks">

  <?php if(is_home()){?>
    <div class="wrap wrap--frame wrap--flex">
      <div class="wrap wrap--frame wrap--frame__middle">
        <div class="wrap wrap--logo">
          <a href="<?php bloginfo('url'); ?>">
            <?php if(wp_get_attachment_url(get_theme_mod( 'logo_file', true )) != ''){ ?>
              <img alt="logo" src="<?php echo wp_get_attachment_url(get_theme_mod( 'logo_file', true )); ?>"/>
            <?php } else { ?>
              <img alt="logo" src="<?php echo get_template_directory_uri(); ?>/img/default/logo.png"/>
            <?php } ?>
          </a>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </div>
      </div>
      <div class="wrap wrap--frame wrap--frame__middle">
          <p class="text text--right">Inicia sesión</p>
          <div class="wrap wrap--frame wrap--social">
          </div>
      </div>
    </div>

  <?php }elseif(is_author() ){ ?>
    <?php if(get_current_user_id() == get_query_var('author')){ ?>
      <div class="wrap wrap--frame">
        <h4>Hola <?php echo wpdc_get_user_name(get_current_user_id());?></h4>
        <ul class="list list--notification">
        <?php
        $notifications = array_reverse(get_user_notification_track(get_current_user_id()));
        $index = count($track);
        foreach ($notifications as $track) {
          $output = '<li class="notification">';
          if($track['type'] == 'message') {
            $output .= '<span class="author">'.wpdc_get_user_name($track['changeby']).'</span>: ';
            $output .= '<span class="msg">'.$track['msg'].'</span> ';
          }

          //foreach ($track as $key => $value) $output .= $key.': '.$value.' | '; //Test purpouses

          $output .= ' <span title="'.$track['date'].'" class="js-date-fromnow">'.$track['date'].'</span>';
          $output .= '</li>';
          echo $output;
        }
        ?>
        </ul>
      </div>
    <?php }elseif(is_user_role('administrator') || is_user_role('editor') ){ ?>
      <div class="wrap wrap--frame">
        <h4><?php echo wpdc_get_user_name(get_query_var('author'));?></h4>
        <form method="POST" action="">
          <input type="text" name="msg" placeholder="Enviar mensaje a <?php echo wpdc_get_user_name(get_query_var('author'));?>"> 
          <label for="sendmsg">Enviar</label>
          <input type="submit" id="sendmsg" class="hidden" name="notification" value="message"></button>
          <input type="hidden" name="action" value="update-notification"/>
        </form>
      </div>
    <?php } ?>
  <?php }else{ ?>



  <div class="wrap wrap--frame">
    <h4>Hola <?php echo wpdc_get_user_name(get_current_user_id());?></h4>

      <div class="wrap wrap--frame wrap--flex">
        <div class="wrap wrap--frame wrap--frame__middle">
          <p id="notificationcount" class="notificationresume">
            <?php comments_number( 'Todo está en regla ¡Que tengas un buen día!', 'Tienes <span class="number">1</span> notificación pendiente:', 'Tienes <span class="number">%</span> notificaciones pendientes:' ); ?>
          </p>
        </div>
        <div class="wrap wrap--frame wrap--frame__middle">
          <p class="notificationresume text text--right">
            <a id="archivelaunch" class="action js-section-launch <?php if(!$comments_trash) echo 'hide' ?>" onclick="ToggleSection(this)" data-section="notificationhistory"><span class="hideonactive">Ver</span><span class="showonactive">Ocultar</span> archivo</a>
          </p>
        </div>
      </div>

      <div class="wrap wrap--frame">
        <div id="notificationnow" class="wrap wrap--frame">
          <ul class="list list--notification">
            <?php if($comments){ ?>
              <?php foreach ( $comments as $comment ) { ?>
                <?php 
                echo '<li id="notification-'.$comment->comment_ID.'" class="notification">'.$comment->comment_content.'<br><span class="date js-date-fromnow">'.$comment->comment_date.'</span> <span class="action action--archive" data-id="'.$comment->comment_ID.'" data-nonce="'.wp_create_nonce('my_delete_post_nonce').'" onclick="deleteNotification(this)" >Archivar</span> <span class="action action--restore" data-id="'.$comment->comment_ID.'" data-nonce="'.wp_create_nonce('my_delete_post_nonce').'" onclick="approveNotificationFTW(this)">Restaurar</span> <span class="action action--remove" data-id="'.$comment->comment_ID.'" data-nonce="'.wp_create_nonce('my_delete_post_nonce').'" onclick="deleteNotificationFTW(this)">Eliminar</span></li>';
                ?>
              <?php } ?>
            <?php } ?>
          </ul>
        </div>
        <div id="notificationhistory" class="wrap wrap--frame wrap--hidden js-section js-section-notificationhistory">
          <ul class="list list--notification list--notification__archive">
            <?php if($comments_trash){ ?>
              <?php foreach ( $comments_trash as $comment ) { ?>
                <?php 
                echo '<li id="notification-'.$comment->comment_ID.'" class="notification">'.$comment->comment_content.'<br><span class="date js-date-fromnow">'.$comment->comment_date.'</span> <span class="action action--archive" data-id="'.$comment->comment_ID.'" data-nonce="'.wp_create_nonce('my_delete_post_nonce').'" onclick="deleteNotification(this)" >Archivar</span> <span class="action action--restore" data-id="'.$comment->comment_ID.'" data-nonce="'.wp_create_nonce('my_delete_post_nonce').'" onclick="approveNotificationFTW(this)">Restaurar</span> <span class="action action--remove" data-id="'.$comment->comment_ID.'" data-nonce="'.wp_create_nonce('my_delete_post_nonce').'" onclick="deleteNotificationFTW(this)">Eliminar</span></li>';
                ?>
              <?php } ?>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>

  <?php } ?>

</section>
<?php } ?>

<?php //if(is_user_role('administrator')){ ?>
<?php if(!empty($_POST)) { ?>
<section class="wrap wrap--content wrap--shadow">

  <h3 class="title title--section">$_POST</h3>
  <?php
  if(is_array($_POST)) {
    echo '<strong>Array()</strong><br>';
    foreach ($_POST as $key => $value) {
      if (is_array($value)){
        foreach ($value as $k => $v) {
          echo $key . '[' . $k . ']: ' . $v . '<br>';
        }
      }
      else echo $key . ': ' . $value . '<br>';
    }
  }else{
    var_dump($_POST);
  }
  ?>

</section>

<?php } ?>
<?php //} ?>

