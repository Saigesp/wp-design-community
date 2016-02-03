
<?php if((is_user_role('author') && get_option("publication_act")) || is_user_role('administrator') || is_user_role('editor')){ 
  
$field_type_key = "field_549c3e65c3091";
$field_type = get_field_object($field_type_key);
$field_tema_key = "field_549c3fffaf5af";
$field_tema = get_field_object($field_tema_key);

?>


<script>
function changeType(sel){
  if (sel.value == 'asociacion'){
    $('#postformdesc').attr("placeholder", "Ámbito de actuación (ciudad, comunidad, país)");
    $('#postformtitle').css("width", "74%");
    $('#postformsiglas').css("display", "initial");
  }else{
    $('#postformdesc').attr("placeholder", "Descripción breve");
    $('#postformtitle').css("width", "100%");
    $('#postformsiglas').css("display", "none");
  }
}
  

function validateForm(form){
  document.getElementById("avise").innerHTML = "";
  if(form.postformtype.value == '') {
    var p = document.createElement("P"); var t = document.createTextNode("Debes elegir un tipo de enlace!");
  	p.appendChild(t); p.className = "error"; document.getElementById("avise").appendChild(p); document.getElementById("avise").className = "avise error";
    form.postformtype.focus();
    return false;
  }
  if(form.postformtema.value == '') {
    var p = document.createElement("P"); var t = document.createTextNode("Debes elegir una temática!");
  	p.appendChild(t); p.className = "error"; document.getElementById("avise").appendChild(p); document.getElementById("avise").className = "avise error";
    form.postformtema.focus();
    return false;
  }
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
  if(form.postformurl.value == '') {
    var p = document.createElement("P"); var t = document.createTextNode("Debes especificar la dirección url!");
  	p.appendChild(t); p.className = "error"; document.getElementById("avise").appendChild(p); document.getElementById("avise").className = "avise error";
    form.postformurl.focus();
    return false;
  }
  return true;
}
  
  
window.onload = function() {
  $("#addbutton").click(function() {
    $( "#publishenlacemain" ).toggle( "slow", function(){
    	$("html, body").animate({scrollTop:$('#publishenlacemain').position().top}, 'slow');
    });
  });
};

</script>

<div id="addbutton" class="addbutton publish" ><?php the_svg_icon('add');?></div>
	<div id="publishenlacemain" class="main" style="display: none;">
    <h2 class="list-title">Publicar enlace</h2>
  	<div class="avise notice" id="avise">
  		<?php if(!get_option("publication_sup") || !get_option("publication_sup_l")) echo '<p class="notice">Las aportaciones serán revisadas por un administrador antes de ser publicadas.</p>';?>
  	</div> 
    
		<form action="" class="post-form" method="POST" onsubmit="return validateForm(this);">
      <fieldset>
        <select name="postformtype" class="postformtype" id="postformtype" onchange="changeType(this);">
          <option value="" disabled <?php if($_POST['postformtype'] == '') echo 'selected' ?>>Tipo de enlace</option>
          <?php foreach( $field_type['choices'] as $k => $v ){
  								echo '<option value="'.$k.'"';
  								if($k == $_POST['postformtype']) echo ' selected';
  								echo '>'.$v.'</option>';
								}?>
        </select>
        <select name="postformtema" class="postformtema" id="postformtema">
  				<option value="" disabled <?php if($_POST['postformtema'] == '') echo 'selected' ?>>Temática</option>
          <?php foreach( $field_tema['choices'] as $k => $v ){
  								echo '<option value="'.$k.'"';
  								if($k == $_POST['postformtema']) echo ' selected';
  								echo '>'.$v.'</option>';
								}?>
        </select>
      </fieldset>
      <fieldset> 
          <input type="text" name="postformtitle" id="postformtitle" class="postformtitle" class="required" value="<?php if ( isset( $_POST['postformtitle'] ) ) echo $_POST['postformtitle']; ?>" placeholder="Título"/>
        	<input type="text" name="postformsiglas" id="postformsiglas" class="postformsiglas" class="required" value="<?php if ( isset( $_POST['postformsiglas'] ) ) echo $_POST['postformsiglas']; ?>" placeholder="Siglas (ACCB)"  style="display:none; width: 25%;"/>
      </fieldset>
      <fieldset> 
          <input type="text" name="postformdesc" id="postformdesc" class="postformdesc" class="required" value="<?php if ( isset( $_POST['postformdesc'] ) ) echo $_POST['postformdesc']; ?>" placeholder="Descripción breve"/>
      </fieldset>
      <fieldset> 
          <input type="text" name="postformurl" id="postformurl" class="postformurl" class="required" value="<?php if ( isset( $_POST['postformurl'] ) ) echo $_POST['postformurl']; ?>" placeholder="Enlace http://"/>
      </fieldset>
      
      <fieldset>
        <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
        <input type="hidden" name="submitted" id="submitted" value="true" />
        <button type="submit" class="submit button"><?php _e('Publicar', 'framework') ?></button>
      </fieldset>
      
		</form>
</div>

<?php
  
if(get_option("publication_sup") && get_option("publication_sup_l")) $publish_status = 'publish';
else $publish_status = 'pending';
  
if ( isset( $_POST['submitted'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {
    if (
      	(trim($_POST['postformtitle']) === '') ||
       	($_POST['postformtype'] == 'asociacion' && $_POST['postformtype'] == '') ||
      	($_POST['postformdesc'] == '') ||
      	($_POST['postformtype'] == '') ||
      	($_POST['postformtema'] == '') ||
      	(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$_POST['postformurl']))
       ){
      $hasError = true;
    }
  	if(!$hasError){
      $post_information = array(
          'post_title' => wp_strip_all_tags( $_POST['postformtitle'] ),
          'post_type' => 'enlaces',
          'post_status' => $publish_status,
      );
      $post_id = wp_insert_post( $post_information );
      if(!get_option("publication_sup") || !get_option("publication_sup_l")) post_created_send_email($post_id);
      
      update_post_meta( $post_id, 'descripcion', $_POST['postformdesc'] );
      update_post_meta( $post_id, 'type', $_POST['postformtype'] );
      update_post_meta( $post_id, 'tema', $_POST['postformtema'] );
      update_post_meta( $post_id, 'enlace', $_POST['postformurl'] );
      
    	if ( $post_id ) {
          wp_redirect( 'http://xn--diseadoresindustriales-nec.es/enlaces/?send=ok' );
          exit;
      } 
    } 
}
?>
<?php } ?>
