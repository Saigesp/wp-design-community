<?php get_header(); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<style>
  #validation {margin: 20px auto; display: inline-block;}
  
  #validation svg {fill: #aaa; cursor: pointer;}
  #validation svg:hover {fill: #999;}
  #validation span {line-height: 40px; vertical-align: top; color: #aaa;}
  
  #validation.validate #valide svg {fill: #9ac643;}
  #validation.validate #valide svg:hover {fill: #819e47;}
  #validation.validate #denunce {display:none;}
  
  .authorimg {margin-top:80px;}
  
  .userinfo {text-align: center;}
  .userinfo p {font-size: 1.0rem; margin-bottom:0;}
  
  #validaters {margin-top: 30px;}
  
  
    .ui-tooltip {
    font-size: 0.7rem;
    padding: 0;
		background: transparent;
    width:500px;
    border-radius: 0;
    text-align:left !important;
    border: none !important;
    color: white;    
  }
  .ui-tooltip div {background-color: rgba(25,25,25,0.9); padding: 10px;}
</style>

<?php
  $user_id = get_the_author_meta( "ID");
  $user_current = get_current_user_id();

   if($user_current != $user_id){
				$user_vis = get_the_author_meta('user_vis',$user_id);
				update_user_meta( $user_id, 'user_vis', $user_vis+1 );
  }
?>

<?php if(isset($_POST['denunce'])) user_denunced( $user_id, $user_current ) ?>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<script>
jQuery(document).ready(function($) {
  var response;
  $('#valide').on('submit',function(e) {
    e.preventDefault();
    $.post( checkbox.ajaxurl, {
          action : 'submit_checkboxes',
          nonce : checkbox.nonce,
          post : $(this).serialize()
      },
      function(response) {
          console.log(response);
          responseSuccess(response);
      });
    $('#validation').toggleClass( "validate" );
    return false;
  });
});
</script>

<?php  
$img_p1 = wp_get_attachment_image_src(get_the_author_meta('img_p1', $user_id ), 'full');
$img_p2 = wp_get_attachment_image_src(get_the_author_meta('img_p2', $user_id ), 'full');
$img_p3 = wp_get_attachment_image_src(get_the_author_meta('img_p3', $user_id ), 'full');
$op_user = get_user_meta($user_id, 'op_user', true );
$op_user_current = get_user_meta($user_current, 'op_user', true );
$user_reg = get_the_author_meta('user_registered', $user_id);


/*
if($user_id == 197 && $user_current == 1){
 $op_user['invitaciones'] = $op_user['invitaciones']-20; 
 update_user_meta($user_id, 'op_user', $op_user );		
}
*/


?>








<div class="post-header" onload="resizeHeader()">
		<div class="div-thumbnail" id="thumbnail" style="position: relative;">
		  <div class="gallery" id="gallery" style="height: 480px;">
    		<div id="img<?php echo $cont_user+1;?>" class="control-operator"></div>
    		<div id="img<?php echo $cont_user+2;?>" class="control-operator"></div>
    		<div id="img<?php echo $cont_user+3;?>" class="control-operator"></div>
    		<figure class="item profile-foto-proyecto" style="background-image:url('<?php echo $img_p1[0];?>');"></figure>
    		<figure class="item profile-foto-proyecto" style="background-image:url('<?php echo $img_p2[0];?>');"></figure>
    		<figure class="item profile-foto-proyecto" style="background-image:url('<?php echo $img_p3[0];?>');"></figure>
    		<div class="controls">
      		<a href="#img<?php echo $cont_user+1;?>" class="control-button">•</a>
      		<a href="#img<?php echo $cont_user+2;?>" class="control-button">•</a>
      		<a href="#img<?php echo $cont_user+3;?>" class="control-button">•</a>
    		</div>
			</div>      
		</div>
</div><!-- .post-header -->




  <div class="authorimg" style="clear: both; margin-bottom: 20px;">
  		<?php if(get_the_author_meta('foto_personal', $user_id)) {?>
				<div class="profile-foto" tooltip="">
        	<?php echo wp_get_attachment_image(get_the_author_meta('foto_personal', $user_id),array(100, 100) );?>
        </div>
			<?php } ?>
      <p class="username" >
        <?php if(get_the_author_meta( 'type', $user_id) != 'estudio'){
  							echo get_the_author_meta('first_name',$user_id ).' ';
  						}
							echo get_the_author_meta('last_name',$user_id );?>
    	</p>
    	<?php if(get_the_author_meta( 'type', $user_id) != 'estudio'){ ?>
      	<p class="pseudonimo"><?php echo get_the_author_meta( 'pseudonimo', $user_id );?></p>
    	<?php } ?>
  </div>
<div class="pop">
      <div id="popup1" class="overlay">
          <div class="popup">
                <h2><?php if(get_the_author_meta( 'type', $user_id) != 'estudio'){ echo get_the_author_meta('first_name',$user_id ).' ';}	echo get_the_author_meta('last_name',$user_id );?></h2>
                <a class="close" href="#img1">&times;</a>
                <div class="content">
                      <p><?php echo '<b>Registrado:</b> '.$user_reg;?></p>
                      <p><?php echo '<b>Tipo:</b> '; the_type_name(get_the_author_meta('type', $user_id));?></p>
                      <p><?php echo '<b>Provincia:</b> '; the_region_name(get_the_author_meta('region', $user_id)); ?></p>
                      <p><?php echo '<b>Titulación:</b> '.get_the_author_meta( 'titulacion', $user_id );?></p>
                      <p><?php echo '<b>Centro:</b> '.get_the_author_meta( 'centro_de_estudios', $user_id );?></p>
                      <p><?php $especial = get_the_author_meta('especialidad', $user_id ); 
                               echo '<b>Experiencia:</b> ';
                               foreach ($especial as $esp) {
                                 the_speciality_name( $esp );
                                 echo ', '; 
                               }
                    ?></p>
                </div>
                <p style="margin-top: 30px; text-align: center;"><a class="button" href="#img1">Cerrar</a></p>
          </div>
      </div>
</div>
<div class="pop">
      <div id="popup2" class="overlay">
          <div class="popup">
                <h2>Validación</h2>
                <a class="close" href="#img1">&times;</a>
            		<div id="validation" class="<?php if(in_array(get_current_user_id(), $op_user['hasiovalidado'])) echo 'validate';?>" style="text-align: center; display: block;">
            		<?php if(get_current_user_id() != $user_id){    
    							if(get_userdata($user_id)->user_registered >= get_userdata(get_current_user_id())->user_registered && (is_user_role('author') || is_user_role('editor') || is_user_role('administrator'))) {?>
                  <?php if (!is_user_role('author', $user_id) && !is_user_role('editor', $user_id) && !is_user_role('administrator', $user_id)){ ?>
                  <p>¿Cumple este usuario los <a href="http://xn--diseadoresindustriales-nec.es/faqs/#faq289">requisitos</a> para formar parte del directorio?</p>
    								<form id="valide" method="POST" style="display: inline-block;" title="Validar usuario">
      								<label>
      									<input type="hidden" value="<?php echo $user_id;?>" name="userid">
      									<input type="submit" value="Validar" style="margin: 20px 0 0 0;display:none; " >
            						<?php the_svg_icon("validate"); ?>
      								</label>
    								</form>
    								<form id="denunce" method="POST" style="display: inline-block;">
      								<label>
      									<input type="hidden" value="<?php echo $user_id;?>" name="userid">
      									<input type="submit" value="Denunciar" name="denunce" style="margin: 20px 0 0 0;display:none; " >
            						<?php the_svg_icon("denunce"); ?>
      								</label>
    								</form>
        				<?php }else{ ?>
        						<p style="text-align:left;"><b>Usuario validado por</b></p>
                        <div class="content">
      			<?php if(is_array($op_user['hasiovalidado'])){
  									foreach ( $op_user['hasiovalidado'] as $k){
                      if ($k == 0) continue;
                      if(!user_id_exists($k)) continue;
                     // if ($k == get_current_user_id( )) continue;
                      echo '<div class="profile-mini-foto" style="float:left; text-align: center; display: inline-flex;" title="Validado por '.get_the_author_meta('first_name',$k ).' '.get_the_author_meta('last_name',$k ).'"><a href="'.get_author_posts_url($k).'">'.wp_get_attachment_image(get_the_author_meta('foto_personal', $k),array(28, 28) ).'</a></div>';
  								}}else{
                  		echo '<div class="profile-mini-foto" style="float:left; text-align: center; display: inline-flex;" title="Validado por '.get_the_author_meta('first_name',$op_user['hasiovalidado'][1] ).' '.get_the_author_meta('last_name',$op_user['hasiovalidado'][1] ).'"><a href="'.get_author_posts_url($op_user['hasiovalidado'][1]).'">'.wp_get_attachment_image(get_the_author_meta('foto_personal', $op_user['hasiovalidado'][1]),array(28, 28) ).'</a></div>';
                  }?>
                </div>
								<?php }}} ?>
            		</div>
                <p style="margin-top: 30px; text-align: center;"><a class="button" href="#img1">Cerrar</a></p>
          </div>
      </div>
</div>
<div class="">
	<div class="post wrap">
  	<div id="user-<?php the_ID(); ?>" class="body">
			<p><?php echo get_the_author_meta('description', $user_id );?></p>
		</div>
	</div>
  <div class="post wrap userinfo">
    <p class="user_url"><?php if (get_the_author_meta('user_url',$user_id)!=''){?><a href="<?php the_author_meta( 'user_url', $user_id ); ?>" title="Enlace a página web" target="_blank"><?php echo substr(get_the_author_meta( 'user_url', $user_id ), 7); ?></a><?php }?></p>
      <p class="links">
	    	<?php if (get_the_author_meta('twitter',$user_id)!=''){?>
      		<a href="https://twitter.com/<?php the_author_meta( 'twitter', $user_id ); ?>" title="Twitter" target="_blank"><?php the_svg_icon("twitter");?></a>
      	<?php }?>
        <?php if (get_the_author_meta('facebook',$user_id)!=''){?>
      		<a href="https://www.facebook.com/<?php the_author_meta( 'facebook', $user_id ); ?>" title="Página de Facebook" target="_blank"><?php the_svg_icon("facebook");?></a>
      	<?php }?>
      	<?php if (get_the_author_meta('linkedin',$user_id)!=''){?>
      	  <a href="<?php the_author_meta( 'linkedin', $user_id ); ?>" title="Linkedin" target="_blank"><?php the_svg_icon("linkedin");?></a>
      	<?php }?>
	      <?php if (get_the_author_meta('tumblr',$user_id)!=''){?>
  	  		<a href="http://<?php the_author_meta( 'tumblr', $user_id ); ?>.tumblr.com" title="Tumblr" target="_blank"><?php the_svg_icon("tumblr");?></a>
    	  <?php }?>
      	<?php if (get_the_author_meta('behance',$user_id)!=''){?>
      		<a href="http://www.behance.net/<?php the_author_meta( 'behance', $user_id ); ?>" title="Behance" target="_blank"><?php the_svg_icon("behance");?></a>
	      <?php }?>
  	    <?php if (get_the_author_meta('domestika',$user_id)!=''){?>
    	 		<a href="http://www.domestika.org/es/<?php the_author_meta( 'domestika', $user_id ); ?>" title="Domestika" target="_blank"><?php the_svg_icon("domestika");?></a>
      	<?php }?>
    	</p>

  </div>
 
  		<?php if (get_current_user_id( ) != ''){ ?>
      		<div class="post wrap userinfo"> 
  				<div id="validation" class="<?php if(in_array(get_current_user_id(), $op_user['hasiovalidado'])) echo 'validate';?>">
            <a class="" href="#popup1">
              <div class="profile-mini-foto" style="float: left; text-align: center; display: inline-flex; background-color: #F46553; border: none;">
                <span style="line-height: 25px; vertical-align: top; color: white; width: 100%; font-size: 1.3rem; font-weight: bolder; font-family: serif;" title="Información">i</span>
              </div>
            </a>
            <a class="" href="#popup2" title="Validaciones">
                <?php the_svg_icon("validate"); ?>
            </a>
					</div> 
  			</div>
			<?php }?>
  	</div>  


  <?php if (get_current_user_id( ) == 1){ 
 // var_dump($op_user);

	}?>


<script>
function ResizeHead(){
		var theight = document.getElementById('gallery').offsetWidth; 
		document.getElementById("gallery").style.height = theight*0.4 +"px";
}
window.addEventListener("load", ResizeHead);
window.addEventListener("resize", ResizeHead);
</script>

<?php get_footer(); ?>