<?php get_header();?>

<?php
function removeqsvar($url, $varname) {
    return preg_replace('/([?&])'.$varname.'=[^&]+(&|$)/','$1',$url);
}

$order = $_GET['order'] == '' ? 'date' : $_GET['order'];
$paged = $_GET['pag'] == '' ? '1' : $_GET['pag'];
$pubs_per_page = get_option("pubs_per_page");
$Path=$_SERVER['REQUEST_URI'];
$current_date = current_time('Ymd');
$original_query = $wp_query;
  $args = array( 
    'post_type' => 'concursos',
		'order' => 'ASC',
    'orderby' => 'meta_value_num',
    'meta_key' => 'fecha_limite',
    'meta_query' => array(
      array(
        'key'     => 'fecha_limite',
        'value'   => $current_date,
        'compare' => '>=',
      ),
    ),
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
    'post_type' => 'concursos',
		'order' => 'ASC',
    'orderby' => 'meta_value_num',
    'meta_key' => 'fecha_limite',
    'meta_query' => array(
      array(
        'key'     => 'fecha_limite',
        'value'   => $current_date,
        'compare' => '>=',
      ),
    ),
    'posts_per_page' => $pubs_per_page,
    'offset' => $offset,
  );

$wp_query = new WP_Query( $args );
?>

<?php include( locate_template(  'menu-directorio.php' )); ?>

<?php /*
if($_GET['send'] == 'ok') echo '<div class="avise success" id="avise"><p class="success">Pregunta enviada con éxito!</p></div>';
if($hasError){
  echo '<div class="avise error" id="avise">';
  foreach($publishError as $v) echo '<p class="error">'.$v.'</p>';
	echo '</div>'; 
} */?>

<div id="concursomain"  class="main">
	<div class="center twocolumn" id="mainloop">
    
    <?php/* include( locate_template(  'publish-pregunta.php' )); */?>
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    if ($denuncias >= get_option('denunce_v_count')) continue;
		$denuncias = get_post_meta($post->ID, 'hasiodenunciado_count', true);
		$fecha_limite = DateTime::createFromFormat('Ymd', get_field('fecha_limite'));
		$url_link = parse_url(get_field('link'));
		?>
    
    	<div id="concurso-<?php the_ID(); ?>" class="archive concurso">
        	<div id="concursohead-<?php the_ID(); ?>" class="archivehead concurso">
            <div id="concursotitle-<?php the_ID(); ?>" class="archivetitle concurso">
              <h2>
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
                <?php if(is_user_role('administrator')){?>
            			<a href="http://xn--diseadoresindustriales-nec.es/wp-admin/post.php?post=<?php the_ID(); ?>&action=edit">
                <?php the_svg_icon('edit');?>
              </a>
            <?php }?>
              </h2>
        <?php if ($denuncias >= get_option('denunce_a_count')){?>
            <div style="background: papayawhip; color: #666; font-size: 0.7rem;">
              <p style="margin:0 4px"><b>Atención:</b> Concurso con varias puntuaciones negativas</p>
            </div>
        <?php } ?>
            </div>
            <div id="concursoinfo-<?php the_ID(); ?>" class="archiveinfo concurso">
              <p class="archiveinfop"><strong>Publicado por: </strong>
                <?php echo '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">';
											if(get_the_author_meta('type', get_the_author_meta('ID')) != 'estudio') echo get_the_author_meta('first_name',get_the_author_meta('ID') ).' ';
											echo get_the_author_meta('last_name',get_the_author_meta('ID')).'</a>';?>
                <br>
                <strong>Fecha límite:</strong> <?php echo $fecha_limite->format('d M Y');?> | <strong>1<sup>er</sup> Premio:</strong> <?php echo get_field('premio');?>
                <br>
                <strong>Requisitos:</strong> <?php echo get_field('requisitos');?>
                <br>
                <strong>Más información:</strong> <a href="<?php echo get_field('link');?>" target="_blank"><?php echo $url_link['host'];?></a>
              </p>
            </div>
        	</div>
				<?php the_excerpt();?>
        <div id="concursometa-<?php the_ID(); ?>" class="archivemeta concurso">
          <p class="archiveinfop"><a href="<?php the_permalink();?>#disqus_thread" class="disquslink">Sin comentarios</a> | 
            		 Sin recomendaciones |
           <a href="<?php the_permalink();?>#popupdenunce"><?php if($denuncias == 0) echo 'Sin negativos'; elseif($denuncias == 1) echo '1 negativo'; else echo $denuncias.' negativos'; ?></a> | 
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