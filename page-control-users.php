<?php get_header(); ?>

<?php if(is_user_role('administrator') || is_user_role('editor')) { ?>


<style>
  #usercontrolmain {margin: 10px;}
  #usercontrolmain table {width: 100%; text-align: left;}
  #usercontrolmain table a {color: #3D4352}
  #usercontrolmain table a svg {fill: #ccc}
  #usercontrolmain table a svg:hover {fill: #F46553}
  #usercontrolmain tr {height: 30px;}
  #usercontrolmain th, #usercontrolmain td {padding-right: 10px; vertical-align: middle;}
  #usercontrolmain th {font-weight: 600;}
</style>

<?php

$exclude_list = array();
$admins = get_users( array('role' => 'administrator') );
foreach ($admins as $admin) array_push($exclude_list, $admin->ID);

if (empty($_GET["filter"])){

  /* Default options */
  $tip = true; // Type
  $tit = false; // Studies
  $exp = false; // Experience
  $ema = false; // Email
  $est = true;  // Admission state
  $kar = false; // Karma

  // Profile views
  $vfi = false; // Profile views in search results
  $vpe = false;  // Profile views

  //Invitations
  $inv = false;  // Invitations left
  $hin = false;  // Has invited
  $val = false;  // Validated by
  $hva = false;  // Has validate

  // Dates
  $reg = true;  // Register
  $log = true;  // Last login 
  $con = true;  // Confirmed
  $cuo = false; // Last Fee

}else{

  // Get filters
  $order = $_GET['order'] == '' ? 'registered' : $_GET['order'];

  // Get options
  $user_labels = $_GET['labels'];
  $tip = in_array("tip", $user_labels) ? true : false;
  $tit = in_array("tit", $user_labels) ? true : false;
  $exp = in_array("exp", $user_labels) ? true : false;
  $ema = in_array("ema", $user_labels) ? true : false;
  $reg = in_array("reg", $user_labels) ? true : false;
  $con = in_array("con", $user_labels) ? true : false;
  $log = in_array("log", $user_labels) ? true : false;
  $est = in_array("est", $user_labels) ? true : false;
  $kar = in_array("kar", $user_labels) ? true : false;
  $vfi = in_array("vfi", $user_labels) ? true : false;
  $vpe = in_array("vpe", $user_labels) ? true : false;
  $inv = in_array("inv", $user_labels) ? true : false;
  $val = in_array("val", $user_labels) ? true : false;
  $hva = in_array("hva", $user_labels) ? true : false;
  $cuo = in_array("cuo", $user_labels) ? true : false;
  
}

$original_query = $wp_query;

if ($order != 'registered' && $order != 'login'){ //
  if ($filter == 'all' || $filter == ''){
      $args = array( 
      'exclude' => $exclude_list,
      'orderby' => 'meta_value',
      'order' => 'DESC',
      'meta_key' => $order,
      'number' => 9999,
    );
  }
  if ($filter == 'nc'){
      $args = array( 
      'exclude' => $exclude_list,
      'role' => 'subscriber',
      'orderby' => 'meta_value',
      'meta_key' => $order,
      'order' => 'DESC',
      'number' => 9999,
    );
  }
  if ($filter == 'p'){
      $args = array( 
      'exclude' => $exclude_list,
      'role' => 'subscriber',
      'orderby' => 'meta_value',
      'order' => 'DESC',
      'meta_key' => $order,
      'number' => 9999,
      'meta_query'     => array(
        array(
          'key'       => 'perfil_publico',
          'value'     => '1',
          'compare'   => '=',
          'type'      => 'NUMERIC',
        ),
      ),
    );
  }
  if ($filter == 'c'){
      $args = array( 
      'exclude' => $exclude_list,
      'role' => 'author',
      'orderby' => 'meta_value',
      'order' => 'DESC',
      'meta_key' => $order,
      'number' => 9999,
    );
  }
  if ($filter == 's'){
      $args = array( 
      'exclude' => $exclude_list,
      'role' => 'bloqued',
      'orderby' => 'meta_value',
      'order' => 'DESC',
      'meta_key' => $order,
      'number' => 9999,
  
    );
  }
}else{
if ($filter == 'all' || $filter == ''){
      $args = array( 
      'exclude' => $exclude_list,
      'orderby' => $order,
      'order' => 'DESC',
      'number' => 9999,
    );
  }
  if ($filter == 'nc'){
      $args = array( 
      'exclude' => $exclude_list,
      'role' => 'subscriber',
      'orderby' => $order,
      'order' => 'DESC',
      'number' => 9999,
    );
  }
  if ($filter == 'p'){
      $args = array( 
      'exclude' => $exclude_list,
      'role' => 'subscriber',
      'orderby' => $order,
      'order' => 'DESC',
      'number' => 9999,
      'meta_query'     => array(
        array(
          'key'       => 'perfil_publico',
          'value'     => '1',
          'compare'   => '=',
          'type'      => 'NUMERIC',
        ),
      ),
    );
  }
  if ($filter == 'c'){
      $args = array( 
      'exclude' => $exclude_list,
      'role' => 'author',
      'orderby' => $order,
      'order' => 'DESC',
      'number' => 9999,
    );
  }
  if ($filter == 's'){
      $args = array( 
      'exclude' => $exclude_list,
      'role' => 'bloqued',
      'orderby' => $order,
      'order' => 'DESC',
      'number' => 9999,
    );
  }
}


$user_query = new WP_User_Query($args);?>
<div id="usercontroloption">
  <form>
    <select name="labels[]" id="user-labels" multiple="multiple">
      <option value="tip" <?php if($tip) echo 'selected';?> >Tipo</option>
      <option value="tit" <?php if($tit) echo 'selected';?> >Titulación</option>
      <option value="exp" <?php if($exp) echo 'selected';?> >Experiencia</option>
      <option value="ema" <?php if($ema) echo 'selected';?> >Email</option>
      <option value="reg" <?php if($reg) echo 'selected';?> >Creado</option>
      <option value="cuo" <?php if($cuo) echo 'selected';?> >Ult. Cuota</option>
      <option value="con" <?php if($con) echo 'selected';?> >Confirmado</option>
      <option value="log" <?php if($log) echo 'selected';?> >Login</option>
      <option value="est" <?php if($est) echo 'selected';?> >Estado</option>
      <option value="kar" <?php if($kar) echo 'selected';?> >Karma</option>
      <option value="vfi" <?php if($vfi) echo 'selected';?> >Vis. Ficha</option>
      <option value="vpe" <?php if($vpe) echo 'selected';?> >Vis. Perfil</option>
      <option value="inv" <?php if($inv) echo 'selected';?> >Invitaciones</option>
      <option value="val" <?php if($val) echo 'selected';?> >Validado por</option>
      <option value="hva" <?php if($hva) echo 'selected';?> >Ha validado</option>
    </select>
    <br>
    <label> 
      <select name="filter">
      	<option value="all" <?php if($filter == 'all') echo 'selected';?>>Todos los usuarios</option>
        <option value="s" <?php if($filter == 's') echo 'selected';?>>Suspendidos</option>
        <option value="nc" <?php if($filter == 'nc') echo 'selected';?>>En proceso de registro</option>
      	<option value="p" <?php if($filter == 'p') echo 'selected';?>>Pendientes de validar</option>
        <option value="c" <?php if($filter == 'c') echo 'selected';?>>Validados</option>
      </select>
    </label>
    <label> 
      <select name="order">
      	<option value="registered" <?php if($order == 'registered') echo 'selected';?>>Fecha creación</option>
        <option value="validate_date" <?php if($order == 'validate_date') echo 'selected';?>>Fecha validación</option>
      	<option value="last_login" <?php if($order == 'last_login') echo 'selected';?>>Último acceso</option>
        <option value="last_name" <?php if($order == 'last_name') echo 'selected';?>>Apellido</option>
        <option value="login" <?php if($order == 'login') echo 'selected';?>>Email</option>
        <!--<option value="user_search" <?php if($order == 'user_search') echo 'selected';?>>Vis. Ficha</option>
        <option value="user_vis" <?php if($order == 'user_vis') echo 'selected';?>>Vis. Perfil</option> -->
      </select>
    </label>
    <input type="submit" value="Mostrar" class="submit button"/>
  </form>
</div>

<div id="usercontrolmain">
  <table>
    <tr>
      <th>Foto</th>
      <th>Nombre/Pseudo</th>
      <?php if($tip == true){ ?><th>Tipo</th><?php } ?>
      <?php if($tit == true){ ?><th>Titulación/Centro</th><?php } ?>
      <?php if($exp == true){ ?><th>Experiencia/Región</th><?php } ?>
      <?php if($ema == true){ ?><th title="Email/Web">@/www</th><?php } ?>
      <?php if($reg == true){ ?><th title="Creado">Creado</th><?php } ?>
      <?php if($cuo == true){ ?><th title="Ult Cuota">Ult Cuota</th><?php } ?>
      <?php if($con == true){ ?><th title="Confirmado">Confirmado</th><?php } ?>
      <?php if($log == true){ ?><th title="Último acceso">Último acceso</th><?php } ?>
      <?php if($est == true){ ?><th title="Estado">E</th><?php } ?>
      <?php if($kar == true){ ?><th title="Karma">K</th><?php } ?>
      <?php if($vfi == true){ ?><th title="Visualizaciones de ficha">VF</th><?php } ?>
      <?php if($vpe == true){ ?><th title="Visualizaciones de perfil">VP</th><?php } ?>
      <?php if($inv == true){ ?><th title="Invitaciones restantes">I</th><?php } ?>
      <?php if($val == true){ ?><th title="Quien le ha validado">V</th><?php } ?>
      <?php if($hva == true){ ?><th title="A quien ha validado">HV</th><?php } ?>
      <th></th>
    </tr>

  <?php foreach ( $user_query->results as $user ) {	
  
		$user_id = $user->ID;
  	$op_user = get_the_author_meta( 'op_user', $user_id);
    $validate_date = get_the_author_meta( 'validate_date', $user_id);
  	$last_fee = get_the_author_meta( 'last_fee', $user_id);
    if (!empty($op_user)){
      
		?>
    <tr>
      
      <td><?php echo '<div class="profile-mini-foto" style="float:left; text-align: center; display: inline-flex; margin: 0;" title="'.get_the_author_meta('first_name',$user_id ).' '.get_the_author_meta('last_name',$user_id ).'"><a href="'.get_author_posts_url($user_id).'">'.wp_get_attachment_image(get_the_author_meta('foto_personal', $user_id),array(28, 28) ).'</a></div>'; ?></td>
      
      <td><?php if(get_the_author_meta( 'type', $user_id) != 'estudio'){ echo get_the_author_meta('first_name',$user_id ).' ';} echo get_the_author_meta('last_name',$user_id );?><br><em style="color: #ccc;"><?php echo get_the_author_meta('pseudonimo',$user_id );?></em></td>
      
      <?php if($tip == true){ ?><td><?php echo get_the_author_meta( 'type', $user_id);?></td><?php } ?>
      
      <?php if($tit == true){ ?><td><?php echo get_the_author_meta( 'titulacion', $user_id );?><br><?php echo get_the_author_meta( 'centro_de_estudios', $user_id );?></td><?php } ?>
      
      <?php if($exp == true){ ?><td><?php $especial = get_the_author_meta('especialidad', $user_id ); if($especial != ''){ foreach ($especial as $esp) { echo $esp.', ';}}?><br><?php if(get_the_author_meta('region', $user_id)!='') the_region_name(get_the_author_meta('region', $user_id));?></td><?php } ?>
      
      <?php if($ema == true){ ?><td><a href="mailto:<?php echo get_the_author_meta( 'email', $user_id );?>"><?php echo get_the_author_meta( 'email', $user_id );?></a><br><a href="<?php echo get_the_author_meta( 'user_url', $user_id );?>"><?php echo get_the_author_meta( 'user_url', $user_id );?></a></td><?php } ?>
      
      <?php if($reg == true){ ?><td><?php echo get_the_author_meta('user_registered', $user_id);?></td><?php } ?>

      <?php if($cuo == true){ ?><td><?php echo $last_fee;?></td><?php } ?>
      
      <?php if($con == true){ ?><td><?php echo $validate_date;?></td><?php } ?>
      
      <?php if($log == true){ ?><td><?php the_last_login($user_id)?></td><?php } ?>
      
      <?php if($est == true){ ?><td><?php if(get_the_author_meta( 'perfil_publico', $user_id) == 1){if(is_user_role('author', $user_id) || is_user_role('editor', $user_id)){echo '<span style="color:green;" title="Confirmado">C</span>';}else{echo '<span title="Pendiente de confirmación">P</span>';}}else{echo '<span title="En proceso de registro">NP</span>';};?></td><?php } ?>
      
      <?php if($kar == true){ ?><td><?php echo $op_user['karma'];?></td><?php } ?>
      
      <?php if($vfi == true){ ?><td><?php echo get_the_author_meta( 'user_search', $user_id);?></td><?php } ?>
      
      <?php if($vpe == true){ ?><td><?php echo get_the_author_meta( 'user_vis', $user_id);?></td><?php } ?>
      
      <?php if($inv == true){ ?><td><?php echo get_option("invitation_count")-$op_user['invitaciones'];?></td><?php } ?>
           
      <?php if($val == true){ ?><td><?php $hasiovalidado = $op_user['hasiovalidado'];	if(count($hasiovalidado) > 1){ foreach ($hasiovalidado as $v) { if ($v == 0) continue; if(!user_id_exists($v)) continue; echo '<div class="profile-mini-foto" style="float:left; text-align: center; display: inline-flex; margin: 0;" title="'.get_the_author_meta('first_name',$v ).' '.get_the_author_meta('last_name',$v ).'"><a href="'.get_author_posts_url($v).'">'.wp_get_attachment_image(get_the_author_meta('foto_personal', $v),array(28, 28) ).'</a></div>'; }}?></td><?php } ?>
      
      <?php if($hva == true){ ?><td><?php $havalidado = $op_user['havalidado'];	if(count($havalidado) > 1){ foreach ($havalidado as $v) { if ($v == 0) continue; if(!user_id_exists($v)) continue; echo '<div class="profile-mini-foto" style="float:left; text-align: center; display: inline-flex; margin: 0;" title="'.get_the_author_meta('first_name',$v ).' '.get_the_author_meta('last_name',$v ).'"><a href="'.get_author_posts_url($v).'">'.wp_get_attachment_image(get_the_author_meta('foto_personal', $v),array(28, 28) ).'</a></div>'; }}?></td><?php } ?>
      
      <td><a href="http://xn--diseadoresindustriales-nec.es/wp-admin/user-edit.php?user_id=<?php echo $user_id;?>"><?php the_svg_icon('edit')?></a></td>
      
    </tr>
  <?php }} ?>
  </table>
</div>

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>