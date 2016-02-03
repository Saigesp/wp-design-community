<?php
$postTitleError = '';
if ( isset( $_POST['submitted'] ) ) {
    if ( trim( $_POST['postTitle'] ) === '' ) {
        $postTitleError = 'Please enter a title.';
        $hasError = true;
    }
}
?>

<?php get_header(); ?>

<style>
 	.post-form fieldset {margin: 20px 0;}
  .post-form input[type=text] {width: 100%; height: 40px; font-size: 1.4rem; padding: 5px 10px; font-family: Raleway, sans-serif; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
  #wp-postcontent-editor-container { border: 1px solid #ccc;}
  #wp-postcontent-editor-tools {display:none;}
</style>

   

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div id="page-<?php the_ID(); ?>">
	<div class="center twocolumn"> 
		<h2><?php the_title();?></h2>
<?php if ( $postTitleError != '' ) { ?>
    <span class="error"><?php echo $postTitleError; ?></span>
    <div class="clearfix"></div>
<?php } ?>
<?php if(is_user_role('author') || is_user_role('editor') || is_user_role('administrator')){ ?>    
<form action="" class="post-form" method="POST">
    <fieldset> 
        <input type="text" name="postTitle" id="postTitle" class="required" value="<?php if ( isset( $_POST['postTitle'] ) ) echo $_POST['postTitle']; ?>" placeholder="Título"/>
    </fieldset>
    <fieldset>
      <?php

$content = '';
$editor_id = 'postcontent';
$settings = array(
  'media_buttons' => false,
	'textarea_name' => 'postcontent',
  'textarea_rows' => 10,
);
wp_editor( $content, $editor_id, $settings );
?>
      

    </fieldset>
    <fieldset>
      	<?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
        <input type="hidden" name="submitted" id="submitted" value="true" />
        <button type="submit"><?php _e('Publicar', 'framework') ?></button>
    </fieldset>
</form>
    


<?php }else{ ?>
    <p class="bold red">No tienes permisos para publicar</p>
<?php } ?>
	</div>
</div>

<?php
if ( isset( $_POST['submitted'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {
    if ( trim( $_POST['postTitle'] ) === '' ) {
        $postTitleError = 'Please enter a title.';
        $hasError = true;
    }
    $post_information = array(
        'post_title' => wp_strip_all_tags( $_POST['postTitle'] ),
        'post_content' => $_POST['postcontent'],
        'post_type' => 'post',
        'post_status' => 'publish',
    );
   // wp_insert_post( $post_information );
  	$post_id = wp_insert_post( $post_information );
  	if ( $post_id ) {
    		wp_redirect( home_url() );
    		exit;
		}
}
?>

<?php endwhile; else : echo "Error"; endif; ?>
<?php get_footer(); ?>