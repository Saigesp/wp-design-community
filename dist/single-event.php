<?php get_header();

global $EM_Event;

/* Date */
$event_start_date = new DateTime($EM_Event->event_start_date.' '.$EM_Event->event_start_time);
$event_end_date = new DateTime($EM_Event->event_end_date.' '.$EM_Event->event_end_time);
/* Booking */

?> 

<div class="flexboxer flexboxer--event">
	<?php if(has_post_thumbnail()){ ?>
		<!-- thumbnail -->
		<section class="wrap wrap--frame">
			<header id="header-<?php the_ID(); ?>" class="headerarticle">
				<figure id="thumbnail" class="thumbarticle">
					<?php the_post_thumbnail('full');  ?>
				</figure>
				<div class="overflow overflow--black"></div>
				<div id="title" class="titlearticle">
					<div class="divtextarticle">
						<h2 class="titletextarticle titlesarticle" ><?php the_title(); ?></h2>
						<?php if(function_exists('the_subtitle')){?>
							<h3 class="subtitletextarticle titlesarticle"><?php the_subtitle(); ?></h3>
						<?php } ?>
					</div>
				</div>
				<div class="categoryarticle">
					<p><?php the_category(', ');?></p>
				</div>
			</header>
		</section><!-- end of thumbnail -->
	<?php }else{ ?>
		<!-- title without thumbnail -->
		<section class="wrap wrap--content">
			<h2 class="title title--event"><?php the_title(); ?></h2>
			<?php if(function_exists('the_subtitle')){?>
				<h3 class="subtitle subtitle--event"><?php the_subtitle(); ?></h3>
			<?php } ?>
		</section><!-- end of title without thumbnail -->
	<?php } ?>

	<!-- relevant info -->
	<section class="wrap wrap--content">
		<?php if($EM_Event->event_start_date == $EM_Event->event_end_date){
			echo '<strong>Fecha:</strong> '.$event_start_date->format('j \d\e M \d\e Y').', de '.$event_start_date->format('H:i').' a '.$event_end_date->format('H:i');
		}else{
			echo '<strong>Inicio:</strong> '.$event_start_date->format('j \d\e M \d\e Y\, H:i\h').'<br><strong>Fin:</strong>   '.$event_end_date->format('j \d\e M \d\e Y\, H:i\h');
		}
		if($EM_Event->location->location_id > 0){
			echo '<br><strong>Localización:</strong> '.$EM_Event->location->location_name;
		} ?>
	</section><!-- end of relevant info -->

	<!-- description -->
	<section class="wrap wrap--content">
		<?php echo $EM_Event->output('#_EVENTNOTES');?>
	</section><!-- end of description -->

	<!-- localization -->
	<?php if($EM_Event->location_id > 0){?>
		<section class="wrap wrap--frame wrap--flex">
			<div class="wrap wrap--flexed wrap--flexed__middlecontent">
				<h3>Localización</h3>
				<p><strong><?php echo $EM_Event->output('#_LOCATIONNAME');?></strong><br>
				<?php echo $EM_Event->output('#_LOCATIONADDRESS').', '.$EM_Event->output('#_LOCATIONTOWN');?></p>
			</div>
			<div class="wrap wrap--flexed wrap--flexed__middleframe">
				<?php echo $EM_Event->output('#_LOCATIONMAP');?>
			</div>
		</section>
	<?php } ?><!-- end of localization -->

	<!-- booking -->
	<?php if(strtotime('now') < strtotime($EM_Event->event_end_date.' '.$EM_Event->event_end_time)){ // If event hasn't finished yet ?>
		<section class="wrap wrap--content">
			<h3>Registro</h3>
			<?php if($EM_Event->event_rsvp == 1){ // If registration is enabled ?>
					<?php echo $EM_Event->output('#_BOOKINGFORM');?>
					<?php echo $EM_Event->output('#_BOOKINGBUTTON');?>
			<?php }else echo '<p>Registro no disponible</p>'; ?>
		</section>
	<?php }else{ ?>
		<section class="wrap wrap--content">
			<p>Evento finalizado</p>
		</section>
	<?php } ?>	

  <section class="wrap wrap--frame">
  	<?php 
  	var_dump($EM_Event);
  	?>
  </section>
</div><!-- end of flexboxer -->

<?php get_footer(); ?>