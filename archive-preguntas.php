<?php get_header();?>

<?php

function removeqsvar($url, $varname) {
    return preg_replace('/([?&])'.$varname.'=[^&]+(&|$)/','$1',$url);
}

$order = $_GET['order'] == '' ? 'date' : $_GET['order'];
$paged = $_GET['pag'] == '' ? '1' : $_GET['pag'];
$pubs_per_page = get_option("pubs_per_page");
$Path=$_SERVER['REQUEST_URI'];
$original_query = $wp_query;
if($order == 'votos'){
  $args = array( 
    'post_type' => 'preguntas',
    'order' => 'DESC',
    'orderby' => 'meta_value',
    'meta_key' => 'ec_stars_rating',
  );
}elseif($order == 'recomendacionORIGINAL'){
  $args = array( 
    'post_type' => 'preguntas',
    'order' => 'DESC',
    'orderby' => $order,
  );
}else{
  $args = array( 
    'post_type' => 'preguntas',
    'order' => 'DESC',
    'orderby' => $order,
    'number' => 9999,
  );
  $pubs_count_query = new WP_Query( $args );
	$pubs_count = $pubs_count_query->get_posts();
	$total_pubs = $pubs_count ? count($pubs_count) : 1;
	$total_pages = 1;
	$offset = $pubs_per_page * ($paged - 1);
	$total_pages = ceil($total_pubs / $pubs_per_page);
  $prox_page = $paged+1;
	$base = removeqsvar(get_site_url().$Path, 'pag');
  if($_GET['order']=='') $base .= '?order=date';
  if($paged>1) $base = substr($base, 0, -1);
  $base .= '&pag=' . $prox_page; 
  $args = array( 
    'post_type' => 'preguntas',
    'order' => 'DESC',
    'orderby' => $order,
    'posts_per_page' => $pubs_per_page,
    'offset' => $offset,
  );
}

$wp_query = new WP_Query( $args );
?>

<?php include( locate_template(  'menu-directorio.php' )); ?>

<?php
if($_GET['send'] == 'ok') echo '<div class="avise success" id="avise"><p class="success">Pregunta enviada con éxito!</p></div>';
if($hasError){
  echo '<div class="avise error" id="avise">';
  foreach($publishError as $v) echo '<p class="error">'.$v.'</p>';
	echo '</div>';
}?>

<div id="preguntamain"  class="main">
	<div class="center twocolumn" id="mainloop">
    
    <?php include( locate_template(  'publish-pregunta.php' )); ?>
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php
		$rating_total = get_post_meta($post->ID, 'ec_stars_rating', true);
		$rating_count = get_post_meta($post->ID, 'ec_stars_rating_count', true);
		$rating_med = $rating_count == 0 ? 0 : round($rating_total/$rating_count,2);
		
		?>
    
    	<div id="pregunta-<?php the_ID(); ?>" class="archive pregunta">
        	<div id="preguntahead-<?php the_ID(); ?>" class="archivehead pregunta">
            <div id="preguntatitle-<?php the_ID(); ?>" class="archivetitle pregunta">
              <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            </div>
            <div id="preguntaprofile-<?php the_ID(); ?>" class="archiveprofile pregunta">
              <?php echo '<div class="profile-archive-foto" title="Publicado por '.get_the_author_meta('first_name',get_the_author_meta('ID') ).' '.get_the_author_meta('last_name',get_the_author_meta('ID')).'"><a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.wp_get_attachment_image(get_the_author_meta('foto_personal', get_the_author_meta('ID')),array(29, 29) ).'</a></div>'; ?>
            </div>
            <div id="preguntainfo-<?php the_ID(); ?>" class="archiveinfo pregunta">
              <p class="archiveinfop">Publicado por
                <?php echo '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">';
											if(get_the_author_meta('type', get_the_author_meta('ID')) != 'estudio') echo get_the_author_meta('first_name',get_the_author_meta('ID') ).' ';
											echo get_the_author_meta('last_name',get_the_author_meta('ID')).'</a>';?>
                <br>
                <?php echo get_the_date();?>
              </p>
            </div>
        	</div>
				<?php the_excerpt();?>
        <div id="preguntameta-<?php the_ID(); ?>" class="archivemeta pregunta">
          <p class="archiveinfop"><a href="<?php the_permalink();?>#disqus_thread" class="disquslink">Sin comentarios</a> | 
           <?php if($rating_count == 0 || $rating_total == 0) echo 'Sin votos';
								 elseif($rating_count == 1) echo '1 voto';
								 else echo $rating_count.' votos'; ?> | 
           <?php if ($rating_med == 0 ) echo 'Sin nota';
								 else echo $rating_med.' de media';?> |
            		 Sin recomendaciones |
          			 <a class="popup" target="popup" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>','name','width=600,height=400')"><?php the_svg_icon('facebook');?></a>  <a target="popup" class="popup" onclick="window.open('http://twitter.com/home?status=<?php the_title();?>%20<?php the_permalink();?>%20via%20@DisIndEs','name','width=600,height=400')"><?php the_svg_icon('twitter');?></a> <a class="popup" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;title=<?php the_title();?>&amp','name','width=600,height=400')"><?php the_svg_icon('linkedin');?></a> <a class="popup" onclick="window.open('https://plus.google.com/share?url=<?php the_title();?>%20<?php the_permalink();?>','name','width=600,height=400')"><?php the_svg_icon('google+');?></a></p>
          <p></p>
        </div>
        
        
        
      </div>
    <?php endwhile; else : echo "No se han encontrado resultados"; endif; ?>
    

    
    

    
	</div>
</div>

<div class="navigation" style="display:none;">
  <?php echo paginate_links( array(
    'base' => $base,
    'format' => '&pag=%#%',
    'prev_text' => __('&laquo; Previous'),
    'next_text' => __('Next &raquo;'),
    'total' => $total_pages,
    'current' => $page,
    'end_size' => 1,
    'mid_size' => 5,
    'add_args' => false,
  ));?>
</div>

<script type="text/javascript"> 
var disqus_shortname = 'disenadoresindustrialeses';
(function () {
  var s = document.createElement('script');
  s.async = true;
  s.type = 'text/javascript';
  s.src = '//' + disqus_shortname + '.disqus.com/count.js';
  (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
}()); 
</script>



<?php get_footer(); ?>