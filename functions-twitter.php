<?php
/* Función enviar tweets desde wordpress */
function sendTweet($mensaje){
        ini_set('display_errors', 1);
        require_once('TwitterAPIExchange.php');
        $settings = array(
            'oauth_access_token' => get_option("access_token"),
            'oauth_access_token_secret' => get_option("access_token_secret"),
            'consumer_key' => get_option("consumer_key"),
            'consumer_secret' => get_option("consumer_secret"),
        );
        $url = 'https://api.twitter.com/1.1/statuses/update.json';
        $requestMethod = 'POST';
        $postfields = array( 'status' => $mensaje, );
        $twitter = new TwitterAPIExchange($settings);
        return $twitter->buildOauth($url, $requestMethod)->setPostfields($postfields)->performRequest();
}

function follow($usuario){
        ini_set('display_errors', 1);
        require_once('TwitterAPIExchange.php');
        $settings = array(
            'oauth_access_token' => get_option("access_token"),
            'oauth_access_token_secret' => get_option("access_token_secret"),
            'consumer_key' => get_option("consumer_key"),
            'consumer_secret' => get_option("consumer_secret"),
        );
        $url = 'https://api.twitter.com/1.1/friendships/create.json';
        $requestMethod = 'POST';
        $postfields = array( 'screen_name' => $usuario,'follow' => "true" );
        $twitter = new TwitterAPIExchange($settings);
        return $twitter->buildOauth($url, $requestMethod)->setPostfields($postfields)->performRequest();
}

 

// add_action( 'set_user_role', 'tweet_confirmed_user', 10, 2 );
function tweet_confirmed_user( $user_id, $new_role ) {
  if( $new_role == 'author' && get_option("tweet_new_user") == true){
  	$mensaje = "Tenemos un nuevo usuario! ".get_author_posts_url($user_id);
    if (get_user_meta( $user_id,'twitter', true ) && get_user_meta( $user_id,'twitter', true ) != '') $mensaje .= " @".get_user_meta( $user_id,'twitter', true );
		$respuesta = sendTweet($mensaje);
  }
  if( $new_role == 'author' && get_option("follow_new_user") == true && get_user_meta( $user_id,'twitter', true ) && get_user_meta( $user_id,'twitter', true ) != ''){
		echo follow(get_user_meta( $user_id,'twitter', true ));
  }
}


add_action( 'transition_post_status', 'post_published_tweet', 10, 3 );
function post_published_tweet($new_status, $old_status, $post) {
  
  if ('publish' !== $new_status or 'publish' === $old_status) return;
  if (!get_option("tweet_new_publication")) return;
  
  $post_id      = $post->ID;
  $post_type    = get_post_type($post_id);
  
  if ($post_type == 'enlaces') return;
  
  $post_title   = get_the_title($post_id);
	$post_url     = get_permalink($post_id);
  $post_obj     = get_post_type_object($post_type);
	$post_sin     = $post_obj->labels->singular_name;
  $max_size			= 80;
  
  if (strlen($post_title) > $max_size){
    $leng = strlen($post_title) - $max_size;
    $post_title_s = substr($post_title, 0, -$leng);
    $post_title = $post_title_s.'...';
  }
  
	$mensaje = '#'.$post_sin.' '.$post_title.' '.$post_url;
  
  sendTweet($mensaje);

}


?>