<?php
$field_act_key = "field_5462990a3dbd6";
$field_act = get_field_object($field_act_key);
$field_reg_key = "field_54629963a5d54";
$field_reg = get_field_object($field_reg_key);
?>

<form method="get" id="searchformhome" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
 <input type="hidden" name="s" value="*">
 <select name="act" class="actividad" id="selacthome">
  <option value="" disabled selected>Actividad</option>
  <option value="">Todas</option>
 <?php foreach ($field_act['choices'] as $k => $v){
  					echo '<option value="'.$k.'">'.$v.'</option>';
  			}?>
</select>
 <select name="reg" class="region" id="selreghome">
<option value="" disabled selected>Provincia</option>
<option value="">Todas</option>
 <?php foreach ($field_reg['choices'] as $k => $v){
  					echo '<option value="'.$k.'">'.$v.'</option>';
  			}?>
</select>
 <input class="submit" type="submit" value="Buscar">
</form>




