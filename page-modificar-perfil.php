<?php get_header(); ?>

<?php
$edit = $_GET["edit"];
global $current_user, $wp_roles;
get_currentuserinfo();
require_once( ABSPATH . WPINC . '/registration.php' );
$error = array();    

if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'send-dubte' ) email_user_dubtes($current_user->ID, $_POST['text-dubte']);

if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
    if (!empty($_POST['email'])){
        if (!is_email(esc_attr( $_POST['email'] ))) $error[] = __('El email introducido no es válido, por favor inténtalo de nuevo.', 'profile');
        elseif(email_exists(esc_attr( $_POST['email'] )) && esc_attr($_POST['email']) != get_the_author_meta('user_email', $current_user->ID) ) $error[] = __('El email introducido ya está siendo usado por otro usuario, prueba con uno diferente', 'profile');
        else wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
    }
        if(!empty($_POST['action-rrss']) && $_POST['action-rrss'] == 'update-rrss'){
          if (!empty($_POST['user_url'])) wp_update_user( array ('ID' => $current_user->ID, 'user_url' => esc_attr( $_POST['user_url'] )));
          
          if ($_POST['twitter'][0] == '@') $_POST['twitter'] = substr($_POST['twitter'], 1); 
          if (substr($_POST['twitter'], 0, 4) == 'http') $_POST['twitter'] = substr(strrchr($_POST['twitter'], "/"), 1);
          update_user_meta( $current_user->ID, 'twitter', esc_attr( $_POST['twitter'] ) );
          
          if (substr($_POST['facebook'], 0, 4) == 'http') $_POST['facebook'] = substr(strrchr($_POST['facebook'], "/"), 1);
          update_user_meta( $current_user->ID, 'facebook', esc_attr( $_POST['facebook'] ) );
          
          if (substr($_POST['linkedin'], 0, 56) == 'https://www.linkedin.com/profile/public-profile-settings') $_POST['linkedin'] = '';
          update_user_meta( $current_user->ID, 'linkedin', esc_attr( $_POST['linkedin'] ) );
          
          update_user_meta( $current_user->ID, 'tumblr', esc_attr( $_POST['tumblr'] ) );
          
          if (substr($_POST['behance'], 0, 4) == 'http') $_POST['behance'] = substr(strrchr($_POST['behance'], "/"), 1);
          update_user_meta( $current_user->ID, 'behance', esc_attr( $_POST['behance'] ) );
          
          if (substr($_POST['domestika'], 0, 4) == 'http') $_POST['domestika'] = substr(strrchr($_POST['domestika'], "/"), 1);
          update_user_meta( $current_user->ID, 'domestika', esc_attr( $_POST['domestika'] ) );
        }
  			if (!empty($_POST['async-upload'])) update_user_meta( $current_user->ID, 'foto_personal', $_POST['html-upload'] );  
  
  			if (!empty($_POST['last-name']) && !empty($_POST['last-name'])){
          update_user_meta( $current_user->ID, 'first_name', esc_attr($_POST['first-name']));
          update_user_meta($current_user->ID, 'last_name', esc_attr($_POST['last-name']));
        }
  
        if (!empty($_POST['pseudonimo'])) update_user_meta($current_user->ID, 'pseudonimo', esc_attr( $_POST['pseudonimo'] ) );
        if (!empty($_POST['description'])) update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );
        if (!empty($_POST['titulacion'])) update_user_meta( $current_user->ID, 'titulacion', esc_attr( $_POST['titulacion'] ) );
        if (!empty($_POST['centro_de_estudios'])) update_user_meta( $current_user->ID, 'centro_de_estudios', esc_attr( $_POST['centro_de_estudios'] ) );
		    if (!empty($_POST['region'])) update_user_meta( $current_user->ID, 'region', $_POST['region']); 
				if (!empty($_POST['type']))	update_user_meta( $current_user->ID, 'type', $_POST['type']);
  			if (!empty($_POST['perfil_publico'])){
          update_user_meta( $current_user->ID, 'perfil_publico', $_POST['perfil_publico']);
          global $wp_rewrite;
					$wp_rewrite->flush_rules( false );
          user_pending_email( $current_user->ID );
        }
  
  if(isset($_POST['especialidad'])){
  	if (sizeof($_POST['especialidad']) > 3) {
      $error[] = __('Solo puedes seleccionar 3 áreas de experiencia como máximo.', 'profile');
    } else {
    	update_user_meta( $current_user->ID, 'especialidad', $_POST['especialidad']); 
		}
  } 
    if ( count($error) == 0 ) {
        do_action('edit_user_profile_update', $current_user->ID);
        wp_redirect( get_permalink() );
        exit;
    }

  }
  
function insert_attachment_foto($file_handler,$user_id,$setthumb='false', $img_p) {
		if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) return __return_false(); 
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		$user_id =  get_current_user_id();
		if ($setthumb && $img_p == 10){
      $attach_id = media_handle_upload( $file_handler, $user_id );
      update_usermeta( $user_id, 'foto_personal', $attach_id );
      header('Location: ?');
    }
  return $attach_id; 
}

function insert_attachment_proyecto($file_handler,$user_id,$setthumb='false', $img_p) {
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		$user_id =  get_current_user_id();
    if ($setthumb && $img_p == 1){ 
      $attach_id = media_handle_upload( $img_p-1, $user_id );
      update_usermeta( $user_id, 'img_p1', $attach_id );
      header('Location: #no-autoplay-0');
    }
    if ($setthumb && $img_p == 2){
      $attach_id = media_handle_upload( $img_p-1, $user_id );
      update_usermeta( $user_id, 'img_p2', $attach_id );
      header('Location: #no-autoplay-1');
    } 
    if ($setthumb && $img_p == 3){
      $attach_id = media_handle_upload( $img_p-1, $user_id );
      update_usermeta( $user_id, 'img_p3', $attach_id );
      header('Location: #no-autoplay-2');
    }
  return $attach_id; 
}

if ($_FILES) {
  
  	$post_id="";
		$ext = substr(strrchr($_FILES['file_upload0']['name'],"."),1);
		$allowed_ext=array('gif','jpg','jpeg','png');
		$ext = strtolower($ext);
		if (in_array($ext, $allowed_ext)) {
        $imgp = 10;
				foreach ( $_FILES as $file => $array ) { $newupload = insert_attachment_foto( $file, $post_id,$setthumb='false', $imgp ); }
    }
  
    function reArrayFiles($file_post) {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);
        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_ary;
    }
    $_FILES = reArrayFiles($_FILES['file_upload']);
 

    $imgp = 0;
		for ($i=0; $i<3; $i++) {
            $ext = substr(strrchr($_FILES[$i]["name"],"."),1);
            $ext = strtolower($ext);
            $imgp++;
          	if ($ext == '') continue;
            if (in_array($ext, $allowed_ext)) {
                $newupload = insert_attachment_proyecto( 'file_upload', $post_id,$setthumb='false', $imgp );
            }else{
                $error[] = __('Solo se permiten formatos GIF JPG JPEG y PNG<br>', 'profile');
            }
    } 	
}

  
  
  

?>

<script>

$(function(){
  	$("#file_upload0").change(showPreviewImage0_click);
  	$("#file_upload1").change(showPreviewImage1_click);
    $("#file_upload2").change(showPreviewImage2_click);
  	$("#file_upload3").change(showPreviewImage3_click);
})
  
function showPreviewImage0_click(e) {
    var $input = $(this);
    var inputFiles = this.files;
    if(inputFiles == undefined || inputFiles.length == 0) return;
    var inputFile = inputFiles[0];
		var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
  	var extension = inputFile.name.split('.').pop().toLowerCase();
    var isSuccess = fileTypes.indexOf(extension) > -1;  
  	if (isSuccess) {
      var reader = new FileReader();
      reader.onload = function(event) {
          $('#upfile0').attr("src", event.target.result);
        	$('#image0help').css('display', 'none');
        	$('#frm0_save').css('display','initial');
        	$input.siblings('.imagesave').css('background-color', '#F46553').click(function() { var input = this; input.disabled = false; });    
      };
      reader.readAsDataURL(inputFile);
      
    }else {
      alert('Formatos permitidos: jpg, gif, png');
    }
    reader.onerror = function(event) {
        alert("ERROR: " + event.target.error.code);
    };
}

function showPreviewImage1_click(e) {
    var $input = $(this);
    var inputFiles = this.files;
    if(inputFiles == undefined || inputFiles.length == 0) return;
    var inputFile = inputFiles[0];
		var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
  	var extension = inputFile.name.split('.').pop().toLowerCase();
    var isSuccess = fileTypes.indexOf(extension) > -1;  
  	if (isSuccess) {
      var reader = new FileReader();
      reader.onload = function(event) {
          $input.next().attr("src", event.target.result);
        	$('#figure0').css('background-image', 'url('+event.target.result+')');  
        	$('#imagesave3').css('display', 'initial');
        	$('#frm1_back').prop('value', 'Descartar cambios').css('background-color', 'crimson');
        	
      };
      reader.readAsDataURL(inputFile);
      
    }else {
      alert('Formatos permitidos: jpg, gif, png');
    }
    reader.onerror = function(event) {
        alert("ERROR: " + event.target.error.code);
    };
}  
  
function showPreviewImage2_click(e) {
    var $input = $(this);
    var inputFiles = this.files;
    if(inputFiles == undefined || inputFiles.length == 0) return;
    var inputFile = inputFiles[0];
		var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
  	var extension = inputFile.name.split('.').pop().toLowerCase();
    var isSuccess = fileTypes.indexOf(extension) > -1;  
  	if (isSuccess) {
      var reader = new FileReader();
      reader.onload = function(event) {
          $input.next().attr("src", event.target.result);
        	$('#figure1').css('background-image', 'url('+event.target.result+')');  
        	$('#imagesave3').css('display', 'initial');
        	$('#frm1_back').prop('value', 'Descartar cambios').css('background-color', 'crimson');
      };
      reader.readAsDataURL(inputFile);
      
    }else {
      alert('Formatos permitidos: jpg, gif, png');
    }
    reader.onerror = function(event) {
        alert("ERROR: " + event.target.error.code);
    };
}
  
function showPreviewImage3_click(e) {
    var $input = $(this);
    var inputFiles = this.files;
    if(inputFiles == undefined || inputFiles.length == 0) return;
    var inputFile = inputFiles[0];
		var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
  	var extension = inputFile.name.split('.').pop().toLowerCase();
    var isSuccess = fileTypes.indexOf(extension) > -1;  
  	if (isSuccess) {
      var reader = new FileReader();
      reader.onload = function(event) {
          $input.next().attr("src", event.target.result);
        	$('#figure2').css('background-image', 'url('+event.target.result+')');  
        	$('#imagesave3').css('display', 'initial');
        	$('#frm1_back').prop('value', 'Descartar cambios').css('background-color', 'crimson');
      };
      reader.readAsDataURL(inputFile);
      
    }else {
      alert('Formatos permitidos: jpg, gif, png');
    }
    reader.onerror = function(event) {
        alert("ERROR: " + event.target.error.code);
    };
}
</script>

<?php if(get_the_author_meta( 'type', $current_user->ID) != 'estudiante' && get_the_author_meta( 'type', $current_user->ID) != 'profesional' && get_the_author_meta( 'type', $current_user->ID) != 'estudio'){ ?>

<script type="text/javascript">
  function validateForm(form){
    var check = document.getElementById("tos");
    if(!check.checked) {
      alert("Debes aceptar los términos y condiciones");
      return false;
    }
    return true;
  }

</script>

<div id="page-new-user">
	<div class="center twocolumn"> 
		<h2>Bienvenido a diseñadoresindustriales.es</h2>
    <p>Estás a punto de iniciar el proceso de registro y verificación en esta página. Para ello, será necesario que completes tu perfil con información veraz, ya que posteriormente será comprobada y validada por el resto de usuarios. Te recomendamos que tengas preparado un breve texto que describa tu trabajo y explique tus aptitudes, además de una fotografía personal y tres imágenes de algunos de tus proyectos.</p>
		<p><br>Una vez registrado tendrás que ser aceptado por la comunidad, pero no te preocupes, no tendrás ningún problema si cumples los <a href="http://xn--diseadoresindustriales-nec.es/faqs/#faq289">requisitos mínimos</a>.</p>
		<p><br>Los administradores se reservan el derecho de no aceptar o dar de baja todos aquellos perfiles que no cumplan los requisitos mínimos exigidos.</p>
		<p><br>Nos alegramos de que quieras pertenecer al directorio y esperamos que participes en él.</p>
    <p><form id="tosform" action="" style="margin: 40px 0; text-align: center;"><input name="tos" type="checkbox" id="tos" value="1"/>He leido y acepto los <a href="http://xn--diseadoresindustriales-nec.es/terminos-y-condiciones/">términos y condiciones</a> de uso</form>
    <form method="post" id="adduser1" action="" style="display: inline;" onsubmit="return validateForm(this);">
      <input name="action" type="hidden" id="action" value="update-user" />
      <input type="hidden" value="profesional" id="type" name="type" style="display: none;">
    	<input type="submit" value="Registro como profesional" name="Submit" id="frm1_submit" class="submit button"/>
		</form>
    <form method="post" id="adduser2" action="" style="display: inline;" onsubmit="return validateForm(this);">
      <input name="action" type="hidden" id="action" value="update-user" />
      <input type="hidden" value="estudio" id="type" name="type" style="display: none;">
    	<input type="submit" value="Registro como estudio" name="Submit" id="frm1_submit"  class="submit button"/>
		</form>
    <form method="post" id="adduser3" action="" style="display: inline;" onsubmit="return validateForm(this);">
      <input name="action" type="hidden" id="action" value="update-user" />
      <input type="hidden" value="estudiante" id="type" name="type" style="display: none;">
    	<input type="submit" value="Registro como estudiante" name="Submit" id="frm1_submit"  class="submit button"/>
		</form>
	</div>
</div>
<?php } else { ?>
  
<div id="doublebox">
<div id="page-4" <?php if(!is_user_logged_in()){ echo 'style="margin: 0 auto; display: block;"';}?> >
        <div class="profilebox onecolumn">    
          <div <?php if(is_user_logged_in()){ echo 'class="profile-header"';}?>>          
<?php if ($errors) echo "<p class='bold red'>Hubo un error subiendo tu archivo.</p>"; ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php if ( !is_user_logged_in() ) : ?>
            		<div class="profile-login">
                    <p class="bold red">
                        <?php _e('Por favor, inicia sesión para continuar', 'profile'); ?>
                      <br><br>
                    </p><!-- .warning -->
          					<?php get_template_part( 'login' ); ?>
                  </div>
            <?php else : ?>
                		<?php if ( count($error) > 0 ) echo '<p class="bold red">' . implode("<br />", $error) . '</p>'; ?>

<?php 
$arrayperfil = array();

$field_type_key = "field_5466c03bc4f5a";
$field_type = get_field_object($field_type_key); 

$field_key = "field_5462990a3dbd6";
$field = get_field_object($field_key);
$especial = get_the_author_meta('especialidad', $current_user->ID );

$field_reg_key = "field_54629963a5d54";
$field_reg = get_field_object($field_reg_key);
$region = get_the_author_meta('region', $current_user->ID );

$image = get_the_author_meta('foto_personal', $current_user->ID );
$img_p1 = get_the_author_meta('img_p1', $current_user->ID );
$img_p2 = get_the_author_meta('img_p2', $current_user->ID );
$img_p3 = get_the_author_meta('img_p3', $current_user->ID );
$img_p1e = wp_get_attachment_image_src(get_the_author_meta('img_p1', $current_user->ID ), array(280, 190));
$img_p2e = wp_get_attachment_image_src(get_the_author_meta('img_p2', $current_user->ID ), array(280, 190));
$img_p3e = wp_get_attachment_image_src(get_the_author_meta('img_p3', $current_user->ID ), array(280, 190));
?>
          

<!-- 

FOTO PROYECTOS

-->
            
<?php
$img[] = array($img_p1e[0], $img_p2e[0], $img_p3e[0]);
if ($img[0][0] != '') array_push($arrayperfil, "imgp1");
if ($img[0][1] != '') array_push($arrayperfil, "imgp2");
if ($img[0][2] != '') array_push($arrayperfil, "imgp3");

?>
<div class="profile-proyectos">
  <?php if($edit != "foto_proyecto") {?>
		<div class="profile-project-overlay">
    		<a href="?edit=foto_proyecto">
        		<?php the_svg_icon("edit");?>
        </a>
    </div>
  <?php } ?>
		<div class="gallery" style="height: 180px;">
 				<?php foreach ($img[0] as $c => $k){ ?>
						<div id="no-autoplay-<?php echo $c;?>" class="control-operator"></div> 
  			<?php } reset($img); ?>
 				<?php foreach ($img[0] as $c => $k){ ?>
						<figure class="item profile-foto-proyecto" style="background-image:url('<?php echo $k;?>');" id="figure<?php echo $c;?>"></figure>
  			<?php } reset($img); ?>
						<div class="controls">
 								<?php foreach ($img[0] as $c => $k){ ?>
										<a href="#no-autoplay-<?php echo $c;?>" class="control-button" id="autoplay<?php echo $c;?>">•</a>
  							<?php } reset($img); ?>
						</div>
		</div>
</div>
            
<?php if($edit != "foto_proyecto") { ?>
<!-- 

FOTO PERSONAL

-->
<?php if ($edit=="foto_personal") { ?><form role="form" id="frmSignup1" method="post" action="" enctype="multipart/form-data"><?php } ?>
<?php if( $image ) { ?>
<?php array_push($arrayperfil, "foto_personal");?>
  		<div class="profile-foto" <?php if ($edit =="foto_personal") echo 'style="cursor:pointer;"'; ?>>
        <?php if ($edit !="foto_personal") { ?>
          <div class="profile-foto-overlay">
            <a href="?edit=foto_personal">
            <?php the_svg_icon("edit");?>
            </a>
          </div>
        <?php } ?>
          <?php echo wp_get_attachment_image( $image,array(100, 100), false, 'id=upfile0' );?>
     </div>
<?php }else{ ?>
  		<div class="profile-foto" <?php if ($edit =="foto_personal") echo 'style="cursor:pointer;"'; ?>>
       	<?php if ($edit !="foto_personal") { ?>
          <div class="profile-foto-overlay">
            <a href="?edit=foto_personal">
            <?php the_svg_icon("edit");?>
            </a>
          </div>
        <?php } ?>
          <img src="<?php echo get_template_directory_uri(); ?>/img/nofoto.png" id="upfile0" width="100" height="100"/>
     </div>
<?php } ?>
          
<?php if ($edit=="foto_personal") { ?>
<p class="form-upload" style="display: inline-block;"> 
  <span id="image0help">Haz click en la imagen para cambiarla</span>
		<input type="file" name="file_upload0" onchange='return Test.UpdatePreview(this);' loname="exampleimage" id="file_upload0" style="display:none;">
  <?php if( $image ) { ?>
		<input type="submit" value="Cambiar imagen" id="frm0_save" class="submit button imagesave" style="display:none;"/>
  <?php }else{ ?>
		<input type="submit" value="Guardar imagen" id="frm0_save" class="submit button imagesave" style="display:none;"/>
  <?php } ?>
</p>
</form>  
  <form action="/modificar-perfil/" method="post" id="formreturn">
    <input type="submit" value="Cancelar" name="Submit" id="frm1_back" style="background-color:crimson;"/>
</form>
<?php } ?>
          
</div>
<div class="profile-body">

<!-- 

NOMBRE APELLIDO Y PSEUDONIMO

-->
  
<?php if($edit != "foto_personal") { ?>

<?php if ($edit=="nombre") { ?>
<form method="post" id="adduser" action="<?php the_permalink(); ?>">
<p class="form-text  input-top-p">
  	<?php if(get_the_author_meta( 'type', $current_user->ID) != 'estudio'){ ?>
  		<input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
      <label for="first-name">Nombre</label>
      <?php the_svg_icon("nombre");?>
      <span class="underinput">Tu nombre real</span>
  	<?php }else{ ?>
  		<input class="text-input" name="first-name" type="text" id="first-name" value="Estudio" style="display:none;"/>
		<?php } ?>
</p><!-- .form-username -->
<p class="form-text">
		<input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" />
  	<?php if(get_the_author_meta( 'type', $current_user->ID) != 'estudio'){ ?>
      <label for="last-name"><?php _e('Apellidos', 'profile'); ?></label>
      <?php the_svg_icon("apellidos");?>
      <span class="underinput">Tus apellidos reales</span>
  	<?php }else{ ?>
      <label for="last-name"><?php _e('Nombre del estudio', 'profile'); ?></label>
      <?php the_svg_icon("apellidos");?>
      <span class="underinput">Nombre o marca de tu estudio</span>
  	<?php } ?>
</p><!-- .form-username -->
<?php if(get_the_author_meta( 'type', $current_user->ID) != 'estudio'){ ?>
  <p class="form-text">
      <input class="text-input" name="pseudonimo" type="text" id="pseudonimo" value="<?php the_author_meta( 'pseudonimo', $current_user->ID ); ?>" />
      <label for="pseudonimo"><?php _e('Pseudónimo', 'profile'); ?></label>
      <?php the_svg_icon("pseudonimo");?>
      <span class="underinput">Alias / Apodo / Empresa / Estudio...</span>
  </p><!-- .form-username -->
<?php } ?>
<p class="form-submit">
		<?php echo $referer; ?>
    <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Guardar', 'profile'); ?>" />
    <?php wp_nonce_field( 'update-user' ) ?>
    <input name="action" type="hidden" id="action" value="update-user" />
</p><!-- .form-submit -->  
</form>  
<?php } else { ?>   

<div class="profile-text-overlay">
<p class="username">
<?php if(get_the_author_meta('first_name',$current_user->ID) != '' && get_the_author_meta('last_name',$current_user->ID) != '') {
  				array_push($arrayperfil, "name");
  				if(get_the_author_meta( 'type', $current_user->ID) != 'estudio'){
            echo get_the_author_meta('first_name',$current_user->ID ).' ';
          }
  				echo get_the_author_meta('last_name',$current_user->ID );
			} else {
  				if(get_the_author_meta( 'type', $current_user->ID) != 'estudio'){
  					echo "Nombre y apellidos";
          }else{
          	echo "Nombre del estudio";
          }
  		}
?>
</p>
<p class="pseudonimo">
<?php echo get_the_author_meta( 'pseudonimo', $current_user->ID );?>
</p>  
<a href="?edit=nombre">
<?php the_svg_icon("edit");?>
</a>
</div>
<?php } ?> 

<!-- 

ESPECIALIDAD

-->

<?php

if (get_the_author_meta( 'titulacion', $current_user->ID ) != '') array_push($arrayperfil, "titulacion");
if (get_the_author_meta( 'centro_de_estudios', $current_user->ID ) != '') array_push($arrayperfil, "centro_de_estudios");

if ($edit=="especialidad") { ?>
<form method="post" id="adduser" action="<?php the_permalink(); ?>">

<?php if(get_the_author_meta( 'type', $current_user->ID) != 'estudio'){ ?>
  <p class="radio input-top">
      <input class="radio" name="type" type="radio" id="type" onclick="inProfessional()" <?php if (get_the_author_meta( 'type', $current_user->ID ) == "profesional") echo "checked";?> value="profesional" /> Profesional
    <?php /*
      <input class="radio" name="type" type="radio" id="type" onclick="inStudy()" <?php if (get_the_author_meta( 'type', $current_user->ID ) == "estudio") echo "checked";?> value="estudio" /> Estudio
  */ ?>
      <input class="radio" name="type" type="radio" id="type" onclick="inStudent()" <?php if (get_the_author_meta( 'type', $current_user->ID ) == "estudiante") echo "checked";?> value="estudiante" /> Estudiante
      <label for="type"><?php _e('Tipo de perfil', 'profile') ?></label>
      <?php the_svg_icon("type");?>
  </p>
<?php } ?>
  
<p class="form-text" id="p-titulacion">
		<input class="text-input" name="titulacion" type="text" id="titulacion" value="<?php the_author_meta( 'titulacion', $current_user->ID ); ?>" />
    <label for="titulacion"><?php _e('Titulación', 'profile') ?></label>
		<?php the_svg_icon("titulacion");?>
  	<?php if(get_the_author_meta( 'type', $current_user->ID) != 'estudio'){ ?>
  		<span class="underinput">Nombre completo de tu titulación</span>
  	<?php }else{ ?>
  		<span class="underinput">Titulación del diseñador industrial de tu estudio</span>
  	<?php } ?>
</p>
<p class="form-text" id="p-centro_de_estudios">
		<input class="text-input" name="centro_de_estudios" type="text" id="centro_de_estudios" value="<?php the_author_meta( 'centro_de_estudios', $current_user->ID ); ?>" />
    <label for="centro_de_estudios"><?php _e('Centro de estudios', 'profile') ?></label>
		<?php the_svg_icon("centro");?>
  	<span class="underinput">Centro de estudios y/o universidad</span>
</p>
  
<div class="p-multiform" id="p-especialidad">
    <?php if (empty($especial)) $especial = array();?>
		<?php if( $field ){
          	echo "<div class='multiselect'>";
                foreach( $field['choices'] as $k => $v ){
                  	echo '<div class="multiselect-option"><input type="checkbox" name="especialidad[]" value="'.$k.'"';
                    if(in_array($k, $especial)) echo " checked";
                    echo ' /><label>';
                    the_speciality_name($k);
                    echo '</label></div>';
                }
          	echo "</div>";
      } ?>
		<label for="description"><?php _e('Experiencia', 'profile') ?></label>
		<?php the_svg_icon("especialidad");?>
   	<span class="underinput">Selecciona un <span class="pink">máximo de 3</span> áreas de experiencia.</span> 
</div>
  
<div class="p-multiform" id="p-region">
		<?php if( $field_reg ){
          	echo "<div class='multiselect'>";
                foreach( $field_reg['choices'] as $q => $z ){
                  	echo '<div class="multiselect-option"><input type="radio" name="region" value="'.$q.'"';
                    if($q == $region) { echo " checked"; }
                    echo ' /><label>';
                    echo $z;
                    echo '</label></div>'; 
                }
          	echo "</div>";
      } ?>
		<label for="description"><?php _e('Provincia', 'profile') ?></label>
		<?php the_svg_icon("region");?>
   	<span class="underinput">Selecciona tu provincia</span> 
  <?php ?>
</div><!-- .form-textarea -->

<p class="form-submit">
		<?php echo $referer; ?>
    <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Guardar', 'profile'); ?>" />
    <?php wp_nonce_field( 'update-user' ) ?>
    <input name="action" type="hidden" id="action" value="update-user" />
</p><!-- .form-submit -->
</form>    
<?php }else{ ?>
<div class="profile-text-overlay">
<p class="especialidad">
 <?php $especial = get_the_author_meta('especialidad', $current_user->ID ); ?>
                   	<?php if (empty($especial)==false){ ?>
  												<?php array_push($arrayperfil, "especialidad");?>
															<?php foreach ($especial as $esp) {
                                the_speciality_name( $esp );
                                echo ", ";
                                }
												?>
                 <?php }else{ ?>
                 Experiencia1, Experiencia2,
                 <?php } ?>
                    </p>
            				  <p class="region">
                        <?php $region = get_the_author_meta('region', $current_user->ID);
            									if($region != ''){
                                the_region_name($region);
                                array_push($arrayperfil, "region");
                                }
															else echo "Provincia";?>
                    </p>
<a href="?edit=especialidad">
<?php the_svg_icon("edit");?>
</a>
</div>
<?php } ?>  

<!-- 

DESCRIPCION

-->

<?php if ($edit=="descripcion") { ?>  
  <form method="post" id="adduser" action="<?php the_permalink(); ?>">
<p class="form-textarea input-top" style="margin-top: 50px;">
		<textarea name="description" id="description" rows="3" cols="50"><?php the_author_meta( 'description', $current_user->ID ); ?></textarea>
		<label for="description"><?php _e('Descripción (CV)', 'profile') ?></label>
		<?php the_svg_icon("descripcion");?>
</p>
<p class="form-submit">
		<?php echo $referer; ?>
    <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Guardar', 'profile'); ?>" />
    <?php wp_nonce_field( 'update-user' ) ?>
    <input name="action" type="hidden" id="action" value="update-user" />
</p>
  </form>
<?php }else {?>
<div class="profile-text-overlay">
<p class="bio">
<?php if (get_the_author_meta('description', $current_user->ID) != '') { ?>  
<?php array_push($arrayperfil, "description");?>
<?php	$word_limit = 30; $more_txt = 'read more about:'; $txt_end = '...'; 
echo wp_trim_words(strip_tags(get_the_author_meta('description', $current_user->ID)), $word_limit, $txt_end, $more_txt); ?>
<?php }else{?>
Breve descripción tuya...  
<?php } ?>
</p>
<a href="?edit=descripcion">
<?php the_svg_icon("edit");?>
</a>
</div>
<?php } ?>

<!-- 

EMAIL

-->

<?php if ($edit=="email") { ?>  
<form method="post" id="adduser" action="<?php the_permalink(); ?>">
<p class="form-email input-top">
		<input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
    <label for="email"><?php _e('Email', 'profile'); ?></label>
		<?php the_svg_icon("email");?>
  	<span class="underinput">Email que aparecerá en el directorio</span>
</p><!-- .form-email -->
<p class="form-submit">
		<?php echo $referer; ?>
    <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Guardar', 'profile'); ?>" />
    <?php wp_nonce_field( 'update-user' ) ?>
    <input name="action" type="hidden" id="action" value="update-user" />
</p><!-- .form-submit -->
</form>
<?php } else { ?>
<div class="profile-text-overlay">
<p class="email">
<?php the_author_meta( 'user_email', $current_user->ID ); ?>
</p><!-- .form-email -->
<a href="?edit=email">
<?php the_svg_icon("edit");?>
</a>
</div>
<?php } ?>

<!-- 

REDES

-->

<?php if($edit == "redes") { ?>
          
<form method="post" id="adduser" action="<?php the_permalink(); ?>">
<p class="form-url input-top">
		<input class="text-input" name="user_url" type="text" id="url" value="<?php the_author_meta( 'user_url', $current_user->ID ); ?>" />
    <label for="url"><?php _e('Web', 'profile'); ?></label>
		<?php the_svg_icon("web");?>
  	<span class="underinput">Página web que se enlazará desde el directorio</span>
</p>
<p class="text svg">
		<input class="text-input" name="twitter" type="text" id="twitter" value="<?php the_author_meta( 'twitter', $current_user->ID ); ?>" />
    <label for="twitter"><?php _e('Twitter', 'profile'); ?></label>
		<?php the_svg_icon("twitter");?>
  	<span class="underinput">Usuario de twitter sin la @</span>
</p>
<p class="text svg">
		<input class="text-input" name="facebook" type="text" id="facebook" value="<?php the_author_meta( 'facebook', $current_user->ID ); ?>" />
    <label for="facebook"><?php _e('Facebook', 'profile'); ?></label>
		<?php the_svg_icon("facebook");?>
  	<span class="underinput">Solo nombre: http://www.facebook.com/<span class="pink">nombre</span></span>
</p>
<p class="text">
		<input class="text-input" name="linkedin" type="text" id="linkedin" value="<?php the_author_meta( 'linkedin', $current_user->ID ); ?>" />
    <label for="linkedin"><?php _e('Linkedin', 'profile'); ?></label>
		<?php the_svg_icon("linkedin");?>
		<span class="underinput">Toda la url: <span class="pink">http://www.linkedin.com/in/usuario</span></span>
</p>
<p class="text">
		<input class="text-input" name="tumblr" type="text" id="tumblr" value="<?php the_author_meta( 'tumblr', $current_user->ID ); ?>" />
    <label for="tumblr"><?php _e('Tumblr', 'profile'); ?></label>
		<?php the_svg_icon("tumblr");?>
  	<span class="underinput">Solo usuario: http://<span class="pink">usuario</span>.tumblr.com</span>
</p>
<p class="text">
		<input class="text-input" name="behance" type="text" id="behance" value="<?php the_author_meta( 'behance', $current_user->ID ); ?>" />
    <label for="behance"><?php _e('Behance', 'profile'); ?></label>
		<?php the_svg_icon("behance");?>
  	<span class="underinput">Solo usuario: http://www.behance.net/<span class="pink">usuario</span></span>
</p>
<p class="text">
		<input class="text-input" name="domestika" type="text" id="domestika" value="<?php the_author_meta( 'domestika', $current_user->ID ); ?>" />
    <label for="domestika"><?php _e('Domestika', 'profile'); ?></label>
		<?php the_svg_icon("domestika");?>
  	<span class="underinput">Solo usuario: http://www.domestika.org/es/<span class="pink">usuario</span></span>
</p>
<p class="form-submit">
		<?php echo $referer; ?>
    <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Guardar', 'profile'); ?>" />
    <?php wp_nonce_field( 'update-user' ) ?>
    <input name="action" type="hidden" id="action" value="update-user" />
  	<input name="action-rrss" type="hidden" id="action-rrss" value="update-rrss" />
</p><!-- .form-submit -->  
</form>
          
<?php } else { ?>

<p class="links">
<?php if (get_the_author_meta('user_url',$current_user->ID)!=''){?>
<?php array_push($arrayperfil, "web");?>
<a href="<?php the_author_meta( 'user_url', $current_user->ID ); ?>"><?php the_svg_icon("web");?></a>
<?php }?>
<?php if (get_the_author_meta('twitter',$current_user->ID)!=''){?>
<a href="https://twitter.com/<?php the_author_meta( 'twitter', $current_user->ID ); ?>"><?php the_svg_icon("twitter");?></a>
<?php }?>
<?php if (get_the_author_meta('facebook',$current_user->ID)!=''){?>
<a href="http://www.facebook.com/<?php the_author_meta( 'facebook', $current_user->ID ); ?>"><?php the_svg_icon("facebook");?></a>
<?php }?>
<?php if (get_the_author_meta('linkedin',$current_user->ID)!=''){?>
<a href="<?php the_author_meta( 'linkedin', $current_user->ID ); ?>"><?php the_svg_icon("linkedin");?></a>
<?php }?>
<?php if (get_the_author_meta('tumblr',$current_user->ID)!=''){?>
<a href="http://<?php the_author_meta( 'tumblr', $current_user->ID ); ?>.tumblr.com"><?php the_svg_icon("tumblr");?></a> <?php }?>
<?php if (get_the_author_meta('behance',$current_user->ID)!=''){?>
<a href="http://www.behance.net/<?php the_author_meta( 'behance', $current_user->ID ); ?>"><?php the_svg_icon("behance");?></a>
<?php }?>
<?php if (get_the_author_meta('domestika',$current_user->ID)!=''){?>
<a href="http://www.domestika.org/es/<?php the_author_meta( 'domestika', $current_user->ID ); ?>"><?php the_svg_icon("domestika");?></a>
<?php }?>
<?php if (
  get_the_author_meta('user_url',$current_user->ID) == '' &&
  get_the_author_meta('twitter',$current_user->ID) == '' &&
  get_the_author_meta('facebook',$current_user->ID) == '' &&
  get_the_author_meta('linkedin',$current_user->ID) == '' &&
  get_the_author_meta('tumblr',$current_user->ID) == '' &&
  get_the_author_meta('behance',$current_user->ID) == '' &&
  get_the_author_meta('domestika',$current_user->ID) == ''
) echo "Página web y redes";?>
  <div class="profile-rrss-overlay">
<a href="?edit=redes">
<?php the_svg_icon("edit");?>
</a>
</div>  
</p><!-- .links -->
        
<?php } ?>
<?php } /* end foto personal */?>   
<?php } /* end foto proyecto */?> 

<!-- 

FOTO PROYECTO

-->
  


<?php if($edit == "foto_proyecto") { ?>
<br><br>
<div class="accordionOR">
      <form role="form" id="frmSignup2" method="post" action="" enctype="multipart/form-data" style="display: inline-block;">
      <p class="form-upload" style="display: inline-block;"> 
          <input type="file" name="file_upload[]" onchange='return Test.UpdatePreview(this);' loname="exampleimage" id="file_upload1" style="display:none;" class="imageup">
        	<?php if( $img[0][0] != '' ) { ?>
			        <img src="<?php echo $img[0][0]; ?>" id="upfile1" width="77" height="50"/>
        	<?php }else{ ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/uploadimg.png" id="upfile1" width="77" height="50"/>
        	<?php } ?>
        	
      </p>
      <p class="form-upload" style="display: inline-block;">  
          <input type="file" name="file_upload[]" onchange='return Test.UpdatePreview(this);' loname="exampleimage" id="file_upload2" style="display:none;" class="imageup">
          <?php if( $img[0][1] != '' ) { ?>
			        <img src="<?php echo $img[0][1]; ?>" id="upfile2" width="77" height="50"/>
          <?php }else{ ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/uploadimg.png" id="upfile2" width="77" height="50"/>
        	<?php } ?>
     		</p>
      <p class="form-upload" style="display: inline-block;">  
          <input type="file" name="file_upload[]" onchange='return Test.UpdatePreview(this);' loname="exampleimage" id="file_upload3" style="display:none;" class="imageup">
          <?php if( $img[0][2] != '' ) { ?>
			        <img src="<?php echo $img[0][2]; ?>" id="upfile3" width="77" height="50"/>
          <?php }else{ ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/uploadimg.png" id="upfile3" width="77" height="50"/>
        	<?php } ?>
      </p>
      <p><span class="imagehelp" style="line-height: 1rem;">Haz click en la imagen para cambiarla.<br>Formatos permitidos: jpg, jpeg, gif, png.</span></p>
        <input type="submit" value="Guardar cambios" class="submit button imagesave" id="imagesave3" style="margin-bottom: 0px; display: none; margin-top: 40px;"/>
      </form> 
</div>
<br><br>
  
  <form action="/modificar-perfil/" method="post" id="formreturn">
    <input type="submit" value="Edición terminada" name="Submit" id="frm1_back" />
</form>
<?php } ?>
</div><!-- .profile-body -->  

                      

                  


                      

                  
            <?php endif; ?>
    <?php endwhile; ?>
<?php else: ?>
    <p class="no-data">
        <?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
    </p><!-- .no-data -->
<?php endif; ?>




</div>
</div>
  
<?php if ( is_user_logged_in() ) { ?>

<?php
$elemperfil = 11    
?>

<div id="change-profile-help">

<?php if(count($arrayperfil)==0 && $edit == ''){?>
  <h2>Bienvenido/a!</h2>
	<p>Acabas de iniciar el proceso de alta en diseñadoresindustriales.es. Si quieres ver los primeros pasos o las preguntas frecuentes, visita <a href="http://xn--diseadoresindustriales-nec.es/comenzando/">este enlace</a>.</p><br><br>
<?php } ?>
  
<?php if(count($arrayperfil)!=0 && count($arrayperfil)<$elemperfil && $edit == ''){?>
  <h2>Modifica tu perfil</h2>
<svg width="100%" height="10">
  <rect width="100%" height="10" ry="3" rx="3" style="fill:#ccc;stroke-width:0;" />
  <rect width="<?php echo count($arrayperfil)*100/$elemperfil;?>%" height="10" ry="3" rx="3" style="fill:#F46553;stroke-width:0;" />
</svg>
<?php } ?>
  

  
<?php 
if ($edit == ''){
if (count($arrayperfil)==0) {
    echo "<p>Ahora tu perfil está vacío. ¿Qué tal si empiezas subiendo tu <a href='?edit=foto_personal'>foto personal</a>?</p>";
}else{
foreach ($arrayperfil as $k){
if (!in_array("foto_personal", $arrayperfil)) {
    echo "<h3>Foto personal</h3>";
    echo "<p>Tu foto es uno de los elementos más visibles de tu perfil, y es la primera imagen que tendrán de ti.<br>Debe ser una foto personal donde se te reconozca. <a href='?edit=foto_personal'>Cambiar foto</a></p>";
    break 1;
} elseif (!in_array("name", $arrayperfil)) {
    echo "<h3>¿Cómo te llamas?</h3>";
    echo "<p>Necesitamos saber tu nombre y apellidos, y si tienes algún apodo. <a href='?edit=nombre'>Cambiar nombre</a></p>";
    break 1;
} elseif (!in_array("titulacion", $arrayperfil)) {
    echo "<h3>¿Y qué perfil eres?</h3>";
    echo "<p>Completa tu perfil académico y profesional para poder situarte en el buscador. <a href='?edit=especialidad'>Modificar perfil profesional</a></p>";
    break 1;
} elseif (!in_array("centro_de_estudios", $arrayperfil)) {
    echo "<h3>¿Y dónde te formaste?</h3>";
    echo "<p><a href='?edit=especialidad'>Editar</a></p>";
    break 1;
} elseif (!in_array("especialidad", $arrayperfil)) {
    echo "<h3>¿Tienes experiencia en algún sector?</h3>";
    echo "<p><a href='?edit=especialidad'>Editar</a></p>";
    break 1;
} elseif (!in_array("region", $arrayperfil)) {
    echo "<h3>¿Dónde desarrollas tu actividad?</h3>";
    echo "<p><a href='?edit=especialidad'>Editar</a></p>";
    break 1;
} elseif (!in_array("description", $arrayperfil)) {
    echo "<h3>Cuéntanos algo de ti</h3>";
    echo "<p>Describe a los demás cuál es tu experiencia, en qué te gustaría trabajar, qué es lo que más te gusta de tu profesión, etc. <a href='?edit=descripcion'>Cambiar biografía</a></p>";
    break 1;
} elseif (!in_array("web", $arrayperfil)) {
    echo "<h3>¿Tienes web?</h3>";
    echo "<p>A continuación, si tienes una web, blog, o alguna red social, aquí puedes enlazarla. Es necesario que especifiques al menos la página web para continuar con el registro. <a href='?edit=redes'>Cambiar enlaces</a>. <a href='http://xn--diseadoresindustriales-nec.es/faqs/#faq877'>Más info.</p>";
    break 1;
} elseif (!in_array("imgp1", $arrayperfil)) {
    echo "<h3>Foto de proyecto 1</h3>";
    echo "<p>Ya solo te quedan las fotos de tus proyectos, que se verán como cabecera de tu perfil. <a href='?edit=foto_proyecto'>Cambiar imagen</a></p>";
    break 1;
} elseif (!in_array("imgp2", $arrayperfil)) {
    echo "<h3>Foto de proyecto 2</h3>";
    echo "<p>Te faltan más imágenes de proyecto! <a href='?edit=foto_proyecto'>Cambiar imagen</a></p>";
    break 1;
} elseif (!in_array("imgp3", $arrayperfil)) {
    echo "<h3>Foto de proyecto 3</h3>";
    echo "<p>Venga, una más solo. <a href='?edit=foto_proyecto'>Cambiar imagen</a></p>";
    break 1;
} //elseif
}}

if (count($arrayperfil) != $elemperfil && is_user_role("subscriber")) {?>
  <form style="margin-top: 40px;background: #eee;padding: 10px;border-radius: 10px;" role="form" id="frmDubtes" method="post"><textarea name="text-dubte" rows="6" cols="36" placeholder="Si tienes alguna duda, utiliza este recuadro." style="font-family: 'open sans', sans-serif;"></textarea><input name="action" type="hidden" id="actiondub" value="send-dubte" /><input name="submitdubte" type="submit" id="submitdubte" class="submit button" style="margin: 0;" value="Enviar" /><?php if($_POST['text-dubte'] != '') echo '<p style="display: inline-block;margin-left: 10px;color: green;">Duda enviada!</p>'; ?>  </form>

<?php }

if (count($arrayperfil) == $elemperfil) {
  if(is_user_role("subscriber")){
    echo "<h2>Perfil completo!</h2>";
    if (get_the_author_meta( 'perfil_publico', $current_user->ID ) != 1){
    		echo "<p>Ahora puedes solicitar la activación de tu perfil, que será revisado por los demás usuarios.</p>";?>
				<form role="form" id="frmSignup8" method="post" action="<?php the_permalink(); ?>" enctype="multipart/form-data">
						<input name="perfil_publico" type="hidden" id="perfil_publico" value="1" />
						<input name="action" type="hidden" id="action" value="update-user" />
						<input type="submit" value="Publicar" class="submit button" />
				</form> 
<?php } else {
  			echo "<p>Tu perfil está siendo validado por el resto de usuarios. Te enviaremos un email en cuanto estés confirmado.</p>";
  		}
  } 
}

} // no es edit
switch($edit){
case "foto_personal" : echo "<h2>Ponte guapo</h2><p>Esta es la foto que te identificará en toda la web.</p><br><p>Para que se vea bien te recomendamos una imagen de al menos 200x200px.</p>"; break;
case "nombre" : echo "<h2>¿Cómo te llamas?</h2><p>Tu nombre y tu pseudónimo saldrán publicados en los resultados de búsqueda que cuadren con tu perfil.</p>"; break;
case "especialidad" : echo "<h2>Tu perfil profesional</h2><p>Para favorecer tu posicionamiento en las búsquedas, necesitamos conocer algo de tí antes.</p>"; break;
case "descripcion" : echo "<h2>Una breve biografía</h2><p>Describe tu experiencia, tus proyectos de futuro, en qué desearías trabajar, o si lo prefieres, resume tu currículo.</p><br><p>No hay límite en la cantidad de texto que puedes poner, no obstante, en las búsquedas sólo aparecerán las 30 primeras palabras, así que escógelas bien!.</p>"; break;
case "redes" : echo "<h2>Tus enlaces</h2><p>¿Dónde pueden los visitantes encontrar más información de tí?</p><p>Si no dispones de web propia, puedes usar algún servicio como <a href='https://about.me/'>About.me</a></p>"; break;
case "foto_proyecto" : echo "<h2>Mini portfolio</h2><p>Estas imágenes son lo más destacable de tu perfil, así que escógelas bien!. Te recomendamos imágenes cuyos elementos principales se situen en el centro.<br><br>El tamaño mínimo recomendado es 1200x800px.<br><br>Las imágenes deben corresponder a productos, no se admite diseño gráfico. Consulta los <a href='http://xn--diseadoresindustriales-nec.es/faqs/#faq1013' target='_blank'>detalles</a> para más información.</p>"; break;
}  
  
?>
  
</div>
<?php } ?>
  
<?php } /* end new user */?>

  
</div>

<script>
$(document).ready(function() {      
  
    $("#upfile0").click(function () {
        $("#file_upload0").trigger('click');
    });  
    $("#upfile1").click(function () {
        $("#file_upload1").trigger('click');
      	window.location.href='#no-autoplay-0';
    });
    $("#upfile2").click(function () {
        $("#file_upload2").trigger('click');
      	window.location.href='#no-autoplay-1';
    });
    $("#upfile3").click(function () {
        $("#file_upload3").trigger('click');
      	window.location.href='#no-autoplay-2';
    });
});  
</script>

<?php 

get_footer(); ?>
