<?php get_header(); ?>

<style>
  #page-474 .homeprofile p {font-size: 1rem; text-align: center; margin-bottom: 0; line-height: 1rem;}
  #page-474 .homeprofile a {color: #3D4352;}
  #page-474 .homeprofile p.pseudonimo {font-size: 0.8rem; line-height: 1.5rem; color: #999;}
</style>

<?php if (get_field('pagemenu') == 'faqs') include( locate_template(  'menu-faqs.php' )); ?>

<div id="pagemain"  class="main">
  <div class="center twocolumn">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div id="page-<?php the_ID(); ?>" class="single page">
        <div id="pageheader-<?php the_ID(); ?>" class="header">
        	<h2><?php the_title();?></h2>
        </div>
        <div id="pagebody-<?php the_ID(); ?>" class="body">
        	<?php the_content();?>
          
          <div class="homeprofile">
						<div class="profile-foto profile-foto-edit">
							<a href="http://www.xn--diseadorindustrial-q0b.es/" target="_blank">
                <img width="100" height="100" src="http://xn--diseadoresindustriales-nec.es/img/about/josemanuelmateo.jpg" class="attachment-100x100" alt="Jose Manuel Mateo">
              </a>
						</div>
						<p><b><a href="http://www.xn--diseadorindustrial-q0b.es/" target="_blank">Jose Manuel Mateo</a></b></p>
            <p class="pseudonimo">Promotor y supervisión</p>            
					</div>
          <div class="homeprofile">
						<div class="profile-foto profile-foto-edit">
							<a href="http://www.saigesp.es" target="_blank">
                <img width="100" height="100" src="http://xn--diseadoresindustriales-nec.es/img/about/santiespinosa.jpg" class="attachment-100x100" alt="Santi Espinosa">
              </a>
						</div>
						<p><b><a href="http://www.saigesp.es" target="_blank">Santi Espinosa</a></b></p>
            <p class="pseudonimo">Programación y desarrollo</p>            
					</div>
          <div class="homeprofile">
						<div class="profile-foto profile-foto-edit">
							<a href="http://es.linkedin.com/in/cvazquezid/es" target="_blank">
                <img width="100" height="100" src="http://xn--diseadoresindustriales-nec.es/img/about/cristinavazquez.jpg" class="attachment-100x100" alt="Cristina Vázquez">
              </a>
						</div>
						<p><b><a href="http://es.linkedin.com/in/cvazquezid/es" target="_blank">Cristina Vázquez</a></b></p>
            <p class="pseudonimo">Identidad gráfica</p>            
					</div>
          <div class="homeprofile">
						<div class="profile-foto profile-foto-edit">
							<a href="http://es.linkedin.com/pub/mar%C3%ADa-alonso-garcia/3a/713/831/es" target="_blank">
                <img width="100" height="100" src="http://xn--diseadoresindustriales-nec.es/img/about/mariaalonso.jpg" class="attachment-100x100" alt="María Alonso">
              </a>
						</div>
						<p><b><a href="http://es.linkedin.com/pub/mar%C3%ADa-alonso-garcia/3a/713/831/es" target="_blank">María Alonso</a></b></p>
            <p class="pseudonimo">Comunicación</p>            
					</div>
          
          <div class="homeprofile">
						<div class="profile-foto profile-foto-edit">
							<a href="http://es.linkedin.com/in/mkdugo/es" target="_blank">
                <img width="100" height="100" src="http://xn--diseadoresindustriales-nec.es/img/about/maricarmendugo.jpg" class="attachment-100x100" alt="Mª Carmen Gómez Dugo">
              </a>
						</div>
						<p><b><a href="http://es.linkedin.com/in/mkdugo/es/" target="_blank">Mª Carmen Dugo</a></b></p>
            <p class="pseudonimo">Apoyo gráfico</p>            
					</div>
          <div class="homeprofile">
						<div class="profile-foto profile-foto-edit">
							<a href="" target="_blank">
                <img width="100" height="100" src="http://xn--diseadoresindustriales-nec.es/img/about/victorneiro.jpg" class="attachment-100x100" alt="Victor Neiro">
              </a>
						</div>
						<p><b><a href="" target="_blank">Víctor Neiro</a></b></p>
            <p class="pseudonimo">Alfa tester</p>            
					</div>
          <div class="homeprofile">
						<div class="profile-foto profile-foto-edit">
							<a href="http://es.linkedin.com/pub/juan-manuel-rodriguez-lara/67/108/b39/es" target="_blank">
                <img width="100" height="100" src="http://xn--diseadoresindustriales-nec.es/img/about/juanmanuelrodriguez.jpg" class="attachment-100x100" alt="Juan Manuel Rodríguez">
              </a>
						</div>
						<p><b><a href="http://es.linkedin.com/pub/juan-manuel-rodriguez-lara/67/108/b39/es" target="_blank">Juan Manuel Rodríguez</a></b></p>
            <p class="pseudonimo">Alfa tester</p>            
					</div>
          <div class="homeprofile">
						<div class="profile-foto profile-foto-edit">
							<a href="http://es.linkedin.com/pub/javi-pfaff/4b/8a4/514/es" target="_blank">
                <img width="100" height="100" src="http://xn--diseadoresindustriales-nec.es/img/about/javierpfaff.jpg" class="attachment-100x100" alt="Javier Pfaff">
              </a>
						</div>
						<p><b><a href="http://es.linkedin.com/pub/javi-pfaff/4b/8a4/514/es" target="_blank">Javier Pfaff</a></b></p>
            <p class="pseudonimo">Alfa tester</p>            
					</div>
          
          <p>Esperamos muy sinceramente que disfrutéis del proyecto y que éste se convierta en una herramienta eficaz en el desempeño de nuestra profesión.</p>
        </div>
        <div id="pagefooter-<?php the_ID(); ?>" class="footer">
        </div>
      </div>
    <?php endwhile; else : echo "No hay post"; endif; ?>
  </div>
</div>

<?php get_footer(); ?>