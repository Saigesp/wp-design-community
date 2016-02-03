<?php get_header(); ?>
<?php include( locate_template(  'menu-directorio.php' )); ?>

<div id="preguntamain"  class="main">
  <div class="center twocolumn">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    	<?php
			$user_id = get_the_author_meta( 'ID');
			$user_current = get_current_user_id();
			$image = get_the_author_meta('foto_personal', $user_id );
  		?>

      <div id="pregunta-<?php the_ID(); ?>" class="single pregunta">
        <div id="preguntaheader-<?php the_ID(); ?>" class="header">
        	<h2><?php the_title();?></h2>
        </div>
        <div id="preguntabody-<?php the_ID(); ?>" class="body">
        	<?php the_content();?>
        </div>
  					<div id="preguntaprofile-<?php the_ID(); ?>" class="authorimg">
        				<?php 
								if( $image ) {?>
                  <div class="profile-foto">
                    <a href="<?php echo get_author_posts_url($user_id);?>">
                        <?php echo wp_get_attachment_image( $image,array(100, 100) );?>
                    </a>
                  </div>
								<?php } ?>
                <p class="username">
                		<?php
										if(get_the_author_meta('type',$user_id ) != 'estudio') echo get_the_author_meta('first_name',$user_id ).' ';
										echo get_the_author_meta('last_name',$user_id );
										?>
                </p>
                <p class="pseudonimo">
                  <a href="<?php echo get_author_posts_url($user_id);?>">
                		<?php echo get_the_author_meta( 'pseudonimo', $user_id );?>
                  </a>
                </p>
              	<?php if(function_exists('ec_stars_rating') && (is_user_role('author') || is_user_role('editor') || is_user_role('administrator'))) { ec_stars_rating(); } ?>
        		</div>
        <div id="preguntafooter-<?php the_ID(); ?>" class="footer">
          <?php include(locate_template( 'buttons-share.php')); ?>
        </div>
      </div>
		<?php endwhile; endif; ?>
  </div>
</div>
    
    
<script>
function ResizeHead(){
		var theight = document.getElementById('thumbnail').offsetHeight; 
		document.getElementById("thumbnailwrapv").style.height = theight-140 +"px";
}
window.addEventListener("load", ResizeHead);
window.addEventListener("resize", ResizeHead);
</script>
<div class="center twocolumn">
  <div id="disqus_thread"></div>
    <script type="text/javascript">
        var disqus_shortname = 'disenadoresindustrialeses';
        var disqus_identifier = '<?php the_ID();?>';
        var disqus_title = '<?php the_title();?>';
        var disqus_url = '<?php the_permalink();?>';
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
  <noscript>Please enable JavaScript to view the comments.</noscript>
</div>

<?php get_footer(); ?>