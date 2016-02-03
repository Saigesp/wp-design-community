<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>




<div class="post-header" onload="resizeHeader()">
		<div class="div-thumbnail overlay">
  			<?php if (has_post_thumbnail())the_post_thumbnail('full', array( 'class' => 'img-thumbnail', 'style' => 'visibility:hidden;' )); ?>
		</div>
		<div class="div-thumbnail" id="thumbnail">
  			<?php if (has_post_thumbnail())the_post_thumbnail('full', array( 'class' => 'img-thumbnail' )); ?>
		</div>
    <div class="title-thumbnail-wrap-v" id="thumbnailwrapv">
    		<div class="title-thumbnail wrap">
  					<h1><?php the_title(); ?></h1>
				</div>
    </div>
</div>  

  
		<div class="post-body">
				<div class="post wrap">
          <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content();?>
            </div>
				</div>
      	<div class="post wrap">
  					<div class="authorimg">
        				<?php 
								$image = get_the_author_meta('foto_personal', $user_id );
								if( $image ) {?>
								<div class="profile-foto">
                  <a href="<?php echo get_author_posts_url($user_id);?>">
                		<?php echo wp_get_attachment_image( $image,array(100, 100) );?>
                  </a>
              	</div>
								<?php } ?>
                <p class="username">
                		<?php echo get_the_author_meta('first_name',$user_id ).' '.get_the_author_meta('last_name',$user_id );?>
                </p>
                <p class="pseudonimo">
                		<?php echo get_the_author_meta( 'pseudonimo', $user_id );?>
                </p>
        		</div>
            
            <?php if(function_exists('ec_stars_rating')) { ec_stars_rating(); } ?>
        </div>
		</div>






<div class="center twocolumn">
<div id="disqus_thread"></div>
<script type="text/javascript">
    var disqus_shortname = 'disenadoresindustrialeses'; 
		var disqus_identifier = '<?php the_ID(); ?>';
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















<?php endwhile; endif; ?>
<script>
function ResizeHead(){
		var theight = document.getElementById('thumbnail').offsetHeight; 
		document.getElementById("thumbnailwrapv").style.height = theight-140 +"px";
}
window.addEventListener("load", ResizeHead);
window.addEventListener("resize", ResizeHead);
</script>

<?php get_footer(); ?>