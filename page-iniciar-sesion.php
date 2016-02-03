<?php get_header(); ?>

<div id="page-<?php the_ID(); ?>">
        <div class="profilebox onecolumn">    

<?php if ( !is_user_logged_in() ) { ?>
            		<div class="profile-login">
                    <p class="bold red">
                        <?php _e('Por favor, inicia sesión para continuar', 'profile'); ?>
                      <br><br>
                    </p><!-- .warning -->
          					<?php get_template_part( 'login' ); ?>
                  </div>
<?php } ?>

</div>
</div>

<?php get_footer(); ?>