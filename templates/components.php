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
    	//if($cont == 1) $output .= ' active';
    	$output .= '" data-section="'.$section.'">'.$text.'</a>';
    	$output .= '</p>';
    	if($cont == $mid_menu && sizeof($menu) > 1) $output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
    }
	if(sizeof($menu) > 0) $output .= '</div>';
	$output .= '</section>';
    echo $output;
}

/**
 * SECTION CUSTOM
 ***********************************/
function wpdc_the_section_custom($options, $id = '', $title = '', $hidden = false, $right = false){
	if(is_array($options)){
		$cont = 0;
		$mid_array = round(sizeof($options)/2);
		
		$output = '<section id="'.$id.'" class="wrap wrap--content wrap--shadow wrap--info';
		if($hidden) $output .= ' js-section wrap--hidden';
		$output .= '">';
		if($title != '') $output .= '<h3 class="title title--section">'.$title.'</h3>';
		$output .= '<div class="wrap wrap--frame wrap--flex">';
		if(sizeof($options) > 0) $output .= '<div class="wrap wrap--frame wrap--frame__middle">';
			foreach ($options as $key => $value) {
				$cont++;
				if($cont > $mid_array) {
					$output .= '<p class="text ';
					if($right) $output .= ' text--right';
					$output .= '"><strong>'.$key.':</strong> '.$value.'</p>';
				}
				else $output .= '<p><strong>'.$key.':</strong> '.$value.'</p>';
				if($cont == $mid_array && sizeof($options) > 1) $output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
			}
		if(sizeof($options) > 0) $output .= '</div>';
		$output .= '</div>';
		$output .= '</section>';
		echo $output;
	}
}

/**
 * SECTION REGISTRY TRACK
 ***********************************/
function wpdc_the_section_registry_track($track, $id = '', $title = '', $hidden = false, $right = false){
	if(is_array($track)){
		
		$output = '<section id="'.$id.'" class="wrap wrap--content wrap--shadow wrap--info wrap--info__list';
		if($hidden) $output .= ' js-section wrap--hidden';
		$output .= '">';
		if($title != '') $output .= '<h3 class="title title--section">'.$title.'</h3>';
		$output .= '<ul class="list';
		if(sizeof($track) > 6) $output .= ' list--scroll list--scroll__ylarge';
		$output .= '">';
		foreach ($track as $entry) {
			$output .= '<li class="item">';
			$output .= '<span class="date"><span class="js-date">'.$entry['date'].'</span> <span class="js-date-fromnow">'.$entry['date'].'</span></span> '.$entry['status'].' por '.wpdc_get_user_name($entry['changeby']);
			$output .= '</li>';
		}
		$output .= '</ul></section>';
		echo $output;
	}
}

/**
 * INPUT TEXT
 ***********************************/
function wpdc_the_input_text($name, $value, $label, $placeholder, $disabled = false, $required = false){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<input id="'.$name.'-input" type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"';
	if($disabled) $output .= ' disabled ';
	if($required) $output .= ' required ';
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
function wpdc_the_input_select_option($name, $value, $label, $options, $multiple = false, $disable = false, $onchange = ''){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<select id="'.$name.'-input" name="'.$name;
	if($multiple) $output .= '[]';
	$output .= '" class="select select--option';
	if($multiple) $output .= ' chosen';
	if($onchange != '') $output .= ' js-select-'.$name;
	$output .= ' "';
	if($multiple) $output .= ' multiple="multiple" data-placeholder="Selecciona optiones"';
	if($onchange != '') $output .= ' onchange="ToggleSelect(\''.$onchange.'\')"';
	$output .= '/>';
	foreach ($options as $val => $text) {
		$output .= '<option value="'.$val.'"';
		if($value == '' && get_option($name) == $val) $output .= ' selected';
		elseif(is_array($value) && in_array($val, $value)) $output .= ' selected';
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
				$output .= '" class="select select--user chosen" data-placeholder="Selecciona usuarios"';
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
 * INPUT SELECT USER PAYED FEE
 ***********************************/
function wpdc_the_input_select_user_payed_fee($name, $label, $user_array, $multiple = false, $disable = false){

	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '<label for="'.$name.'-input">'.$label.'</label>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle">';
	if(!$disable){
		if(is_array($user_array) && sizeof($user_array) > 0){
			$output .= '<select id="'.$name.'-input" name="'.$name;
			if($multiple) $output .= '[]';
			$output .= '" class="select select--user chosen" data-placeholder="Selecciona usuarios"';
			if($multiple) $output .= ' multiple="multiple"';
			$output .= '/>';
			$output .= '<option value="">Ninguno</option>';
		    foreach ($user_array as $user) {
		    	if($members_pending[$user->ID] != '' || $members_payed[$user->ID] != '') continue;
		    	$output .= '<option value="'.esc_html($user->ID ).'" ';
		    	
		    	$output .= ' >'.wpdc_get_user_name($user->ID).'</option>';
		    }
			$output .= '</select>';
		}else {
			$output .= '<label>No hay usuarios</label>';
		}
	}else {
		$output .= '<span>';
		foreach ($user_array as $user) {
			//if(get_the_author_meta($user_meta, $user->ID) == $name){
			//	$output .= wpdc_get_user_name($user->ID);
			//}
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
function wpdc_the_input_textarea($name, $value, $placeholder, $middle = false, $disabled = false){
	if($middle) $output = '<div class="wrap wrap--frame wrap--flex">';
	else $output = '<div class="wrap wrap--frame">';
	if($middle) {
		$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
		$output .= '<label for="'.$name.'-textarea">'.$placeholder.'</label>';
		$output .= '</div>';
		$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	}
	if(!$middle) $output .= '<label for="'.$name.'-textarea">'.$placeholder.'</label>';
	$output .= '<textarea id="'.$name.'-textarea" class="description js-medium-editor" name="'.$name.'" placeholder="'.$placeholder.'"';
	if($disabled) $output .= ' disabled ';
	$output .= '>'.$value.'</textarea>';
	if($middle) $output .= '</div>';
	$output .= '</div>';
    echo $output;
}

/**
 * INPUT CHECKBOX
 ***********************************/
function wpdc_the_input_checkbox_simple($name, $value = '', $label = '', $placeholder = '', $disabled = false, $checked = false){
	$output = '<div class="wrap wrap--frame wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	if($placeholder != '') $output .= '<span>'.$placeholder.'</span>';
	$output .= '</div><div class="wrap wrap--frame wrap--frame__middle wrap--checkbox">';
	$output .= '<input id="'.$name.'-check" type="checkbox" name="'.$name.'"';
	if($value != '') $output .= ' value="'.$value.'"';
	if($checked) $output .= ' checked ';
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
		$output .= '<div class="wrap wrap--frame">';
			$output .= '<input id="'.$name.'-inputfile" type="file" name="'.$name;
			if($multiple) $output .= '[]';
			$output .= '" accept="'.$accept.'" class ="inputfile hidden" ';
			if($multiple) $output .= ' multiple ';
			$output .= ' />';
			$output .= '<label for="'.$name.'-inputfile"><img src="'.get_stylesheet_directory_uri().'/img/icons/upload.svg" alt="Upload" class="icon icon--upload"></label>';
			$output .= '<input type="text" placeholder="Nombre del archivo" name="'.$name.'-filename" id="'.$name.'-filename"';
			if($disabled) $output .= ' disabled ';
			$output .= '>';
	$output .= '</div>';
	if($multiple) $output .= '<ul id="'.$name.'-placename" class="list list--appended"></ul>';
	$output .= '</div></div>';
    echo $output;
}


/**
 * INPUT SUBMIT
 ***********************************/
function wpdc_the_submit($name, $value, $name_hidden = null, $value_hidden = null, $text = null, $disabled = false){
	if(!$text) $text = 'Enviar';
	$output = '<div class="wrap wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle">';
	$output .= '</div>';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle wrap--submit">';
	if($name_hidden && $value_hidden){
		$output .= '<input name="'.$name.'" value="'.$text.'" type="submit" class="button"';
		if($disabled) $output .= ' disabled';
		$output .= '>';
		$output .= '</input>';
		$output .= '<input name="'.$name_hidden.'" type="hidden" value="'.$value_hidden.'" />';
	}else{
		$output .= '<button name="'.$name.'" value="'.$value.'" type="submit" class="button"';
		if($disabled) $output .= ' disabled';
		$output .= '>';
		$output .= $text.'</button>';
		$output .= '<input name="action" type="hidden" id="action" value="'.current_page_url().'" />';
	}
	$output .= '</div></div>';
	echo $output;
}

function wpdc_the_submit_double($name, $value, $text, $name2, $value2, $text2, $disabled = false, $disabled2 = false){
	$output = '<div class="wrap wrap--flex">';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle wrap--submit">';
	if($name2 != '' && $value2 != '' && $text2 != ''){
		$output .= '<button name="'.$name2.'" value="'.$value2.'" type="submit" class="button button--secondary"';
		if($disabled2) $output .= ' disabled';
		$output .= '>'.$text2.'</button>';
	}
	$output .= '</div>';
	$output .= '<div class="wrap wrap--frame wrap--frame__middle wrap--submit">';
	if($name != '' && $value != '' && $text != ''){
		$output .= '<button name="'.$name.'" value="'.$value.'" type="submit" class="button"';
		if($disabled) $output .= ' disabled';
		$output .= '>'.$text.'</button>';
	}
	$output .= '<input name="action" type="hidden" id="action" value="'.current_page_url().'" />';
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

// Profile image
function wpdc_the_profile_photo($usuario){
	if(is_object($usuario) && is_numeric($usuario->ID)) $user_id = $usuario->ID;
	elseif(is_numeric($usuario)) $user_id = $usuario;
	$user = get_userdata($user_id);

	if(function_exists('get_wp_user_avatar_src') && get_wp_user_avatar_src($user_id, 100, 'medium') != '')
		$user_photo = get_wp_user_avatar_src($user_id, 100, 'medium');
	elseif ($user->userphoto_image_file != '')
		$user_photo = get_bloginfo('url').'/wp-content/uploads/userphoto/'.$user->userphoto_image_file;
	else
		$user_photo = get_stylesheet_directory_uri().'/img/default/nophoto.png';

	echo '<div class="wrap wrap--photo" title="'.wpdc_get_user_name($user_id).'"><img src="'.$user_photo.'"></div>';
}


?>