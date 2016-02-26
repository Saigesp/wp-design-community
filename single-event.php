<?php get_header(); ?> 

<div class="flexboxer flexboxer--event">
  <section class="wrap wrap--event">
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
				<h3 class="subtitletextarticle titlesarticle"><?php if(function_exists('the_subtitle')) the_subtitle(); ?></h3>
			</div>
		</div>
		<div class="categoryarticle">
				<p><?php the_category(', ');?></p>
		</div>
	</header>
  </section><!-- end of event -->
</div><!-- end of flexboxer -->

<?php get_footer(); ?>