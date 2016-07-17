<section class="wrap wrap--content wrap--shadow wrap--form">
	<form method="post" action="">
		<div class="wrap wrap--frame">
			<?php
			if(get_option("text_subscriber_upgrade") != ''){
				echo html_entity_decode(get_option("text_subscriber_upgrade"));
			}else{
				echo '<h3 class="title title--section">Asociarse a '.get_option('blogname').'</h3>';
			}
			?>
			
		</div>
		<?php
		$current_user_status = get_user_meta(get_current_user_id(), 'asociation_status', 1);

		if ($current_user_status != 'pendiente' && $current_user_status != 'suspendido'){ ?> 
			<?php if(is_array(get_option("fields_asociate_min")) && sizeof(get_option("fields_asociate_min")) > 0){?>
				<h3 class="sep">Datos de asociado</h3>
				<p class="help help--section">Es necesario que rellenes los siguientes datos para continuar con el registro.<br>Los datos aportados serán comprobados por el secretario</p>
				<?php 
				$empty_cont = 0;
				foreach (get_option("fields_asociate_min") as $name => $text) {
					if(get_user_meta(get_current_user_id(),$text, 1) != "")	{
						$empty_cont++;
					}
					if($text != 'email')
						wpdc_the_input_text($text, get_user_meta(get_current_user_id(),$text, 1), change_field_name($text), change_field_name($text), false, true);	
					else
						wpdc_the_input_text($text, get_the_author_meta($text, get_current_user_id()), change_field_name($text), change_field_name($text), false, true);			
				}
				?>
			<?php } ?>
			<?php wpdc_the_submit('updatesection', 'upgradeuser', '', '', 'Asociarse');?>
		<?php }elseif (get_user_meta(get_current_user_id(), 'asociation_status', 1) == 'pendiente'){ ?>
			<div class="wrap wrap--content wrap--alert wrap--alert__info"
			<p>Tu solicitud se está tramitando en estos momentos. Te rogamos tengas paciencia.</p>
			</div>
		<?php } ?>
	</form>
</section>