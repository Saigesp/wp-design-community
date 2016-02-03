<?php
$user_query = new WP_User_Query($args);
$cont_user = 0;
if ( !empty( $user_query->results ) ) {	
  foreach ( $user_query->results as $user ) {		
    $enlace = $user->user_login; 		
    $user_id = $user->ID;
    $op_user = get_user_meta($user_id, 'op_user', true );
		$word_limit = 30;
		$more_txt = 'read more about:'; // The read more text
		$txt_end = '...'; // Display text end 
    
   if(get_current_user_id( ) != $user_id){
				$user_search = get_the_author_meta('user_search',$user_id);
				update_user_meta( $user_id, 'user_search', $user_search+1 );
  }
    
?>		

    <div id="profile-<?php echo $user_id; ?>" class="masonry" style="display: inline-block; vertical-align: top;" >
        <div class="profilebox float borderbox onecolumn">
          <div class="profile-header">

          
<?php 
$image = get_the_author_meta('foto_personal', $user_id );
$img_p1 = wp_get_attachment_image_src(get_the_author_meta('img_p1', $user_id ), array(280, 190));
$img_p2 = wp_get_attachment_image_src(get_the_author_meta('img_p2', $user_id ), array(280, 190));
$img_p3 = wp_get_attachment_image_src(get_the_author_meta('img_p3', $user_id ), array(280, 190));
?>
  
  <div class="gallery" style="height: 180px;">
    <div id="img<?php echo $user_id.'i1';?>" class="control-operator"></div>
    <div id="img<?php echo $user_id.'i2';?>" class="control-operator"></div>
    <div id="img<?php echo $user_id.'i3';?>" class="control-operator"></div>

    <figure class="item profile-foto-proyecto" style="background-image:url('<?php echo $img_p1[0];?>');"></figure>
    <figure class="item profile-foto-proyecto" style="background-image:url('<?php echo $img_p2[0];?>');"></figure>
    <figure class="item profile-foto-proyecto" style="background-image:url('<?php echo $img_p3[0];?>');"></figure>

    <div class="controls">
      <a href="#img<?php echo $user_id.'i1';?>" class="control-button">•</a>
      <a href="#img<?php echo $user_id.'i2';?>" class="control-button">•</a>
      <a href="#img<?php echo $user_id.'i3';?>" class="control-button">•</a>
    </div>
  </div>
  
<?php if( $image ) {?>
<div class="profile-foto profile-foto-edit">
<a href="<?php echo get_author_posts_url($user_id);?>"  title="Ver perfil de <?php if(get_the_author_meta( 'type', $user_id) != 'estudio'){	echo get_the_author_meta('first_name',$user_id ).' '; } echo get_the_author_meta('last_name',$user_id );?>">
<?php echo wp_get_attachment_image( $image,array(100, 100) );?>
</a>
</div>
<?php } ?>
</div><!-- .profile-header -->
          
          
<div class="profile-body">
                    <p class="username">
                		<?php if(get_the_author_meta( 'type', $user_id) != 'estudio'){
  													echo get_the_author_meta('first_name',$user_id ).' ';
  												}
    											echo get_the_author_meta('last_name',$user_id );?>
                </p>
  							<?php if(get_the_author_meta( 'type', $user_id) != 'estudio'){ ?>
                <p class="pseudonimo">
                		<?php echo get_the_author_meta( 'pseudonimo', $user_id );?>
                </p>
  							<?php } ?>
  						 <p class="especialidad">
                        <?php $especial = get_the_author_meta('especialidad', $user_id ); 
															foreach ($especial as $esp) {
                                the_speciality_name( $esp );
                                echo ", ";
                                }
												?>
                    </p>
          				  <p class="region">
                        <?php the_region_name(get_the_author_meta('region', $user_id)); ?>
                    </p>
          					<p class="bio">
                        <?php echo wp_trim_words(strip_tags(get_the_author_meta('description', $user_id)), $word_limit, $txt_end, $more_txt);; ?>
                    </p><!-- .form-textarea -->
                    <p class="links">
                      <?php if (get_the_author_meta('user_url',$user_id)!=''){?>
                      		<a href="<?php the_author_meta( 'user_url', $user_id ); ?>" title="Página web" target="_blank">
                      				<?php the_svg_icon("web");?>
                      		</a>
                      <?php }?>
                      <?php if (get_the_author_meta('twitter',$user_id)!=''){?>
                      		<a href="https://twitter.com/<?php the_author_meta( 'twitter', $user_id ); ?>" title="Twitter" target="_blank">
                      		<?php the_svg_icon("twitter");?>
                      		</a>
                      <?php }?>
                      <?php if (get_the_author_meta('facebook',$user_id)!=''){?>
                      		<a href="https://www.facebook.com/<?php the_author_meta( 'facebook', $user_id ); ?>" title="Página de Facebook" target="_blank">
                      		<?php the_svg_icon("facebook");?>
                      		</a>
                      <?php }?>
                      <?php if (get_the_author_meta('linkedin',$user_id)!=''){?>
                      		<a href="<?php the_author_meta( 'linkedin', $user_id ); ?>" title="Linkedin" target="_blank">
                      				<?php the_svg_icon("linkedin");?>
                      		</a>
                      <?php }?>
                      <?php if (get_the_author_meta('tumblr',$user_id)!=''){?>
                      		<a href="http://<?php the_author_meta( 'tumblr', $user_id ); ?>.tumblr.com" title="Tumblr" target="_blank">
                      				<?php the_svg_icon("tumblr");?>
                      		</a>
                      <?php }?>
                      <?php if (get_the_author_meta('behance',$user_id)!=''){?>
                      		<a href="http://www.behance.net/<?php the_author_meta( 'behance', $user_id ); ?>" title="Behance" target="_blank">
															<?php the_svg_icon("behance");?>
                          </a>
                      <?php }?>
                      <?php if (get_the_author_meta('domestika',$user_id)!=''){?>
                      		<a href="http://www.domestika.org/es/<?php the_author_meta( 'domestika', $user_id ); ?>" title="Domestika" target="_blank">
															<?php the_svg_icon("domestika");?>
                      		</a>
                      <?php }?>
                    </p><!-- .form-url -->


</div><!-- .profile-body -->

</div><!-- .profile -->
      
</div><!-- #profile-13 -->
      
<?php $cont_user=$cont_user+3; ?>
<?php } ?>

<?php }else{
  
if(is_search()){?>
<div id="main">  
  <div class="profilebox page">
<?php if ($_GET['reg'] == '' && $_GET['act'] == ''){?>

  			<p>Necesitamos que especifiques al menos la región o la actividad en los parámetros de búsqueda</p>
<div class="searchform searchome searchpage" onload="check()">
<?php require_once( 'searchform-home.php' ); ?>
</div>
		<?php	}else{
  			echo "<h3>No se han encontrado resultados</h3>";
			}?>
  </div>
</div>
<?php }} ?>