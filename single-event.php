<?php get_header();

global $EM_Event;

/* Date */
$event_start_date = new DateTime($EM_Event->event_start_date.' '.$EM_Event->event_start_time);
$event_end_date = new DateTime($EM_Event->event_end_date.' '.$EM_Event->event_end_time);
$booking_end_date = new DateTime($EM_Event->event_rsvp_date.' '.$EM_Event->event_rsvp_time);

?> 

<div class="flexboxer flexboxer--event article <?php if(!has_post_thumbnail()) echo 'article--nothumb'; ?>">
	
	<?php if(has_post_thumbnail()){ ?>

		<!-- thumbnail -->
		<section class="wrap wrap--frame ">
			<header id="header-<?php the_ID(); ?>" class="header header--article">
				<figure id="thumbnail" class="thumb--article js-fullheight js-fullheight-thumb">
					<?php the_post_thumbnail('full');  ?>
				</figure>
				<div class="overflow overflow--black untouchable"></div>
				<div id="title-<?php the_ID(); ?>" class="wrap wrap--title wrap--title__article">
					<div class="wrap wrap--position">
						<h2 class="title title--article" ><?php the_title(); ?></h2>
						<?php if(function_exists('the_subtitle')){?>
							<h3 class="title title--article__sub"><?php the_subtitle(); ?></h3>
						<?php } ?>
					</div>
				</div>
				<div class="wrap wrap--category">
					<p><?php the_category(', ');?></p>
				</div>
			</header>
		</section><!-- end of thumbnail -->

	<?php } else{ ?>

		<!-- title without thumbnail -->
		<section class="wrap wrap--content">
			<h2 class="title title--event"><?php the_title(); ?></h2>
			<?php if(function_exists('the_subtitle')){?>
				<h3 class="subtitle subtitle--event"><?php the_subtitle(); ?></h3>
			<?php } ?>
		</section><!-- end of title without thumbnail -->

	<?php } ?>

	<?php if(is_user_role('administrator') || is_user_role('editor')) { ?>

		<!-- admin options -->
		<section class="wrap wrap--content wrap--content__toframe wrap--flex wrap--transparent">
			<div class="wrap wrap--frame wrap--frame__middle">
				<?php if($EM_Event->event_private == 1) echo '<p>Evento privado</p>';?>
				<?php
				echo '<p>Estado: ';
				if(get_post_status() == 'publish'){
					echo 'Publicado';
				}elseif(get_post_status() == 'pending'){
					echo 'Pendiente de revisión';
				}elseif(get_post_status() == 'draft'){
					echo 'Borrador';
				}elseif(get_post_status() == 'future'){
					echo 'Programado';
				}elseif(get_post_status() == 'trash'){
					echo 'Borrado (papelera)';
				}
				echo '</p>';
				?>
				<p>Autor: <?php echo get_the_author_meta( 'first_name', $EM_Event->event_owner ).' '.get_the_author_meta( 'last_name', $EM_Event->event_owner );?></p>
				<p>Fecha de publicación: <?php echo get_the_date('j \d\e M \d\e Y\, H:i\h'); ?></p>
			</div>
			<div class="wrap wrap--frame wrap--frame__middle">
				<p class="right"><a href="<?php echo get_bloginfo('url');?>/edit-event/?id=<?php the_ID(); ?>">Editar evento</a></p>
				<p class="right">
					<?php
					if(get_post_status() == 'publish'){
						echo '<strong><a href="" class="color-error">Despublicar</a></strong>';
					}elseif(get_post_status() == 'pending' || get_post_status() == 'draft'){
						echo '<strong><a href="" class="color-success">Publicar</a></strong>';
					}elseif(get_post_status() == 'future'){
						echo '<strong><a href="">Reprogramar</a></strong>';
					}elseif(get_post_status() == 'trash'){
						echo '<strong><a href="">Restaurar</a></strong>';
					}
					?>
				</p>
				<p class="right"><a onclick="ToggleSection('bookingmanager')">Gestionar reservas</a></p>
			</div>
		</section><!-- end of admin options -->

	<?php } ?>
	<?php if(is_user_role('administrator') || is_user_role('editor')) { ?>

	<!-- booking management -->
	<section id="bookingmanager" class="wrap wrap--content wrap--hidden js-section">
	    <h3>Gestión de reservas</h3>
	    <?php include(locate_template('loop-booking.php')); ?>
	    <div class="wrap wrap--icon wrap--icon__close" onclick="ToggleSection('close')">
	    	<?php the_svg_icon('close', 'js-close-alert'); ?>
	    </div>
	    <div class="wrap wrap--icon wrap--icon__pdf" onclick="">
	    	<?php the_svg_icon('pdf'); ?>
	    </div>
	</section><!-- end of booking management -->

<?php } ?>


	<!-- relevant info -->
	<section class="wrap wrap--content">
		<h3>Detalles</h3>
		<div class="wrap wrap--frame wrap--flex">
			<div class="wrap wrap--frame__middle">
				<?php if($EM_Event->event_start_date == $EM_Event->event_end_date){ // If event is the same day
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

		<!-- active bookings form -->
		<section class="wrap wrap--content">
			<?php if($EM_Event->event_rsvp == 1){ // If registration is enabled ?>
					<?php echo $EM_Event->output('#_BOOKINGFORM');?>
			<?php }else echo '<p>Registro no disponible</p>'; ?>
		</section><!-- end of active bookings -->

	<?php }else{ ?>

		<!-- event finished -->
		<section class="wrap wrap--content">
			<p>Evento finalizado</p>
		</section><!-- end of event finished -->

	<?php } ?><!-- end of bookings form -->

</div><!-- end of flexboxer -->

<?php get_footer(); ?>