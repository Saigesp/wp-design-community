<?php get_header(); ?>



<?php include( locate_template(  'menu-directorio.php' )); ?>
		
<div id="concursomain"  class="main">
  <div class="center twocolumn">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    	<?php
			$user_id = get_the_author_meta( 'ID');
			$user_current = get_current_user_id();
			$image = get_the_author_meta('foto_personal', $user_id );
			$fecha_limite = DateTime::createFromFormat('Ymd', get_field('fecha_limite'));
			$url_link = parse_url(get_field('link'));
  		?>

      <div id="concurso-<?php the_ID(); ?>" class="single pregunta">
        <div id="concursoheader-<?php the_ID(); ?>" class="header">
        	<h2><?php the_title();?></h2>
        </div>
        <div>
          <p>
            <?php if (get_post_meta($post->ID, 'hasiodenunciado_count', true) >= get_option('denunce_a_count')){?>
            	<span class="red">
                <strong>Atención: Concurso con varias puntuaciones negativas</strong>
              </span>
              <br>
          	<?php } ?>
            <strong>Publicado por:</strong> <?php echo '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">';
											if(get_the_author_meta('type', get_the_author_meta('ID')) != 'estudio') echo get_the_author_meta('first_name',get_the_author_meta('ID') ).' ';
											echo get_the_author_meta('last_name',get_the_author_meta('ID')).'</a>';?>
						<br>
            <strong>Requisitos:</strong> <?php echo get_field('requisitos');?>
						<br>
            <strong>Fecha límite:</strong> <?php echo $fecha_limite->format('d M Y');?>
            <br>
            <strong>1<sup>er</sup> Premio:</strong> <?php echo get_field('premio');?>
            <br>
            <strong>Más información:</strong> <a href="<?php echo get_field('link');?>" target="_blank"><?php echo $url_link['host'];?></a>
          </p>
        </div>
        <div id="concursobody-<?php the_ID(); ?>" class="body">
        	<?php the_content();?>
        </div>


  			<div id="concursofooter-<?php the_ID(); ?>" class="footer">
          <?php include(locate_template( 'buttons-post.php')); ?>
          <?php include(locate_template( 'buttons-share.php')); ?>
        </div>
      </div>
		<?php endwhile; endif; ?>
  </div>
</div>
    
    

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