<?php get_header(); ?>
<div id="divwraparticle" class="wraparticle">
	<?php if (have_posts()) : ?>
		<article id="articlemain">
			<?php while (have_posts()) : the_post(); ?>
				<script type="text/javascript">
		          var disqus_shortname = 'talkcodeblog';
		          var disqus_identifier = '<?php the_ID();?>';
		          var disqus_title = '<?php the_title();?>';
		          var disqus_url = '<?php the_permalink();?>';
		          (function() {
		              var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
		              dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
		              (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		          })();
		    	</script>
				<section id="section-<?php the_ID(); ?>" class="sectionarticle">
					<header id="header-<?php the_ID(); ?>" class="headerarticle">
						<?php  if ( has_post_thumbnail() ) { ?>
							<figure id="thumbnail" class="thumbarticle">
								<?php the_post_thumbnail('full');  ?>
							</figure>
							<div class="overflow overflow--black"></div>
						<?php }  ?>
						<div id="title" class="titlearticle">
							<div class="divtextarticle">
								<h2 class="titletextarticle titlesarticle" ><?php the_title(); ?></h2>
								<h3 class="subtitletextarticle titlesarticle"><?php the_subtitle(); ?></h3>
							</div>
						</div>
						<div class="categoryarticle">
              				<p><?php the_category(', ');?></p>
            			</div>
					</header>
					<section id="wraparticle">
					  <?php include(locate_template( 'buttons-share.php')); ?>
						<div class="contentauthorarticle">
							<figure class="authorimage authorbuble" style="background-color: #666;">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<img src="<?php echo get_wp_user_avatar_src(get_the_author_meta('ID'), 100, 'medium'); ?>"/>
								</a>
							</figure>
							<p class="authorarticle"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></p>
							<p class="datearticle"><?php the_date();?></p>
							<p class="datearch viewarch"><?php the_svg_icon('eye');?> <?php echo wpp_get_views(get_the_ID(),'all');?></p>
						</div>
						<div id="content-<?php the_ID(); ?>" class="contentarticle">
							<?php the_content(); ?>
						</div>
						<div class="backcontainer">
							<div class="postdownload">
								<?php
								$archive = get_field( "postarchive" );
								$archivename = get_field( "postarchivename" );
								if( $archive ) { ?>
								    	<p>
								    		<a href="<?php echo $archive;?>">
								    			<?php the_svg_icon('download');?> <?php echo 'Descarga <span class="filename">'. $archivename.'</span>';?>
								    		</a>
								    	</p>
								<?php }	?>
							</div>
							<footer id="footer-<?php the_ID(); ?>" class="footerarticle">
								<div class="contentauthorarticlefoot">
									<hr class="separatorauthor separatorauthorup">
									<figure class="authorimagefoot authorbuble" style="background-color: #666;">
										<img src="<?php echo get_wp_user_avatar_src(get_the_author_meta('ID'), 100, 'medium'); ?>"/>
									</figure>
									<p class="authorarticlefoot">
										<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
											<?php the_author(); ?>
										</a>
										<br>
										<?php echo get_user_meta(get_the_author_meta('ID'),position,true);?>
										<br>
										<?php if(get_user_meta(get_the_author_meta('ID'),twitter,true) != '') { ?>
											<a href="<?php echo 'https://twitter.com/'.get_user_meta(get_the_author_meta('ID'),twitter,true);?>" target="_blank">
												<?php the_svg_icon('twitter');?>
											</a>
										<?php } ?>
										<?php if(get_user_meta(get_the_author_meta('ID'),googleplus,true) != '') { ?>
											<a rel="author" href="<?php echo get_user_meta(get_the_author_meta('ID'),googleplus,true);?>" target="_blank">
												<?php the_svg_icon('gplus');?>
											</a>
										<?php } ?>
									    <?php if(get_user_meta(get_the_author_meta('ID'),linkedin,true) != '') { ?>
									    <a href="<?php echo get_user_meta(get_the_author_meta('ID'),linkedin,true);?>" target="_blank">
									      <?php the_svg_icon('linkedin');?>
									    </a>
									    <?php } ?>
									</p>
									<hr class="separatorauthor separatorauthordown">
								</div>
								<div id="comments-<?php the_ID(); ?>" class="commentsarticle">
									<?php comments_template(); ?>
								</div>
							</footer>
						</div>
						<div class="relatedarticles">
							<?php
					          $orig_post = $post;
					          global $post;
					          $tags = wp_get_post_tags($post->ID);
					          if ($tags) {
					              $tag_ids = array();
					            foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
					              $args=array(
					                  'tag__in' => $tag_ids,
					                  'post__not_in' => array($post->ID),
					                  'posts_per_page'=>10, // Number of related posts to display.
					                  'caller_get_posts'=>1
					              );
					              $wp_query = new wp_query( $args );
								  if (have_posts()) : ?>
									<div class="relatedtitle">
										<h3>Artículos relacionados</h3>
									</div>
									<?php
									while (have_posts()) : the_post(); 
										include(locate_template('loop-archive.php'));
									endwhile;
								  else : 

									$args=array(
					                  'order' => 'DESC',
					                  'post__not_in' => array($post->ID),
					                  'posts_per_page'=>10, // Number of related posts to display.
					                  'caller_get_posts'=>1
					              );
					              $wp_query = new wp_query( $args );
								  if (have_posts()) : ?>
									<div class="relatedtitle">
										<h3>Últimos artículos</h3>
									</div>
									<?php
									while (have_posts()) : the_post(); 
										include(locate_template('loop-archive.php'));
									endwhile;
									else : 
								  endif; 

								  endif; 
							  }else{
					              
							  }
							  $post = $orig_post;
							  wp_reset_query();
							  ?>
						</div>
					</section>
				</section>
			<?php endwhile; ?>
		</article>
	<?php else : ?>
	<?php endif; ?>
</div>
<?php get_footer();?>