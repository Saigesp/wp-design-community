<script>
$(function() {
var time = 200;
var supicons = $('.supicon');
var subicons = $('.subicon');
var usericon = $('#usericon');
var posticon = $('#posticon');
var askicon = $('#askicon');
var calendaricon = $('#calendaricon');
var concursoicon = $('#concursoicon');
var linkicon = $('#linkicon');
var workicon = $('#workicon');

if($( window ).width() > 741){
  $(usericon).on('click', function() {
    if ($('#menudircontainer').hasClass("expanded")) $('#menudircontainer').removeClass("expanded");
    if (usericon.hasClass("active")) {
      supicons.removeClass("active");
      subicons.fadeOut(time);
    }else{
      subicons.not('.subuser').css("display","none");
      supicons.removeClass("active");
      usericon.addClass("active");
      $('#menudircontainer').addClass("expanded");
      $('.subuser').fadeIn(time).css("display","inline-block");
    }
  });
  $(askicon).on('click', function() {
    if ($('#menudircontainer').hasClass("expanded")) $('#menudircontainer').removeClass("expanded");
    if (askicon.hasClass("active")) {
      supicons.removeClass("active");
      subicons.fadeOut(time);
    }else{
      subicons.not('.subask').css("display","none");
      supicons.removeClass("active");
      askicon.addClass("active");
      $('#menudircontainer').addClass("expanded");
      $('.subask').fadeIn(time).css("display","inline-block");
    }
  });
/*  $(concursoicon).on('click', function() {
    if ($('#menudircontainer').hasClass("expanded")) $('#menudircontainer').removeClass("expanded");
    if (concursoicon.hasClass("active")) {
      supicons.removeClass("active");
      subicons.fadeOut(time);
    }else{
      subicons.not('.subconc').css("display","none");
      supicons.removeClass("active");
      concursoicon.addClass("active");
      $('#menudircontainer').addClass("expanded");
      $('.subconc').fadeIn(time).css("display","inline-block");
    }
  }); */
  $(calendaricon).on('click', function() {
    if ($('#menudircontainer').hasClass("expanded")) $('#menudircontainer').removeClass("expanded");
    if (calendaricon.hasClass("active")) {
      supicons.removeClass("active");
      subicons.fadeOut(time);
    }else{
      subicons.not('.subevent').css("display","none");
      supicons.removeClass("active");
      calendaricon.addClass("active");
      $('#menudircontainer').addClass("expanded");
      $('.subevent').fadeIn(time).css("display","inline-block");
    }
  });
  $(linkicon).on('click', function() {
    if ($('#menudircontainer').hasClass("expanded")) $('#menudircontainer').removeClass("expanded");
    if (linkicon.hasClass("active")) {
      supicons.removeClass("active");
      subicons.fadeOut(time);
    }else{
      subicons.not('.sublink').css("display","none");
      supicons.removeClass("active");
      linkicon.addClass("active");
      $('#menudircontainer').addClass("expanded");
      $('.sublink').fadeIn(time).css("display","inline-block");
    }
  });
}else{
  $(usericon).on('click', function() {
    if (usericon.hasClass("active")) {
      subicons.css("display","none");
      usericon.removeClass("active");
      supicons.not(this).fadeIn(time).css("display","inline-block");
    }else{
      supicons.not(this).fadeOut(time, function(){$('.subuser').fadeIn(time).css("display","inline");});
      usericon.addClass("active");
    }
  });
  $(askicon).on('click', function() {
    if (askicon.hasClass("active")) {
      subicons.css("display","none");
      askicon.removeClass("active");
      supicons.not(this).fadeIn(time).css("display","inline-block");
    }else{
      supicons.not(this).fadeOut(time, function(){$('.subask').fadeIn(time).css("display","inline");});
      askicon.addClass("active");
    }
  });
/*  $(concursoicon).on('click', function() {
    if (concursoicon.hasClass("active")) {
      subicons.css("display","none");
      concursoicon.removeClass("active");
      supicons.not(this).fadeIn(time).css("display","inline-block");
    }else{
      supicons.not(this).fadeOut(time, function(){$('.subconc').fadeIn(time).css("display","inline");});
      concursoicon.addClass("active");
    }
  }); */
  $(calendaricon).on('click', function() {
    if (calendaricon.hasClass("active")) {
      subicons.css("display","none");
      calendaricon.removeClass("active");
      supicons.not(this).fadeIn(time).css("display","inline-block");
    }else{
      supicons.not(this).fadeOut(time, function(){$('.subevent').fadeIn(time).css("display","inline");});
      calendaricon.addClass("active");
    }
  });
  $(linkicon).on('click', function() {
    if (linkicon.hasClass("active")) {
      subicons.css("display","none");
      linkicon.removeClass("active");
      supicons.not(this).fadeIn(time).css("display","inline-block");
    }else{
      supicons.not(this).fadeOut(time, function(){$('.sublink').fadeIn(time).css("display","inline");});
      linkicon.addClass("active");
    }
  });
}


  
});
</script>


<div id="menudircontainer" class="menudir">
  <div id="menudiricon" class="svgicon">
    <div id="usericon" title="Usuarios" class="supicon"><?php the_svg_icon("nombre");?> <span>Diseñadores</span></div>
    <div id="posticon" title="Artículos" class="supicon"><?php the_svg_icon("articulo");?> <span>Artículos</span></div>
    <div id="askicon" title="Preguntas" class="supicon"><?php the_svg_icon("pregunta");?> <span>Preguntas</span></div>
    <div id="concursoicon" title="Concursos" class="supicon"><?php the_svg_icon("trofeo");?> <span>Concursos</span></div>
    <div id="calendaricon" title="Calendario" class="supicon"><?php the_svg_icon("calendario");?> <span>Eventos</span></div>
    <div id="linkicon" title="Enlaces" class="supicon"><?php the_svg_icon("apellidos");?> <span>Enlaces</span></div>
    <div id="workicon" title="Trabajo" class="supicon"><?php the_svg_icon("trabajo");?> <span>Trabajo</span></div>
  
    <div id="usernewicon" title="Últimos usuarios" class="subicon subuser">
      <a href="<?php echo get_bloginfo('url');?>disenadores/?order=registered"><?php the_svg_icon("nuevo");?> <span>Recientes</span></a>
    </div>
    <div id="useralfaicon" title="Orden alfabético" class="subicon subuser">
      <a href="<?php echo get_bloginfo('url');?>disenadores/?order=last_name"><?php the_svg_icon("alfabeta");?> <span>Alfabético</span></a>
    </div>
    <div id="userrandomicon" title="Orden aleatorio" class="subicon subuser">
      <a href="<?php echo get_bloginfo('url');?>disenadores/?order=rand"><?php the_svg_icon("random");?> <span>Aleatorio</span></a>
    </div>
    <?php if(is_user_role('author') || is_user_role('editor') || is_user_role('administrator')){?>
      <div id="nonusericon" title="Usuarios por confirmar" class="subicon subuser">
        <a href="<?php echo get_bloginfo('url');?>disenadores/?order=registered&status=pending"><?php the_svg_icon("ojo");?> <span>Pendientes</span></a>
      </div>
    <?php } ?>
    
    <div id="askdateicon" title="Preguntas más recientes" class="subicon subask">
      <a href="<?php echo get_bloginfo('url');?>preguntas/?order=date"><?php the_svg_icon("nuevo");?> <span>Recientes</span></a>
    </div>
    <div id="askvoteicon" title="Preguntas más recientes" class="subicon subask">
      <a href="<?php echo get_bloginfo('url');?>preguntas/?order=votos"><?php the_svg_icon("nuevo");?> <span>Más votadas</span></a>
    </div>
    
    <div id="concallicon" title="Todos los concursos" class="subicon subconc">
      <a href="<?php echo get_bloginfo('url');?>concursos/?order=date"><?php the_svg_icon("nuevo");?> <span>Todos</span></a>
    </div>
    
    <div id="eventallicon" title="Todos los eventos" class="subicon subevent">
      <a href="<?php echo get_bloginfo('url');?>eventos/"><?php the_svg_icon("nuevo");?> <span>Todos</span></a>
    </div>
    <div id="eventexpoicon" title="Ferias y exposiciones" class="subicon subevent">
      <a href="<?php echo get_bloginfo('url');?>eventos/?type=exposicion"><?php the_svg_icon("nuevo");?> <span>Exposiciones</span></a>
    </div>
    <div id="eventcongicon" title="Jornadas y congresos" class="subicon subevent">
      <a href="<?php echo get_bloginfo('url');?>eventos/?type=congreso"><?php the_svg_icon("nuevo");?> <span>Jornadas</span></a>
    </div>
    <div id="eventotroicon" title="Otros eventos" class="subicon subevent">
      <a href="<?php echo get_bloginfo('url');?>eventos/?type=otro"><?php the_svg_icon("nuevo");?> <span>Otros</span></a>
    </div>
    
    <div id="linkallicon" title="Todos los enlaces" class="subicon sublink">
      <a href="<?php echo get_bloginfo('url');?>enlaces/"><?php the_svg_icon("nuevo");?> <span>Todos</span></a>
    </div>
    <div id="linkasocicon" title="Asociaciones" class="subicon sublink">
      <a href="<?php echo get_bloginfo('url');?>enlaces/?type=asociacion"><?php the_svg_icon("nuevo");?> <span>Asociaciones</span></a>
    </div>
    <div id="linkmediicon" title="Medios de comunicación" class="subicon sublink">
      <a href="<?php echo get_bloginfo('url');?>enlaces/?type=medio"><?php the_svg_icon("nuevo");?> <span>Medios</span></a>
    </div>
    <div id="linkforoicon" title="Foros de diseño" class="subicon sublink">
      <a href="<?php echo get_bloginfo('url');?>enlaces/?type=foro"><?php the_svg_icon("nuevo");?> <span>Foros</span></a>
    </div>
    <div id="linkotroicon" title="otros enlaces" class="subicon sublink">
      <a href="<?php echo get_bloginfo('url');?>enlaces/?type=otro"><?php the_svg_icon("nuevo");?> <span>Otros</span></a>
    </div>
  </div>
</div>




