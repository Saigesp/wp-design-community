<?php get_header(); ?>
<?php
$user = wp_get_current_user();
?> 

<script>
function CheckBoxes() {
    document.getElementById("chepro").checked = true;
    document.getElementById("chestu").checked = true;
    document.getElementById("cheest").checked = true;
}
  

</script>

<div id="home" class="homer">
<div class="wrap-mini">
<div class="vertical-wrap">

<h1 class="home-title" style="font-family: 'Titillium Web'; ">¿Buscas diseñadores?</h1>
<h3 class="home-title">Bienvenido a la comunidad de profesionales del <span class="pink">diseño industrial</span></h3> 

<div class="searchform searchome" onload="check()">
<?php require_once( 'searchform-home.php' ); ?>
</div>
<h3 class="home-title" style="margin-top:10px;">  
<?php $result = count_users();
echo 'Actualmente tenemos <a href="http://xn--diseadoresindustriales-nec.es/disenadores">'.$result["avail_roles"]['author'].' diseñadores</a> registrados';
?>
</h3>
  
<script>
  CheckBoxes();
</script>



</div> <!-- vertical wrap -->
</div> <!-- wrap -->
</div> <!-- home -->
<div class="bg-padding bg-darkblue" id="bg-padding-homer-top">
<div id="queesdi">
  <p><span style="text-decoration:underline;">Diseñadoresindustriales.es</span> es un directorio profesional que tiene como finalidad ser un punto de encuentro entre diseñadores industriales y todas aquellas empresas susceptibles de contratar sus servicios.</p>
	<p>El directorio es totalmente gratuito, tiene un carácter abierto y está gestionado por la propia comunidad de diseñadores industriales.</p>
	<p>El proyecto nace de la imperiosa necesidad de visibilizar a los profesionales del diseño industrial, sean estudiantes, freelances, y/o estudios, más allá de otras plataformas ya existentes, siendo este directorio totalmente exclusivo para diseñadores industriales.</p>
  <p style="text-align:right; color: #ccc;"><a href="http://xn--diseadoresindustriales-nec.es/comenzando/">¿Quieres saber más?</a></p>
</div> <!-- wrap -->  
</div> <!-- darkblue -->




<div class="bg-padding bg-snow">
  <div id="homeprofilearchive">
  
  <?php
  $original_query = $wp_query;
  $args = array( 
    'exclude' => array( 1 ),
    'role' => 'author',
    'meta_key' => 'validate_date',
    'orderby'  => 'meta_value',
    'order' => 'DESC',
    'number' => 8,
    'meta_query'     => array(
      array(
        'key'       => 'perfil_publico',
        'value'     => '1',
        'compare'   => '=',
        'type'      => 'NUMERIC',
      ),
    ),
  );
  $cont = 0;
  $user_query = new WP_User_Query($args);
  if ( !empty( $user_query->results ) ) {	
    
    echo "<h2>Últimas incorporaciones</h2>";
    
    foreach ( $user_query->results as $user ) {		
      $cont++;
      $user_id = $user->ID;
      $op_user = get_user_meta($user_id, 'op_user', true );
      $image = get_the_author_meta('foto_personal', $user_id );
      
      echo '<div class="homeprofile '; if($cont>4){echo 'segundafila';} echo'">';    
        if( $image ){
          echo '<div class="profile-foto profile-foto-edit">';
            echo '<a href="'.get_author_posts_url($user_id).'">';
              echo wp_get_attachment_image( $image,array(100, 100));
            echo '</a>';
          echo '</div>';
        }
        echo '<p><b><a href="'.get_author_posts_url($user_id).'">';
        if(get_the_author_meta( 'type', $user_id) != 'estudio') echo get_the_author_meta('first_name',$user_id ).' ';
        echo get_the_author_meta('last_name',$user_id ).'</a></b></p>';
      echo '</div>';
    }
    echo '<p style="text-align:right;"><a style="color: #F46553;" href="http://xn--diseadoresindustriales-nec.es/disenadores/?order=registered">Ver más</a></p>';
  }    
  ?>	
  </div> <!-- wrap -->  
</div> <!-- darkblue -->
<div class="bg-padding bg-darkblue" id="bg-padding-homer-bottom">
  <div id="rrss">
    <div class="homerfifty">
      	<h3 class="newsletter">Redes sociales</h3>
      	<div class="onecolumn" style="margin: 0 auto;">
      		<p><a href="https://twitter.com/DisIndEs" title="Twitter de diseñadoresindustriales.es" target="_blank"><?php the_svg_icon('twitter');?> Twitter</a></p>
          <p><a href="https://twitter.com/DisIndEs_Bot" title="Twitter automático de diseñadoresindustriales.es" target="_blank"><?php the_svg_icon('twitter');?> Twitter Bot</a></p>
      		<p><a href="https://www.facebook.com/disenadoresindustriales.es" title="Página de FB de diseñadoresindustriales.es" target="_blank"><?php the_svg_icon('facebook');?> Página Facebook</a></p>
        </div>
    </div>
    <div class="homerfifty">
      <?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
      		<h3 class="newsletter">Newsletter</h3>
              <div class="widget-area profilebox page onecolumn" id="newsletterhome">
                  <?php dynamic_sidebar( 'sidebar-1' ); ?>
              </div><!-- .widget-area -->
      <?php } ?>
    </div>
  </div> <!-- wrap -->  
</div> <!-- darkblue -->



<?php get_footer(); ?>