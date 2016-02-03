<?php
$field_act_key = "field_5462990a3dbd6";
$field_act = get_field_object($field_act_key);
$field_reg_key = "field_54629963a5d54";
$field_reg = get_field_object($field_reg_key);
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
 <input type="hidden" name="s" value="*">
 <select name="act" class="actividad" id="selact">
  <option value="" disabled selected>Actividad</option>
  <option value="">Todas</option>
 <?php foreach ($field_act['choices'] as $k => $v){
  					echo '<option value="'.$k.'">'.$v.'</option>';
  			}?>
</select>
 <select name="reg" class="region" id="selreg">
<option value="" disabled selected>Provincia</option>
<option value="">Todas</option>
 <?php foreach ($field_reg['choices'] as $k => $v){
  					echo '<option value="'.$k.'">'.$v.'</option>';
  			}?>
</select>
  <div class="roundedOne" id="roundedOnePro">
 <input class="type" id="chepro" type="checkbox" name="pro" value="true" <?php if(!is_search()){ echo 'checked'; }?>><label class="labelcheck" for="chepro"><span>Profesional</span></label>
  </div>
  <div class="roundedOne" id="roundedOneEst">
 <input class="type" id="chestu" type="checkbox" name="stu" value="true" <?php if(!is_search()){ echo 'checked'; }?>><label for="chestu"><span>Estudio</span></label>
  </div>
  <div class="roundedOne" id="roundedOneStu">
 <input class="type" id="cheest" type="checkbox" name="est" value="true" <?php if(!is_search()){ echo 'checked'; }?>><label for="cheest"><span>Estudiante</span></label>
    </div>
 <input class="submit" type="submit" value="Buscar">
</form>




