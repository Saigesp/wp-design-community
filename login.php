<?php
if ( ! is_user_logged_in() ) { // Display WordPress login form:
    $args = array(
        'redirect' => admin_url(),
        'form_id' => 'loginform-custom',
        'label_username' => __( 'Email' ),
        'label_password' => __( 'Password' ),
        'label_log_in' => __( 'Log In' ),
        'remember' => false
        );
    wp_login_form( $args );
    echo '<p class="lost-password"><a href="' . wp_lostpassword_url( $redirect ) . '">Contraseña perdida</a></p>';
} else { // If logged in:
    wp_loginout( home_url() ); // Display "Log Out" link.
    echo " | ";
    wp_register('', ''); // Display "Site Admin" link.
}
?>