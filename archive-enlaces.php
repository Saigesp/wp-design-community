<?php get_header();?>

<?php
$type = $_GET['type'] == '' ? 'all' : $_GET['type'];
$tematica_old = '';
$original_query = $wp_query;

if ($type == 'all'){
  $args = array( 
    'post_type' => 'enlaces',
    'order' => 'ASC',
    'orderby' => 'title',
  );
}else{
  $args = array( 
    'post_type' => 'enlaces',
    'order' => 'ASC',
    'orderby' => 'meta_value',
    'meta_key' => 'tema',
    'meta_query' => array(
				array(
					'key'     => 'type',
					'value'   => $type,
					'compare' => '=',
				),
		),
  );
}
$wp_query = new WP_Query( $args );
?>

<?php
$publishError = array();
if(isset($_POST['submitted'])){
  if(trim($_POST['postformtitle']) === ''){ array_push($publishError, 'El título no debe estar vacío!'); $hasError = true;}
  if($_POST['postformdesc'] == ''){ array_push($publishError, 'La descripción no debe estar vacía!'); $hasError = true;}
  if($_POST['postformtype'] == ''){ array_push($publishError, 'Debes elegir un tipo de enlace!'); $hasError = true;}
  if($_POST['postformtema'] == ''){ array_push($publishError, 'Debes elegir una temática!'); $hasError = true;}
  if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$_POST['postformurl'])) { array_push($publishError, 'Enlace url incorrecto!'); $hasError = true;}
  if($_POST['postformtype'] == 'asociacion' && $_POST['postformtype'] == ''){ array_push($publishError, 'Debes indicar las siglas!'); $hasError = true;}
}
?>


<?php include( locate_template(  'menu-directorio.php' )); ?>

<?php
if($_GET['send'] == 'ok') echo '<div class="avise success" id="avise"><p class="success">Evento enviado con éxito!</p></div>';
if($hasError){
  echo '<div class="avise error" id="avise">';
  foreach($publishError as $v) echo '<p class="error">'.$v.'</p>';
	echo '</div>';
}?>

<div id="enlacemain"  class="main">
	<div class="center twocolumn">
    
    <?php include( locate_template(  'publish-enlace.php' )); ?>
    
		<?php if ($type == 'all'){ ?>
  		<div id="enlace-<?php the_ID(); ?>" class="archive-list enlace">
        <h2 class="list-title">Enlaces</h2> 
        <div id="enlaceheadname-<?php the_ID(); ?>" class="listname listhead">
          <p><b>Nombre</b></p>
        </div>
        <div id="enlaceheadtipo-<?php the_ID(); ?>" class="listtipo listhead">
          <p><b>Tipo</b></p>
        </div>
        <div id="enlacetheme-<?php the_ID(); ?>" class="listtheme listhead">
          <p><b>Temática</b></p>
        </div>
      </div>
    <?php }?>
          
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    	<?php
			$tipo = get_field_object('type');
			$tipoval = get_field('type');
			$tipolog = $tipo['choices'][ $tipoval ];
			$tema = get_field_object('tema');
			$temaval = get_field('tema');
			$tematica = $tema['choices'][ $temaval ];
			?>
    	
        
        <?php if ($type != 'all' && $tematica != $tematica_old){ ?>
        <div id="enlace-<?php the_ID(); ?>" class="archive-list enlace">
        	<h2 class="list-title"><?php echo $tematica;?></h2>
        	<?php $tematica_old = $tematica; ?>
          <div id="enlaceheadname-<?php the_ID(); ?>" class="listname listhead <?php if ($type == 'asociacion') echo 'large'; elseif($type == 'medio' || $type == 'foro' || $type == 'otro') echo 'short';?>">
            <p><b>Nombre</b></p>
          </div>
          <div id="enlaceheaddesc-<?php the_ID(); ?>" class="listdesc listhead <?php if ($type == 'asociacion') echo 'large'; elseif($type == 'medio' || $type == 'foro' || $type == 'otro') echo 'short';?>">
             <p><b><?php if ($type == 'asociacion') echo 'Ámbito'; else echo 'Descripción';?></b></p>
          </div>
        </div>
      	<?php }?>
        
        
      <div id="enlace-<?php the_ID(); ?>" class="archive-list enlace">
        <div id="enlacename-<?php the_ID(); ?>" class="listname <?php if ($type == 'asociacion') echo 'large'; elseif($type == 'medio' || $type == 'foro' || $type == 'otro') echo 'short';?>">
          <p>
            <a href="<?php echo get_field('enlace');?>" title="<?php if($tipoval == 'asociacion') echo get_field('siglas').' - '; the_title(); if(get_the_author_meta('ID') != 1){ echo ', publicado por '; if(get_the_author_meta('type') != 'estudio') echo get_the_author_meta('first_name').' '; echo get_the_author_meta('last_name');}?>" target="_blank"><?php the_title(); if($tipoval == 'asociacion') echo ' ('.get_field('siglas').')'; ?>
            </a>
            <?php if(is_user_role('administrator') || is_user_role('editor')){?>
            	<a href="http://xn--diseadoresindustriales-nec.es/wp-admin/post.php?post=<?php the_ID(); ?>&action=edit">
                <?php the_svg_icon('edit');?>
              </a>
            <?php }?>
          </p>
        </div>
        <?php if ($type != 'all'){?>
          <div id="enlacedesc-<?php the_ID(); ?>" class="listdesc">
            <p><?php echo get_field('descripcion');?></p>
          </div>
        <?php }else{?>
          <div id="enlacetipo-<?php the_ID(); ?>" class="listtipo">
            <p><?php echo $tipolog;?></p>
          </div>
          <div id="enlacetheme-<?php the_ID(); ?>" class="listtheme">
            <p><?php echo $tematica;?></p>
          </div>
        <?php } ?>
        <?php if(get_the_author_meta('ID') != '1'){ ?>
          <div id="enlaceauthor-<?php the_ID(); ?>" class="listauthor">
            <?php echo '<div class="profile-list-foto" title="Publicado por '.get_the_author_meta('first_name',get_the_author_meta('ID') ).' '.get_the_author_meta('last_name',get_the_author_meta('ID') ).'"><a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.wp_get_attachment_image(get_the_author_meta('foto_personal', get_the_author_meta('ID')),array(14, 14) ).'</a></div>'; ?>
          </div>
        <?php } ?>
      </div>
    
    
    
		<?php endwhile; ?>
    
    <?php else : echo "No se han encontrado resultados"; endif; ?>
    
	</div>
</div>
<?php get_footer(); ?>