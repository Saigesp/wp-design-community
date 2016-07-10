<?php

function wpdc_the_pageoptions($menu){
	$mid_menu = round(sizeof($menu)/2);
	$cont = 0;
	$output = '<section class="wrap wrap--content wrap--content__toframe wrap--flex wrap--transparent menu menu--frame">';
	if(sizeof($menu) > 1) $output .= '<div class="wrap wrap--frame wrap--frame__middle">';
    foreach ($menu as $section => $text) {
    	$cont++;
    	if($cont > $mid_menu) $output .= '<p class="text text--right">';
    	else $output .= '<p>';
    	$output .= '<a onclick="ToggleSection(this)" class="js-section-launch" data-section="'.$section.'">'.$text.'</a>';
    	$output .= '</p>';
    	if($cont == $mid_menu && sizeof($menu) > 1) $output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
    }
	if(sizeof($menu) > 1) $output .= '</div>';
	$output .= '</section>';
    echo $output;
}


function wpdc_the_input_text($name, $value, $label, $placeholder){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<input id="'.$name.'-input" type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	$output .= '</div></div>';
    echo $output;
}


function wpdc_the_input_email($name, $value, $label, $placeholder){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<input id="'.$name.'-input" type="email" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	$output .= '</div></div>';
    echo $output;
}


function wpdc_the_input_number($name, $value, $label, $min, $max){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<input id="'.$name.'-input" type="number" min="'.$min.'" max="'.$max.'" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	$output .= '</div></div>';
    echo $output;
}

function wpdc_the_input_select_option($name, $value, $label, $options, $multiple = false){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<select id="'.$name.'-input" name="'.$name.'" class="select select--option';
	if($multiple) $output .= 'multiple="multiple"';
	$output .= '/>';
    foreach ($options as $val => $text) {
    	$output .= '<option value="'.$val.'"';
    	if(get_option($name) == $val) $output .= ' selected';
    	$output .= '>'.$text.'</option>';
    }
	$output .= '</select>';
	$output .= '</div></div>';
    echo $output;
}

function wpdc_the_input_select_user($name, $label, $user_array, $user_meta, $multiple = false){
		$output = '<div class="wrap wrap--frame wrap--flex">';
		$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
		$output .= '<label for="'.$name.'-input">'.$label.'</label>';
		$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
		if(is_array($user_array) && sizeof($user_array) > 1){
			$output .= '<select id="'.$name.'-input" name="'.$name;
			if($multiple) $output .= '[]';
			$output .= '" class="select select--user';
			if($multiple) $output .= 'multiple="multiple"';
			$output .= '/>';
		    foreach ($user_array->results as $user) {
		    	$output .= '<option value="'.esc_html($user->ID ).'" ';
		    	if(get_the_author_meta($user_meta, $user->ID) == $name) $output .= ' selected';
		    	$output .= ' >'.esc_html($user->first_name).' '.esc_html($user->last_name).'</option>';
		    }
			$output .= '</select>';
		}else {
			$output .= '<label><strong>Usuarios insuficientes</strong></label>';
		}
		$output .= '</div></div>';
	    echo $output;
}


function wpdc_the_submit($name, $value, $value_confirm, $text){
	echo '<div class="wrap wrap--flex">
      		<div class="wrap wrap--frame wrap--frame__middle">
      		</div>
			<div class="wrap wrap--frame wrap--frame__middle wrap--submit">
				<button name="'.$name.'" value="'.$value.'" type="submit" class="button button-primary">'.$text.'</button>
				<input name="action" type="hidden" id="action" value="'.$value_confirm.'" />
			</div>
		</div>
	';
}

?>