<?php
get_header();

$current_user_id = $current_user->ID;

echo '<div class="js-showonload js-showonload-active">';

if(is_user_role('author') || is_user_role('editor') || is_user_role('administrator'))
	em_event_form();
else header('Location: '.site_url().'?error=nologged' );

echo '</div>';

get_footer();
?>