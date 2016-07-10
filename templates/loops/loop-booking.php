<form action="" id="bookingmanager-form">

<div id="bookingmanager-form-list" class="wrap wrap--frame">

	<?php if(sizeof($EM_Event->bookings->bookings) > 0){ ?>

	<div class="wrap wrap--flex do_not_print">
		<div class="wrap wrap--frame wrap--frame__decim">
			<strong>Nombre</strong>
		</div>
		<div class="wrap wrap--frame wrap--frame__decim">
			<strong>Plazas</strong>
		</div>
		<div class="wrap wrap--frame wrap--frame__decim">
			<strong>Total €</strong>
		</div>
		<div class="wrap wrap--frame wrap--frame__decim">
			<strong>Estado</strong>
		</div>

	</div>

	<div class="wrap wrap--flex hide">
		<h2 class="title title--event">Reservas de <?php the_title(); ?></h2>
	</div>
	
	<?php
	$cont = 0;
	foreach ($EM_Event->bookings->bookings as $booking) {
		//if($cont > 2) break;
		$cont++;
		$booking_id 			= $booking->booking_id;
		$event_id 				= $booking->event_id;
		$person_id 				= $booking->person_id;
		$booking_price 			= $booking->booking_price;
		$booking_spaces 		= $booking->booking_spaces;
		$booking_status 		= $booking->booking_status;
		$person_phone 			= $booking->person->data->phone;
		$person_email 			= $booking->person->data->user_email;
		$booking_date 			= date('j/m/Y H:i',$booking->tickets_bookings->booking->timestamp);

		//var_dump($booking->tickets_bookings->booking->timestamp);

	?>
		<div class="wrap wrap--flex">

			<?php $valide = $_GET['valide'] == 'ok' ? true : false; ?>

			<div class="wrap wrap--frame wrap--frame__decim">
				<span class="hide"><strong>Nombre: </strong></span>

				<?php echo get_user_meta($person_id,'first_name', 1).' '.get_user_meta($person_id,'last_name', 1);
					//$booking->set_status($_REQUEST['booking_status'], false, true);
				?>
			</div>

			<div class="wrap wrap--frame wrap--frame__decim hide">
				<span class="hide"><strong>Teléfono: </strong></span>
				<?php echo $person_phone; ?>
				<span class="hide"><strong> Email: </strong></span>
				<?php echo $person_email; ?>
			</div>

			<div class="wrap wrap--frame wrap--frame__decim">
				<span class="hide"><strong>Fecha de registro: </strong></span>
				<span class="hide"><?php echo $booking_date; ?></span>
				<span class="hide"><strong>Espacios: </strong></span>
				<?php echo $booking_spaces; ?>
			</div>

			<div class="wrap wrap--frame wrap--frame__decim do_not_print">
				<span class="hide"><strong>Ingreso: </strong></span>
				<?php echo round($booking_price, 2).' €'; ?>
			</div>

			<div class="hide">
				<span class="hide"><strong>Estado: </strong></span>
				<?php if($booking_status == 0 ) { 
						echo 'Pendiente de aceptación';
					} elseif($booking_status == 1 ) { 
						echo 'Aprobado';
					} elseif($booking_status == 2 ) {
						echo 'Rechazado';
					} elseif($booking_status == 3 ) {
						echo 'Cancelado';
					} elseif($booking_status == 4 ) {
						echo 'Falta pago online';
					} elseif($booking_status == 5 ) {
						echo 'Falta ingreso';
					}?>
			</div>

			<div class="wrap wrap--frame wrap--frame__decim do_not_print wrap--frame__status">
				<select name="booking_status" class="booking_status--<?php echo $booking_status;?>">
					<?php foreach($booking->status_array as $status => $status_name): ?>
						<option value="<?php echo esc_attr($status); ?>" <?php if($status == $booking_status){ echo 'selected="selected"'; } ?>><?php echo $status_name; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="hide">
				<br>
			</div>
		
		</div>


	<?php } ?>	

	<?php }else{ ?>
		<p>No hay reservas.</p>
	<?php } ?>

</div>

	<div class="wrap wrap--flex wrap--submit">
		<p class="submit">
		<input type="submit" class="button button-primary hide" value="Guardar cambios">
		</p>
	</div>

</form>
