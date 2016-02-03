<?php get_header(); ?>
<style>
  .profilebox form label {margin-top: 5px; margin-left: 0;}
  .widget-area li {list-style-type: none;}
</style>

<div style="background: dbdbdb; max-width:400px; margin:50px auto; padding:20px; text-align: center;">
  <img src="http://xn--diseadoresindustriales-nec.es/img/logo_disenadoresindustriales_400.png" style="    width: 100%; height: auto;">
<h2 style="text-align: center; font-family: 'Titillium', 'Open sans', sans-serif; text-transform: uppercase; font-weight: 900; display:none;"><span style="color: #F46553;">diseñadores</span><br>industriales.es</h2>
<p>Estamos desarrollando un <b>directorio de profesionales del diseño industrial</b> abierto a la comunidad de diseñadores para poder ofrecer mejor nuestros servicios a las industrias nacionales e internacionales.</p><br>

<p>Si eres un diseñador industrial, estudiante, asociación o estudio y estás interesado en este proyecto, te invitamos a que te suscribas a nuestro newsletter o consultes nuestro <a href="https://twitter.com/DisIndEs">twitter</a>.</p><br><br>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
    <div id="secondary" class="sidebar-container" role="complementary">
        <div class="widget-area profilebox onecolumn">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </div><!-- .widget-area -->
    </div><!-- #secondary -->
<?php } ?>


</div>
<?php
get_footer(); ?>