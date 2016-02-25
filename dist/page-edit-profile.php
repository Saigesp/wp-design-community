<?php
get_header();
?>
<div id="divwraparticle" class="wraparticle">
	<div id="articlemain">
		<article id="article-<?php the_ID(); ?>" class="article <?php if(!has_post_thumbnail()) echo 'article--nothumb'; ?>">
			<section>
				<div id="content-<?php the_ID(); ?>" class="contentarticle">
					<p>Ey</p>
				</div>
			</section>
		</article>
	</div>
</div>
<?php get_footer();?>