<?php get_header();

global $EM_Event;

/* Date */
$event_start_date = new DateTime($EM_Event->event_start_date.' '.$EM_Event->event_start_time);
$event_end_date = new DateTime($EM_Event->event_end_date.' '.$EM_Event->event_end_time);
/* Booking */

?> 

<div class="flexboxer flexboxer--event">
  <section class="wrap wrap--frame">
	<header id="header-<?php the_ID(); ?>" class="headerarticle">
		<?php  if ( has_post_thumbnail() ) { ?>
			<figure id="thumbnail" class="thumbarticle">
				<?php the_post_thumbnail('full');  ?>
			</figure>
			<div class="overflow overflow--black"></div>
		<?php }  ?>
		<div id="title" class="titlearticle">
			<div class="divtextarticle">
				<h2 class="titletextarticle titlesarticle" ><?php the_title(); ?></h2>
				<h3 class="subtitletextarticle titlesarticle"><?php if(function_exists('the_subtitle')) the_subtitle(); ?></h3>
			</div>
		</div>
		<div class="categoryarticle">
			<p><?php the_category(', ');?></p>
		</div>
	</header>
  </section><!-- end of thumbnail -->

  <section class="wrap wrap--content">
  	<?php
  	if($EM_Event->event_start_date == $EM_Event->event_end_date){
  		echo '<strong>Fecha:</strong> '.$event_start_date->format('j \d\e M \d\e Y').', de '.$event_start_date->format('H:i').' a '.$event_end_date->format('H:i');
  	}else{
  		echo '<strong>Inicio:</strong> '.$event_start_date->format('j \d\e M \d\e Y\, H:i\h').'<br><strong>Fin:</strong>   '.$event_end_date->format('j \d\e M \d\e Y\, H:i\h');
  	}
  	if($EM_Event->location->location_id > 0){
  		echo '<br><strong>Localización:</strong> '.$EM_Event->location->location_name;
  	}
  	?>
  </section>

  <section class="wrap wrap--content">
  	<?php echo $EM_Event->post_content;?>
  </section>

  <?php if(true){?>
  <section class="wrap wrap--content">
	<h3><?php echo $EM_Event->location->location_name;?></h3>
	<p><?php echo $EM_Event->location->address.', '.$EM_Event->location->town;?></p>
  </section>
  <?php } ?>

  <section class="wrap wrap--content">
  	<?php 
  	var_dump($EM_Event);
  	?>
  </section>
</div><!-- end of flexboxer -->

<?php get_footer(); ?>