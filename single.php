<?php
get_header();
?>
<div id="divwraparticle" class="wrap wrap--article">
	<?php if (have_posts()) : ?>
		<div id="articlemain">
			<?php while (have_posts()) : the_post(); ?>
				<article id="article-<?php the_ID(); ?>" class="article <?php if(!has_post_thumbnail()) echo 'article--nothumb'; ?>">
					<header id="header-<?php the_ID(); ?>" class="header header--article">
						<?php  if ( has_post_thumbnail() ) { ?>
							<figure id="thumbnail" class="thumb--article js-fullheight js-fullheight-thumb">
								<?php the_post_thumbnail('full');  ?>
							</figure>
							<div class="overflow overflow--black"></div>
						<?php }  ?>
						<div id="title-<?php the_ID(); ?>" class="wrap wrap--title wrap--title__article">
							<div class="wrap wrap--position">
								<h2 class="title title--article" ><?php the_title(); ?></h2>
								<?php if(function_exists('the_subtitle')){?>
									<h3 class="title title--article__sub"><?php the_subtitle(); ?></h3>
								<?php } ?>
							</div>
						</div>
						<div class="wrap wrap--category">
              				<p><?php the_category(', ');?></p>
            			</div>
					</header>
					<section>
					  <?php /*include(locate_template( 'buttons-share.php'));*/ ?>
					<div class="wrap wrap--author">
						<?php if(function_exists('get_wp_user_avatar_src')){?>
							<figure class="wrap wrap--photo wrap--photo__author" style="background-color: rgba(0,0,0,0.3);">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<img src="<?php echo get_wp_user_avatar_src(get_the_author_meta('ID'), 100, 'medium'); ?>"/>
								</a>
							</figure>
						<?php } ?>
						<p class="author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></p>
						<p class="date"><?php the_date();?></p>
						<?php if(function_exists('wpp_get_views')){ ?><p class="views"><?php // the_svg_icon('eye'); echo wpp_get_views(get_the_ID(),'all');?></p><?php } ?>
					</div>
						<div id="content-<?php the_ID(); ?>" class="content">
							<?php the_content(); ?>
						</div>
						<div class="backcontainer">
							<div class="postdownload">
								<?php
								if(function_exists('get_field')){
									$archive = get_field( "postarchive" );
									$archivename = get_field( "postarchivename" );
									if( $archive ) { ?>
									    	<p>
									    		<a href="<?php echo $archive;?>">
									    			<?php // the_svg_icon('download');?> <?php echo 'Descarga <span class="filename">'. $archivename.'</span>';?>
									    		</a>
									    	</p>
								<?php } } ?>
							</div>
							<footer id="footer-<?php the_ID(); ?>" class="footerarticle">
								<div class="contentauthorarticlefoot">
									<hr class="separatorauthor separatorauthorup">
									<?php if (function_exists('get_wp_user_avatar_src')){ ?>
									<figure class="wrap wrap--photo wrap--photo__author wrap--photo__block" style="background-color: #666;">
										<img src="<?php echo get_wp_user_avatar_src(get_the_author_meta('ID'), 100, 'medium'); ?>"/>
									</figure>
									<?php } ?>
									<p class="authorarticlefoot">
										<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
											<?php the_author(); ?>
										</a>
										<br>
										<?php if ( get_user_meta(get_the_author_meta('ID'),position,true) != '') {
											echo get_user_meta(get_the_author_meta('ID'),position,true);
											echo '<br>';
										}
										if(get_user_meta(get_the_author_meta('ID'),twitter,true) != '') { ?>
											<a href="<?php echo 'https://twitter.com/'.get_user_meta(get_the_author_meta('ID'),twitter,true);?>" target="_blank">
												<?php // the_svg_icon('twitter');?>
											</a>
										<?php } ?>
										<?php if(get_user_meta(get_the_author_meta('ID'),googleplus,true) != '') { ?>
											<a rel="author" href="<?php echo get_user_meta(get_the_author_meta('ID'),googleplus,true);?>" target="_blank">
												<?php // the_svg_icon('gplus');?>
											</a>
										<?php } ?>
									    <?php if(get_user_meta(get_the_author_meta('ID'),linkedin,true) != '') { ?>
									    <a href="<?php echo get_user_meta(get_the_author_meta('ID'),linkedin,true);?>" target="_blank">
									      <?php // the_svg_icon('linkedin');?>
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
					</section>
				</article>
			<?php endwhile; ?>
		</div>
	<?php else : ?>
	<?php endif; ?>
</div>
<?php get_footer();?>