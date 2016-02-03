<?php get_header(); ?>
<?php $number = rand(1, 28);
function excuseRandmon($n){
	switch ($n) {
  
    case '1' : echo 'Eso no estaba por escrito'; break;
    case '2' : echo 'La investigación de mercado decía eso'; break;
    case '3' : echo 'Los usuarios no lo notarán'; break;
    case '4' : echo 'La culpa es del informático'; break;
    case '5' : echo 'Eso es cosa del moldista'; break;
    case '6' : echo 'El briefing no decía eso'; break;
    case '7' : echo 'Yo no diseñé la identidad corporativa'; break;
    case '8' : echo 'Ya aprenderán a usarlo'; break;
    case '9' : echo 'Eso pasa por fabricar en China'; break;
    case '10' : echo 'El número marcado no se encuentra disponible'; break;
    case '11' : echo '¿Acaso no bastaba con el boceto de la servilleta?'; break;
    case '12' : echo '¡Pues que se lean el manual de instrucciones!'; break;
    case '13' : echo '¡Los ensayos son para cobardes!'; break;
    case '14' : echo 'Yo lo envié bien a fábrica'; break;
    case '15' : echo 'Ese no es mi estilo de diseño'; break;
    case '16' : echo 'Te envié el correo ayer<br>¿Aún no te ha llegado?'; break;
    case '17' : echo '¿Has mirado en la bandeja de SPAM?'; break;
    case '18' : echo 'Eso es culpa de los de marketing'; break;
    case '19' : echo '¿Has probado a darle unos golpecitos?'; break;
    case '20' : echo 'Philippe Starck lo hace así'; break;
    case '21' : echo 'Se me ha metido un virus ruso en el ordenador'; break;
    case '22' : echo 'Lo dejé enviándose. ¿No te ha llegado?'; break;
    case '23' : echo 'Eso es culpa de los de correos'; break;
    case '24' : echo 'No se diseñó para eso'; break;
    case '25' : echo '¿Nunca oiste aquello de que menos es más?'; break;
    case '26' : echo 'John Ive lo hace así'; break;
    case '27' : echo 'No me iba Internet'; break;
    case '28' : echo 'Nadie se ha quejado nunca de eso'; break;

}}?>


<div id="mainerror-404">
	<div class="center twocolumn"> 
    <img class="e404" src="http://xn--diseadoresindustriales-nec.es/wp-content/themes/disindu/img/404.svg"/>
    <h3 class="e404">"<?php excuseRandmon($number);?>"</h3>
		<p class="e404">No tenemos excusa. Algo ha salido mal y no encontramos la página solicitada.<br>Mientras lo arreglamos, ¿quieres volver al <a href="http://xn--diseadoresindustriales-nec.es">inicio</a>?</p>
    <p class="e404"><br><br>O si prefieres ver más excusas, recarga esta página.<br><br><a href="javascript:location.reload(true)" class="button">Recargar</a></p>
    <p class="e404"><br><a href="http://designerexcuses.com/" style="color: #ccc; font-size: 10px;">Inspirado en Designers Excuses</a></p>
    
    
  </div>
</div>

<?php get_footer(); ?>