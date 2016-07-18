<?php get_header();

global $EM_Event;

/* Date */
$event_start_date = new DateTime($EM_Event->event_start_date.' '.$EM_Event->event_start_time);
$event_end_date = new DateTime($EM_Event->event_end_date.' '.$EM_Event->event_end_time);
$booking_end_date = new DateTime($EM_Event->event_rsvp_date.' '.$EM_Event->event_rsvp_time);
  $pageoptions = [];
  if(
  	get_user_meta(get_current_user_id(), 'asociation_responsability', true) == 'rp_events' ||
  	is_user_role('administrator') ||
  	is_user_role('editor')
  ){
  	$pageoptions["bookingmanager"] = "Gestionar reservas";
  }
?> 

	
<div class="flexboxer flexboxer--event article flexboxer--full">
	<?php if(has_post_thumbnail()){ ?>

		<!-- thumbnail -->
		<section class="wrap wrap--fullwidth">
			<header id="header-<?php the_ID(); ?>" class="header header--article">
				<figure id="thumbnail" class="thumb--article">
					<?php the_post_thumbnail('full');  ?>
				</figure>
			</header>
		</section><!-- end of thumbnail -->

	<?php } ?>

	<?php if(is_user_role('administrator') || is_user_role('editor')) { ?>

		<!-- admin options -->
		<?php wpdc_the_pageoptions($pageoptions);?>

	<!-- booking management -->
	<section id="bookingmanager" class="wrap wrap--content wrap--shadow wrap--hidden js-section">
	    <h3>Gestión de reservas</h3>
	    <?php include(locate_template('templates/loops/loop-booking.php')); ?>
	    <div class="wrap wrap--icon wrap--icon__close js-section-launch" onclick="ToggleSection(this)" data-section="close">
	    	<?php // the_svg_icon('close', 'icon--corner js-close-alert'); ?>
	    </div>
	    <div class="wrap wrap--icon wrap--icon__pdf" onclick="">
	    	<?php // the_svg_icon('pdf', 'icon--corner icon--corner__second'); ?>
	    </div>
	</section><!-- end of booking management -->

<?php } ?>


	<!-- relevant info -->
	<section class="wrap wrap--content wrap--shadow">
		<h2 class="title title--section" ><?php the_title(); ?></h2>
		<div class="wrap wrap--frame wrap--flex">
			<div class="wrap wrap--frame__middle">
				<?php if($EM_Event->event_start_date == $EM_Event->event_end_date){ // If event is the same day
					echo '<span class="breaklinetablet"><strong>Fecha:</strong> </span><span class="breaklinetablet">'.$event_start_date->format('j \d\e M \d\e Y').', de '.$event_start_date->format('H:i').' a '.$event_end_date->format('H:i').'</span>';
				}else{
					echo '<span class="breaklinetablet"><strong>Inicio:</strong> </span><span class="breaklinetablet">'.$event_start_date->format('j \d\e M \d\e Y\, H:i\h').'</span> <span class="breaklinetablet js-date-fromnow">'.$event_start_date->format('Y-m-d H:i:s').'</span><br><span class="breaklinetablet"><strong>Fin:</strong> </span><span class="breaklinetablet">'.$event_end_date->format('j \d\e M \d\e Y\, H:i\h').'</span> <span class="breaklinetablet js-date-fromnow">'.$event_end_date->format('Y-m-d H:i:s').'</span>';
				}
				if($EM_Event->location->location_id > 0){
					echo '<br><span class="breaklinetablet"><strong>Localización:</strong> </span><span class="breaklinetablet">'.$EM_Event->location->location_name.'</span>';
				}?>
			</div>
			<div class="wrap wrap--frame__middle">
				<?php
				if(strtotime('now') < strtotime($EM_Event->event_end_date.' '.$EM_Event->event_end_time)){ // If event hasn't finished yet
					if($EM_Event->output('#_SPACES') > 0){
						echo '<br class="hideontablet"><span class="breaklinetablet"><strong>Espacios disponibles:</strong> </span>'
						. '<span class="breaklinetablet">'
						.$EM_Event->output('#_AVAILABLESPACES')
						. ' / '
						.$EM_Event->output('#_SPACES')
						. '</span>';
					}
					if($EM_Event->output('#_PENDINGSPACES') > 0){
						echo '<br><span class="breaklinetablet"><strong>En trámite:</strong> </span>'
						. '<span class="breaklinetablet">'
						.$EM_Event->output('#_PENDINGSPACES')
						. '</span>';
					}
					if(strtotime('now') < strtotime($EM_Event->event_rsvp_date.' '.$EM_Event->event_rsvp_time) ){ // If limit booking date isn't past
						echo '<br><span class="breaklinetablet"><strong>Límite de reserva:</strong> </span>'
						. '<span class="breaklinetablet">'
						.$booking_end_date->format('j \d\e M \d\e Y\, H:i\h')
						. '</span>';
					}else{
						echo '<br><span class="breaklinetablet"><strong>Reservas cerradas</strong></span>';
					}
				}else{ //Event finished
					echo '<p><strong>Evento finalizado</strong></p>';
				}
					?>
			</div>
		</div>
	</section><!-- end of relevant info -->

	<!-- description -->
	<section class="wrap wrap--content wrap--shadow">
		<h3><?php the_title(); ?></h3>
		<div class="content">
			<?php echo $EM_Event->output('#_EVENTNOTES');?>
		</div>
	</section><!-- end of description -->

	<!-- localization -->
	<?php if($EM_Event->location_id > 0){?>
		<section class="wrap wrap--frame wrap--flex wrap--shadow">
			<div class="wrap wrap--content wrap--content__middle">
				<h3>Localización</h3>
				<p><strong><?php echo $EM_Event->output('#_LOCATIONNAME');?></strong><br>
				<?php echo $EM_Event->output('#_LOCATIONADDRESS').', '.$EM_Event->output('#_LOCATIONTOWN');?></p>
			</div>
			<div class="wrap wrap--frame wrap--frame__middle">
				<?php echo $EM_Event->output('#_LOCATIONMAP');?>
			</div>
		</section>
	<?php } ?><!-- end of localization -->

	<!-- booking -->
	<?php if(strtotime('now') < strtotime($EM_Event->event_end_date.' '.$EM_Event->event_end_time)){ // If event hasn't finished yet ?>

		<!-- active bookings form -->
		<section class="wrap wrap--content wrap--shadow">
			<?php if($EM_Event->event_rsvp == 1){ // If registration is enabled ?>
					<?php echo $EM_Event->output('#_BOOKINGFORM');?>
			<?php }else echo '<p>Registro no disponible</p>'; ?>
		</section><!-- end of active bookings -->

	<?php } ?><!-- end of bookings form -->

</div><!-- end of flexboxer -->

<?php get_footer(); ?>