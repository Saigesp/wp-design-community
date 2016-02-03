<?php if((is_user_role('author') && get_option("publication_act")) || is_user_role('administrator') || is_user_role('editor')){ 
  
$field_type_key = "field_54cdfc0f8a1b9";
$field_type = get_field_object($field_type_key);
$field_tema_key = "field_54cde64cc9828";
$field_tema = get_field_object($field_tema_key);
  

?>

<script>
$(document).ready(function() {
    $("#postformdate").datepicker({
  		dateFormat: 'd/m/yy', //este formato se aplica al cuando carga
  		minDate: 0, //fecha actual
      altField: "#postformdateactual",
      altFormat: "yymmdd",
  	});
 
  	$(function($){
	    $.datepicker.regional['es'] = {
	        closeText: 'Cerrar',
	        prevText: 'Ant',
	        nextText: 'Sig',
	        currentText: 'Hoy',
	        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	        monthNamesShort: ['Jan','Feb','Mar','Apr', 'May','Jun','Jul','Aug','Sep', 'Oct','Nov','Dec'],
	        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	        weekHeader: 'Sm',
	        dateFormat: 'd/m/yy', //este formato se aplica una vez hecho click
	        firstDay: 1,
	        isRTL: false,
	        showMonthAfterYear: false,
	        yearSuffix: ''
	    };
	    $.datepicker.setDefaults($.datepicker.regional['es']);
   });
 
});  
  
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
  if(form.postformdate.value == '') {
    var p = document.createElement("P"); var t = document.createTextNode("Elige una fecha de inicio!");
  	p.appendChild(t); p.className = "error"; document.getElementById("avise").appendChild(p); document.getElementById("avise").className = "avise error";
    form.postformdate.focus();
    return false;
  }
  if(form.postformcity.value == '') {
    var p = document.createElement("P"); var t = document.createTextNode("La ciudad no debe estar vacía!");
  	p.appendChild(t); p.className = "error"; document.getElementById("avise").appendChild(p); document.getElementById("avise").className = "avise error";
    form.postformcity.focus();
    return false;
  }
  if(form.postformprice.value == '') {
    var p = document.createElement("P"); var t = document.createTextNode("Especifica un precio mínimo!");
  	p.appendChild(t); p.className = "error"; document.getElementById("avise").appendChild(p); document.getElementById("avise").className = "avise error";
    form.postformprice.focus();
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
    $( "#publisheventomain" ).toggle( "slow", function(){
    	$("html, body").animate({scrollTop:$('#publisheventomain').position().top}, 'slow');
    });
  });
};
</script>

<div id="addbutton" class="addbutton publish" ><?php the_svg_icon('add');?></div>

<div id="publisheventomain" class="main" style="display: none;">
    <h2 class="list-title">Publicar evento</h2>
  	<div class="avise notice" id="avise">
  		<?php if(!get_option("publication_sup") || !get_option("publication_sup_e")) echo '<p class="notice">Las aportaciones serán revisadas por un administrador antes de ser publicadas.</p>';?>
    </div>  
    
		<form action="" class="post-form" method="POST" onsubmit="return validateForm(this);">
      <fieldset>
        <select name="postformtype" class="postformtype" id="postformtype" onchange="changeType(this);">
          <option value="" disabled <?php if($_POST['postformtype'] == '') echo 'selected' ?>>Tipo de evento</option>
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
          <input type="text" name="postformtitle" id="postformtitle" class="postformtitle" class="required" value="<?php if ( isset( $_POST['postformtitle'] ) ) echo $_POST['postformtitle']; ?>" placeholder="Nombre"/>
      </fieldset>
      <fieldset> 
        	<input type="text" name="postformdate" id="postformdate" class="postformdate" class="required" value="<?php if ( isset( $_POST['postformdate'] ) ) echo $_POST['postformdate']; ?>" placeholder="Fecha de inicio"/>
        	<input type="text" name="postformdateactual" id="postformdateactual" class="postformdate" class="required" value="<?php if ( isset( $_POST['postformdateactual'] ) ) echo $_POST['postformdateactual']; ?>" style="display:none;"/>
          <input type="text" name="postformcity" id="postformcity" class="postformcity" class="required" value="<?php if ( isset( $_POST['postformcity'] ) ) echo $_POST['postformcity']; ?>" placeholder="Ciudad"/>
        	<input type="number" name="postformprice" id="postformprice" class="postformprice" class="required" value="<?php if ( isset( $_POST['postformprice'] ) ) echo $_POST['postformprice']; ?>" placeholder="Precio mínimo"/>
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
  
if(get_option("publication_sup") && get_option("publication_sup_e")) $publish_status = 'publish';
else $publish_status = 'pending';
  
if ( isset( $_POST['submitted'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {
    if (
      	(trim($_POST['postformtitle']) === '') ||
       	($_POST['postformtype'] == 'asociacion' && $_POST['postformtype'] == '') ||
      	($_POST['postformcity'] == '') ||
      	($_POST['postformtype'] == '') ||
      	($_POST['postformtema'] == '') ||
      	(!is_numeric($_POST['postformprice'])) ||
      	(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$_POST['postformurl'])) ||
      	(!validateDate($_POST['postformdateactual'])) ||
      	(!$checkdate)
       ){
      $hasError = true;
    }
  	if(!$hasError){
      $post_information = array(
          'post_title' => wp_strip_all_tags( $_POST['postformtitle'] ),
          'post_type' => 'eventos',
          'post_status' => 'pending',
      );
      $post_id = wp_insert_post( $post_information );
      if(!get_option("publication_sup") || !get_option("publication_sup_e")) post_created_send_email($post_id);
      
      update_post_meta( $post_id, 'ciudad', $_POST['postformcity'] );
      update_post_meta( $post_id, 'type', $_POST['postformtype'] );
      update_post_meta( $post_id, 'tema', $_POST['postformtema'] );
      update_post_meta( $post_id, 'enlace', $_POST['postformurl'] );
      update_post_meta( $post_id, 'precio', $_POST['postformprice'] );
      update_post_meta( $post_id, 'fecha_de_inicio', $_POST['postformdateactual'] );
      
    	if ( $post_id ) {
          wp_redirect( 'http://xn--diseadoresindustriales-nec.es/eventos/?send=ok' );
          exit;
      } 
    }
} 
?>
<?php } ?>
