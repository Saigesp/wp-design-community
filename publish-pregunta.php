
<?php if((is_user_role('author') && get_option("publication_act")) || is_user_role('administrator') || is_user_role('editor')){ 

?>

<style>
  .wp-editor-area {font-family: 'Open sans', sans-serif !important; line-height: 1.4rem !important;}
  #wp-postcontent-editor-container { border: 1px solid #ccc;}
  #wp-postcontent-editor-tools {display:none;}  
</style>

<script>

function validateForm(form){
  document.getElementById("avise").innerHTML = "";
  if(form.postformtitle.value == '') {
    var p = document.createElement("P"); var t = document.createTextNode("El título no debe estar vacío!");
  	p.appendChild(t); p.className = "error"; document.getElementById("avise").appendChild(p); document.getElementById("avise").className = "avise error";
    form.postformtitle.focus();
    return false;
  }
  if(form.postformdesc.value == '') {
    var p = document.createElement("P"); var t = document.createTextNode("La descripción no debe estar vacía!");
  	p.appendChild(t); p.className = "error"; document.getElementById("avise").appendChild(p); document.getElementById("avise").className = "avise error";
    form.postformdesc.focus();
    return false;
  }
  return true;
}
  
  
window.onload = function() {
  $("#addbutton").click(function() {
    $( "#publishpreguntamain" ).toggle( "slow", function(){
    	$("html, body").animate({scrollTop:$('#publishpreguntamain').position().top}, 'slow');
    });
  });
};

</script>

<div id="addbutton" class="addbutton publish" ><?php the_svg_icon('add');?></div>
	<div id="publishpreguntamain" class="main" style="display: none;">
    <h2 class="list-title">Publicar pregunta</h2>
  	<div class="avise notice" id="avise">
  		<?php if(!get_option("publication_sup") || !get_option("publication_sup_p")) echo '<p class="notice">Las aportaciones serán revisadas por un administrador antes de ser publicadas.</p>';?>
  	</div> 
    
		<form action="" class="post-form" method="POST" onsubmit="return validateForm(this);">
      <fieldset> 
          <input type="text" name="postformtitle" id="postformtitle" class="postformtitle" class="required" value="<?php if ( isset( $_POST['postformtitle'] ) ) echo $_POST['postformtitle']; ?>" placeholder="Título"/>
      </fieldset>
      <fieldset>         
        <?php
          $content = '';
          $editor_id = 'postcontent';
          $settings = array(
            'media_buttons' => false,
            'textarea_name' => 'postformdesc',
            'textarea_rows' => 10,
          );
          wp_editor( $content, $editor_id, $settings );
        ?>
      </fieldset>
      <fieldset>
        <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
        <input type="hidden" name="submitted" id="submitted" value="true" />
        <button type="submit" class="submit button"><?php _e('Publicar', 'framework') ?></button>
      </fieldset>
      
		</form>
</div>

<?php
  
if(get_option("publication_sup") && get_option("publication_sup_p")) $publish_status = 'publish';
else $publish_status = 'pending';
  
if ( isset( $_POST['submitted'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {
    if (
      	(trim($_POST['postformtitle']) === '') ||
      	($_POST['postformdesc'] == '')
       ){
      $hasError = true;
    }
  	if(!$hasError){
      $post_information = array(
          'post_title' => wp_strip_all_tags( $_POST['postformtitle'] ),
        	'post_content' => $_POST['postformdesc'],
          'post_type' => 'preguntas',
          'post_status' => $publish_status,
      );
      $post_id = wp_insert_post( $post_information );
      if(!get_option("publication_sup") || !get_option("publication_sup_p")) post_created_send_email($post_id);
      
    	if ( $post_id ) {
          wp_redirect( 'http://xn--diseadoresindustriales-nec.es/preguntas/?send=ok' );
          exit;
      } 
    } 
}
?>
<?php } ?>
