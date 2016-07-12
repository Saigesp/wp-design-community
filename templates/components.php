<?php

function wpdc_the_pageoptions($menu){
	$mid_menu = round(sizeof($menu)/2);
	$cont = 0;
	$output = '<section class="wrap wrap--content wrap--content__toframe wrap--flex wrap--transparent menu menu--frame">';
	if(sizeof($menu) > 0) $output .= '<div class="wrap wrap--frame wrap--frame__middle">';
    foreach ($menu as $section => $text) {
    	$cont++;
    	if($cont > $mid_menu) $output .= '<p class="text text--right">';
    	else $output .= '<p>';
    	$output .= '<a onclick="ToggleSection(this)" class="js-section-launch';
    	if($cont == 1) $output .= ' active';
    	$output .= '" data-section="'.$section.'">'.$text.'</a>';
    	$output .= '</p>';
    	if($cont == $mid_menu && sizeof($menu) > 1) $output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
    }
	if(sizeof($menu) > 0) $output .= '</div>';
	$output .= '</section>';
    echo $output;
}

/**
 * INPUT TEXT
 ***********************************/
function wpdc_the_input_text($name, $value, $label, $placeholder, $disabled = false){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<input id="'.$name.'-input" type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"';
	if($disabled) $output .= ' disabled ';
	$output .= '/>';
	$output .= '</div></div>';
    echo $output;
}

/**
 * INPUT DATE
 ***********************************/
function wpdc_the_input_date($name, $value, $label, $disabled = false){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<input id="'.$name.'-input" type="text" class="js-pikaday" name="'.$name.'" value="'.$value.'"';
	if($disabled) $output .= ' disabled ';
	$output .= '/>';
	$output .= '</div></div>';
    echo $output;
}

/**
 * INPUT EMAIL
 ***********************************/
function wpdc_the_input_email($name, $value, $label, $placeholder){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<input id="'.$name.'-input" type="email" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	$output .= '</div></div>';
    echo $output;
}

/**
 * INPUT NUMBER
 ***********************************/
function wpdc_the_input_number($name, $value, $label, $min = 0, $max = 999, $disabled = false){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<input id="'.$name.'-input" type="number" min="'.$min.'" max="'.$max.'" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"';
	if($disabled) $output .= ' disabled ';
	$output .= '/>';
	$output .= '</div></div>';
    echo $output;
}

/**
 * INPUT SELECT
 ***********************************/
function wpdc_the_input_select_option($name, $value, $label, $options, $multiple = false){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<select id="'.$name.'-input" name="'.$name.'" class="select select--option';
	if($multiple) $output .= ' chosen';
	$output .= ' "';
	if($multiple) $output .= ' multiple="multiple"';
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

/**
 * INPUT SELECT USER
 ***********************************/
function wpdc_the_input_select_user($name, $label, $user_array, $user_meta, $multiple = false, $disable = false){
		$output = '<div class="wrap wrap--frame wrap--flex">';
		$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
		$output .= '<label for="'.$name.'-input">'.$label.'</label>';
		$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
		if(!$disable){
			if(is_array($user_array) && sizeof($user_array) > 0){
				$output .= '<select id="'.$name.'-input" name="'.$name;
				if($multiple) $output .= '[]';
				$output .= '" class="select select--user chosen"';
				if($multiple) $output .= ' multiple="multiple"';
				$output .= '/>';
				$output .= '<option value="">Ninguno</option>';
			    foreach ($user_array as $user) {
			    	$output .= '<option value="'.esc_html($user->ID ).'" ';
			    	if(get_the_author_meta($user_meta, $user->ID) == $name) $output .= ' selected';
			    	$output .= ' >'.wpdc_get_user_name($user->ID).'</option>';
			    }
				$output .= '</select>';
			}else {
				$output .= '<label>No hay usuarios</label>';
			}
		}else {
			$output .= '<span>';
			foreach ($user_array as $user) {
				if(get_the_author_meta($user_meta, $user->ID) == $name){
					$output .= wpdc_get_user_name($user->ID);
				}
			}
			$output .= '</span>';
		}
		$output .= '</div></div>';
	    echo $output;
}

/**
 * INPUT SELECT ROLE
 ***********************************/
function wpdc_the_input_select_role($name, $label, $multiple = false){
    $WP_User = new WP_User( $user->ID );
    $roles = array();
    foreach( $WP_User->roles as $role ) {
      $role = get_role( $role );
      if ( $role != null )
      	array_push($roles, $role->name);// change_role_name($role->name);
    }
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<select id="'.$name.'-input" name="'.$name.'" class="select select--option" ';
	if($multiple) $output .= 'multiple="multiple"';
	$output .= '/>';
    foreach (get_my_editable_roles() as $role_name => $role_info){
		if($role_name == 'contributor') continue;
		$output .= '<option value="'.$role_name.'"';
		if(empty($roles) && $role_name == 'subscriber') $output .= 'selected';
		if(in_array($role_name, $roles)) $output .= 'selected';
		$output .= ' >'.change_role_name($role_name).'</option>';
	}
	$output .= '</select>';
	$output .= '</div></div>';
    echo $output;
}
/**
 * INPUT SELECT POSITION
 ***********************************/
function wpdc_the_input_select_position($name, $label, $options, $multiple = false){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<select id="'.$name.'-input" name="'.$name.'" class="select select--option" ';
	if($multiple) $output .= 'multiple="multiple"';
	$output .= '/>';
	foreach ($options as $charge) {
		$output .= '<option value="'.$charge.'"';
		if (esc_attr(get_the_author_meta('asociation_position', $user->ID)) == $charge) $output .= ' selected';
		$output .= '>'.change_role_name($charge).'</option>';
	}
	$output .= '</select>';
	$output .= '</div></div>';
    echo $output;
}

/**
 * INPUT TEXTAREA
 ***********************************/
function wpdc_the_input_textarea($name, $value, $placeholder, $disabled = false){
	$output = '<div class="wrap wrap--frame">';
	$output .= '<textarea id="'.$name.'-textarea" class="description js-medium-editor" name="'.$name.'" placeholder="'.$placeholder.'"';
	if($disabled) $output .= ' disabled ';
	$output .= '>'.$value.'</textarea>';
	$output .= '</div>';
    echo $output;
}

/**
 * INPUT CHECKBOX
 ***********************************/
function wpdc_the_input_checkbox_simple($name, $value = '', $label = '', $placeholder = '', $disabled = false){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	if($placeholder != '') $output .= '<span>'.$placeholder.'</span>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle wrap--checkbox">';
	$output .= '<input id="'.$name.'-check" type="checkbox" name="'.$name.'"';
	if($value != '') $output .= ' value="'.$value.'"';
	if($disabled) $output .= ' disabled ';
	$output .= '/>';
	$output .= '<label for="'.$name.'-check">';
	if($label != '') $output .= '<span>'.$label.'</span>';
	$output .= '</label>';
	$output .= '</div></div>';
    echo $output;
}

/**
 * INPUT FILE
 ***********************************/
function wpdc_the_input_file($name, $value, $label, $accept = null, $multiple = false, $disabled = false){
	if(!$accept) $accept = '.jpg,.JPG,.png,.PNG,.gif,.GIF,.pdf,.PDF,.zip,.ZIP,.rar,.RAR';
	$output = '<div class="wrap wrap--frame wrap--flex">';
		$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
			$output .= '<label for="'.$name.'-filename">'.$label.'</label>';
		$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
			$output .= '<input id="'.$name.'-inputfile" type="file" name="'.$name;
			if($multiple) $output .= '[]';
			$output .= '" accept="'.$accept.'" class ="inputfile hidden" ';
			if($multiple) $output .= ' multiple ';
			$output .= ' />';
			$output .= '<label for="'.$name.'-inputfile"><img src="'.get_stylesheet_directory_uri().'/img/icons/upload.svg" alt="Upload" class="icon icon--upload"></label>';
			$output .= '<input type="text" placeholder="Nombre del archivo" name="'.$name.'-filename" id="'.$name.'-filename"';
			if($disabled) $output .= ' disabled ';
			$output .= '>';
	$output .= '</div></div>';
    echo $output;
}


/**
 * INPUT SUBMIT
 ***********************************/
function wpdc_the_submit($name, $value, $name_hidden = null, $value_hidden = null, $text = null){
	if(!$text) $text = 'Enviar';
	$output = '<div class="wrap wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle"></div>';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle wrap--submit">';
	if($name_hidden && $value_hidden){
		$output .= '<input name="'.$name.'" value="'.$text.'" type="submit" class="button button-primary">';
		$output .= '</input>';
		$output .= '<input name="'.$name_hidden.'" type="hidden" value="'.$value_hidden.'" />';
	}else{
		$output .= '<button name="'.$name.'" value="'.$value.'" type="submit" class="button button-primary">';
		$output .= $text.'</button>';
		$output .= '<input name="action" type="hidden" id="action" value="'.current_page_url().'" />';
	}
	$output .= '</div></div>';
	echo $output;
}










/**
 * ICON EDIT
 ***********************************/
function wpdc_the_edit_icon($link, $position = 0){
	$output = '<div class="wrap wrap--icon wrap--icon__edit">';
	$output .= '<a href="'.$link.'">';
	$output .= '<img src="'.get_stylesheet_directory_uri().'/img/icons/pencil.svg" alt="Edit" class="icon icon--edit icon--corner">';
	$output .= '</a>';
	$output .= '</div>';
	echo $output;
}


/**
 * GET USER NAME
 ***********************************/
function wpdc_the_user_name($user_id) {
	if(get_the_author_meta('first_name',$user_id) && get_the_author_meta('last_name',$user_id))
		$user_full_name = get_the_author_meta('first_name',$user_id).' '.get_the_author_meta('last_name',$user_id);
	else
		if(get_the_author_meta('user_login',$user_id) == get_the_author_meta('user_email',$user_id))
			$user_full_name = get_the_author_meta('user_email',$user_id);
		else
			$user_full_name = get_the_author_meta('user_login',$user_id).' ('.get_the_author_meta('user_email',$user_id).')';

	echo $user_full_name;
}
function wpdc_get_user_name($user_id) {
	if(get_the_author_meta('first_name',$user_id) && get_the_author_meta('last_name',$user_id))
		$user_full_name = get_the_author_meta('first_name',$user_id).' '.get_the_author_meta('last_name',$user_id);
	else
		if(get_the_author_meta('user_login',$user_id) == get_the_author_meta('user_email',$user_id))
			$user_full_name = get_the_author_meta('user_email',$user_id);
		else
			$user_full_name = get_the_author_meta('user_login',$user_id).' ('.get_the_author_meta('user_email',$user_id).')';

	return $user_full_name;
}

/**
 * GET USER ASOCIATION POSITION
 ***********************************/
function wpdc_the_asociation_position($user_id) {
	$output = '';
	$pos = get_the_author_meta('asociation_position', $user_id);
	$res = get_the_author_meta('asociation_responsability', $user_id);

	if(!empty($pos)) 					$output .= change_role_name($pos);
	if(!empty($pos) && !empty($res)) 	$output .= ' | ';
	if(!empty($res))					$output .= change_role_name($res);
	
	echo $output;
}


?>