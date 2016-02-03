<?php get_header();?>

<?php
$page = $_GET['pag'];
$type = $_GET['type'] == '' ? 'all' : $_GET['type'];
$original_query = $wp_query;
$current_date = current_time('Ymd');
$yearold = DateTime::createFromFormat('Ymd', '20010101');

if ($type == 'all'){
  $args = array( 
    'post_type' => 'eventos',
    'order' => 'ASC',
    'orderby' => 'meta_value_num',
    'meta_key' => 'fecha_de_inicio',
    'meta_query' => array(
      array(
        'key'     => 'fecha_de_inicio',
        'value'   => $current_date,
        'compare' => '>=',
      ),
    ),
  );
}else{
  $args = array( 
    'post_type' => 'eventos',
    'order' => 'ASC',
    'orderby' => 'meta_value_num',
    'meta_key' => 'fecha_de_inicio',
    'meta_query' => array(
      array(
        'key'     => 'fecha_de_inicio',
        'value'   => $current_date,
        'compare' => '>=',
      ),
      array(
        'key'     => 'tipo_evento',
        'value'   => $type,
        'compare' => '=',
      ),
      'relation' => 'AND',
    ),
  );
}
$wp_query = new WP_Query( $args );
?>

<?php



$publishError = array();
if(isset($_POST['submitted'])){
  if(trim($_POST['postformtitle']) === ''){ array_push($publishError, 'El título no debe estar vacío!'); $hasError = true;}
  if($_POST['postformcity'] == ''){ array_push($publishError, 'La ciudad no debe estar vacía!'); $hasError = true;}
  if($_POST['postformtype'] == ''){ array_push($publishError, 'Debes elegir un tipo de enlace!'); $hasError = true;}
  if($_POST['postformtema'] == ''){ array_push($publishError, 'Debes elegir una temática!'); $hasError = true;}
  if(!is_numeric($_POST['postformprice'])){ array_push($publishError, 'El precio debe ser un número!'); $hasError = true;}
  if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$_POST['postformurl'])) { array_push($publishError, 'Enlace url incorrecto!'); $hasError = true;}
  $inputdate = DateTime::createFromFormat('Ymd', $_POST['postformdateactual']);
	if(validateDate($_POST['postformdateactual'])){
    $checkdate = checkdate($inputdate->format('m') ,$inputdate->format('d') ,$inputdate->format('Y') );
    if(!$checkdate){ array_push($publishError, 'Esa fecha no existe!'); $hasError = true;}
  }else{array_push($publishError, 'Formato de fecha incorrecto!'); $hasError = true;}
}
?>


<?php include( locate_template(  'menu-directorio.php' )); ?>

<?php
if($_GET['send'] == 'ok') echo '<div class="avise success" id="avise"><p class="success">Enlace enviado con éxito!</p></div>';
if($hasError){
  echo '<div class="avise error" id="avise">';
  foreach($publishError as $v) echo '<p class="error">'.$v.'</p>';
	echo '</div>';
}?>

<div id="eventomain"  class="main">
	<div class="center twocolumn">
    
    <?php include( locate_template(  'publish-evento.php' )); ?>
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    	<?php 
			$fechaini = DateTime::createFromFormat('Ymd', get_field('fecha_de_inicio'));
			$tema = get_field_object('tema');
			$temaval = get_field('tema');
			$tematica = $tema['choices'][ $temaval ];
			if ($fechaini->format('Y') > $yearold->format('Y')){?>
        <?php $yearold = $fechaini; ?>
        <h2 class="list-title"><?php echo $fechaini->format('Y');?></h2>
        <div id="eventohead-<?php the_ID(); ?>" class="archive-list evento">
          <div id="eventoheadname-<?php the_ID(); ?>" class="listname listhead">
            <p><b>Nombre</b></p>
          </div>
          <div id="eventoheaddate-<?php the_ID(); ?>" class="listdate listhead">
            <p><b>Fecha</b></p>
          </div>
          <div id="eventoheadcity-<?php the_ID(); ?>" class="listcity listhead">
            <p><b>Ciudad</b></p>
          </div>
          <div id="eventoheadprice-<?php the_ID(); ?>" class="listprice listhead">
            <p><b>€</b></p>
          </div>
          <div id="eventoheadtheme-<?php the_ID(); ?>" class="listtheme listhead">
            <p><b>Temática</b></p>
          </div>
        </div>
      <?php }  ?>
    	<div id="evento-<?php the_ID(); ?>" class="archive-list evento">
        <div id="eventoname-<?php the_ID(); ?>" class="listname">
          <p>
            <a href="<?php echo get_field('enlace');?>" title="Enlace a <?php the_title();?>" target="_blank"><?php the_title();?></a>
            <?php if(is_user_role('administrator') || is_user_role('editor')){?>
            	<a href="http://xn--diseadoresindustriales-nec.es/wp-admin/post.php?post=<?php the_ID(); ?>&action=edit">
                <?php the_svg_icon('edit');?>
              </a>
            <?php }?>
          </p>
        </div>
        <div id="eventodate-<?php the_ID(); ?>" class="listdate">
          <p><?php echo $fechaini->format('d M');?></p>
        </div>
        <div id="eventocity-<?php the_ID(); ?>" class="listcity">
          <p><?php echo get_field('ciudad');?></p>
        </div>
        <div id="eventoprice-<?php the_ID(); ?>" class="listprice">
          <p><?php echo get_field('precio');?>€</p>
        </div>
        <div id="eventotheme-<?php the_ID(); ?>" class="listtheme">
          <p><?php echo $tematica;?></p>
        </div>
        <?php if(get_the_author_meta('ID') != '1'){ ?>
          <div id="enlaceauthor-<?php the_ID(); ?>" class="listauthor">
            <?php echo '<div class="profile-list-foto" title="Publicado por '.get_the_author_meta('first_name',get_the_author_meta('ID') ).' '.get_the_author_meta('last_name',get_the_author_meta('ID') ).'"><a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.wp_get_attachment_image(get_the_author_meta('foto_personal', get_the_author_meta('ID')),array(14, 14) ).'</a></div>'; ?>
          </div>
        <?php } ?>
      </div>
		<?php endwhile; else : echo "No se han encontrado resultados"; endif; ?>
    
	</div>
</div>
<?php get_footer(); ?>