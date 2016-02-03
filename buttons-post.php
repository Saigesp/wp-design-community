<?php if(is_user_role('author') || is_user_role('editor') || is_user_role('administrator')){
  $denuncias = unserialize(get_post_meta($post->ID, 'hasiodenunciado', true));
  $recomendaciones = unserialize(get_post_meta($post->ID, 'hasiorecomendado', true));
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'denunce-post' ) {
    if (!in_array($_POST['userid'], $denuncias)){
      array_push ($denuncias, $_POST['userid']);
      update_post_meta( $post->ID, 'hasiodenunciado', serialize($denuncias));
      update_post_meta( $post->ID, 'hasiodenunciado_count', count($denuncias));
    }
	} 
	?>
  
  <div class="pop">
        <div id="popupdenunce" class="overlay">
            <div class="popup">
                  <h2>Problema</h2>
                  <a class="close" href="#img1">&times;</a>
                  <div class="content">
                    <p><strong>Recomendaciones</strong>:</p>
                    <?php foreach ( $denuncias as $k){
                            if(!user_id_exists($k)) continue;
                            echo '<div class="profile-mini-foto" style="float:left; text-align: center; display: inline-flex;" title="Denunciado por '.get_the_author_meta('first_name',$k ).' '.get_the_author_meta('last_name',$k ).'"><a href="'.get_author_posts_url($k).'">'.wp_get_attachment_image(get_the_author_meta('foto_personal', $k),array(28, 28) ).'</a></div>';
                      		}?>
                   </div> 
                  <div class="content">
                    <p><strong>Negativos</strong>:</p>
                    <?php foreach ( $denuncias as $k){
                            if(!user_id_exists($k)) continue;
                            echo '<div class="profile-mini-foto" style="float:left; text-align: center; display: inline-flex;" title="Denunciado por '.get_the_author_meta('first_name',$k ).' '.get_the_author_meta('last_name',$k ).'"><a href="'.get_author_posts_url($k).'">'.wp_get_attachment_image(get_the_author_meta('foto_personal', $k),array(28, 28) ).'</a></div>';
                      		}?>
                   </div> 
                   <div class="content"> 
										<?php if (!in_array(get_current_user_id(), $denuncias)){?>
                      <p>¿Consideras que hay un problema con esta publicación?</p>
                      <form id="denunce" method="POST">
                        <p style="margin-top: 30px; text-align: center;">
                        <label>
                          <input type="hidden" value="<?php echo get_current_user_id();?>" name="userid">
                          <input type="hidden" value="denunce-post" name="action">
                          <input type="submit" value="Denunciar" name="denunce" class="button" >
                        </label>
                        </p>
                      </form>

                    <?php } ?>
                  </div>
                  <p style="margin-top: 30px; text-align: center;">
                    <a class="button" href="#img1">Cerrar</a>
                  </p>
            </div>
        </div>
  </div>

    <?php if(is_user_role('administrator')){?>
			<div class="pop">
        <div id="popupinfo" class="overlay" style="position: absolute; height: 300%;">
            <div class="popup">
              <a class="close" href="#img1">&times;</a>
              <p style="font-size:0.7rem;">
              	<?php if (is_singular('concursos')){ 
    							echo '<strong>Denuncias:</strong> '.get_post_meta($post->ID, 'hasiodenunciado_count', true).'<br>';
                  echo '<strong>Denunciantes:</strong> ';
                  $denuncias = unserialize(get_post_meta($post->ID, 'hasiodenunciado', true));
                  foreach ($denuncias as $v){
                  	echo '<a href="'.get_author_posts_url($v).'">'.$v.'</a>, ';  
                  }
    							echo '<br>';
								}?>
              </p>
              <p style="margin-top: 30px; text-align: center;">
              	<a class="button" href="#img1">Ok</a>
              </p>
            </div>
        </div>
      </div>
    <?php } ?>



  <ul class="rrssb-buttons action-buttons clearfix">
    <?php if(is_user_role('administrator')|| is_user_role('editor')){?>
      <li class="infoicon" title="Admin information">
          <a href="#popupinfo">
              <span class="rrssb-icon">
                  <?php the_svg_icon('info');?>
              </span>
          </a>
      </li>
    <?php } ?>
      <li class="recommendicon" title="Recomendar">
          <a href="#popupdenunce">
              <span class="rrssb-icon">
                  <?php the_svg_icon('corazon');?>
              </span>
          </a>
      </li>
      <li class="problemicon" title="Informar de problema">
          <a href="#popupdenunce">
              <span class="rrssb-icon">
                  <?php the_svg_icon('denunce');?>
              </span>
          </a>
      </li>
  </ul>
<?php }?>