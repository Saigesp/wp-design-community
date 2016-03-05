<?php get_header();

global $EM_Event;

/* Date */
$event_start_date = new DateTime($EM_Event->event_start_date.' '.$EM_Event->event_start_time);
$event_end_date = new DateTime($EM_Event->event_end_date.' '.$EM_Event->event_end_time);
/* Booking */

?> 

<div class="flexboxer flexboxer--event article <?php if(!has_post_thumbnail()) echo 'article--nothumb'; ?>">
	<!-- thumbnail -->
	<?php if(has_post_thumbnail()){ ?>
		<section class="wrap wrap--frame ">
			<header id="header-<?php the_ID(); ?>" class="header header--article">
				<?php  if ( has_post_thumbnail() ) { ?>
					<figure id="thumbnail" class="thumb--article js-fullheight js-fullheight-thumb">
						<?php the_post_thumbnail('full');  ?>
					</figure>
					<div class="overflow overflow--black"></div>
					<div id="title-<?php the_ID(); ?>" class="wrap wrap--title wrap--title__article">
						<div class="wrap wrap--position">
							<h2 class="title title--article" ><?php the_title(); ?></h2>
							<?php if(function_exists('the_subtitle')){?>
								<h3 class="title title--article__sub"><?php the_subtitle(); ?></h3>
							<?php } ?>
						</div>
					</div>
				<?php }else{  ?>
					<h2 class="title title--article" ><?php the_title(); ?></h2>
					<?php if(function_exists('the_subtitle')){?>
						<h3 class="title title--article__sub"><?php the_subtitle(); ?></h3>
					<?php } ?>
				<?php } ?>
				<div class="categoryarticle">
					<p><?php the_category(', ');?></p>
				</div>
			</header>
		</section>
	<?php }else{ ?><!-- end of thumbnail -->
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
		<h3>Detalles</h3>
		<div class="wrap wrap--frame wrap--flex">
			<div class="wrap wrap--frame__middle">
				<?php if($EM_Event->event_start_date == $EM_Event->event_end_date){
					echo '<span class="breaklinetablet"><strong>Fecha:</strong> </span><span class="breaklinetablet">'.$event_start_date->format('j \d\e M \d\e Y').', de '.$event_start_date->format('H:i').' a '.$event_end_date->format('H:i').'</span>';
				}else{
					echo '<span class="breaklinetablet"><strong>Inicio:</strong> </span><span class="breaklinetablet">'.$event_start_date->format('j \d\e M \d\e Y\, H:i\h').'</span><br><span class="breaklinetablet"><strong>Fin:</strong> </span><span class="breaklinetablet">'.$event_end_date->format('j \d\e M \d\e Y\, H:i\h').'</span>';
				}
				if($EM_Event->location->location_id > 0){
					echo '<br><span class="breaklinetablet"><strong>Localización:</strong> </span><span class="breaklinetablet">'.$EM_Event->location->location_name.'</span>';
				}?>
			</div>
			<div class="wrap wrap--frame__middle">
				<?php
				if(strtotime('now') < strtotime($EM_Event->event_end_date.' '.$EM_Event->event_end_time)){ // If event hasn't finished yet
					if($EM_Event->output('#_SPACES') > 0){
						echo '<br class="hideonmobile"><span class="breaklinetablet"><strong>Espacios disponibles:</strong> </span>'
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
				}else{ //Event finished
					echo '<p><strong>Evento finalizado</strong></p>';
				}
					?>
			</div>
		</div>
	</section><!-- end of relevant info -->

	<!-- admin info -->
	<?php if(is_user_role('administrator') || is_user_role('editor')) { ?>
	<section class="wrap wrap--content">
		<h3>Gestionar reservas</h3>
		<?php include(locate_template('loop-booking.php')); ?>
	</section>
	<?php } ?><!-- end of admin info -->


	<!-- description -->
	<section class="wrap wrap--content">
		<h3><?php the_title(); ?></h3>
		<?php echo $EM_Event->output('#_EVENTNOTES');?>
	</section><!-- end of description -->

	<!-- localization -->
	<?php if($EM_Event->location_id > 0){?>
		<section class="wrap wrap--frame wrap--flex">
			<div class="wrap wrap--content__middle">
				<h3>Localización</h3>
				<p><strong><?php echo $EM_Event->output('#_LOCATIONNAME');?></strong><br>
				<?php echo $EM_Event->output('#_LOCATIONADDRESS').', '.$EM_Event->output('#_LOCATIONTOWN');?></p>
			</div>
			<div class="wrap wrap--frame__middle">
				<?php echo $EM_Event->output('#_LOCATIONMAP');?>
			</div>
		</section>
	<?php } ?><!-- end of localization -->

	<!-- booking -->
	<?php if(strtotime('now') < strtotime($EM_Event->event_end_date.' '.$EM_Event->event_end_time)){ // If event hasn't finished yet ?>
		<section class="wrap wrap--content">
			<?php if($EM_Event->event_rsvp == 1){ // If registration is enabled ?>
					<?php echo $EM_Event->output('#_BOOKINGFORM');?>
			<?php }else echo '<p>Registro no disponible</p>'; ?>
		</section>
	<?php }else{ ?>
		<section class="wrap wrap--content">
			<p>Evento finalizado</p>
		</section>
	<?php } ?>	

</div><!-- end of flexboxer -->

<?php get_footer(); ?>