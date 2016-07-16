<?php if(get_current_user_id() == get_query_var('author')){ ?>
  <div class="wrap wrap--frame wrap--notification wrap--notification__receive">
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
  <div class="wrap wrap--frame wrap--notification wrap--notification__send">
    <h4><?php echo wpdc_get_user_name(get_query_var('author'));?></h4>
    <form method="POST" action="">
      <input type="text" name="msg" placeholder="Enviar mensaje a <?php echo wpdc_get_user_name(get_query_var('author'));?>"> 
      <div class="options">
        <label for="sendmsg">Enviar</label>
      </div>
      <input type="submit" id="sendmsg" class="hidden" name="notification" value="message"></button>
      <input type="hidden" name="action" value="update-notification"/>
    </form>
  </div>
<?php } ?>