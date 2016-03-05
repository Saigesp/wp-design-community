<div class="wrap wrap--frame">
	<div class="wrap wrap--flex">
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
	

	<?php foreach ($EM_Event->bookings->bookings as $booking) {
		$booking_id 			= $booking->booking_id;
		$event_id 				= $booking->event_id;
		$person_id 				= $booking->person_id;
		$booking_price 			= $booking->booking_price;
		$booking_spaces 		= $booking->booking_spaces;
		$booking_status 		= $booking->booking_status;
		$booking_time 			= $booking->timestamp;
	?>
		<div class="wrap wrap--flex">

			<?php $valide = $_GET['valide'] == 'ok' ? true : false; ?>


			<div class="wrap wrap--frame wrap--frame__decim">
				<?php echo get_user_meta($person_id,'first_name', 1).' '.get_user_meta($person_id,'last_name', 1);
					//$booking->set_status($_REQUEST['booking_status'], false, true);
				?>
			</div>
			<div class="wrap wrap--frame wrap--frame__decim">
				<?php echo $booking_spaces; ?>
			</div>

			<div class="wrap wrap--frame wrap--frame__decim">
				<?php echo round($booking_price, 2).' €'; ?>
			</div>
			<div class="wrap wrap--frame wrap--frame__decim">
				<?php if(false){ ?>
				<select name="booking_status">
					<?php foreach($booking->status_array as $status => $status_name): ?>
						<option value="<?php echo esc_attr($status); ?>" <?php if($status == $EM_Booking->booking_status){ echo 'selected="selected"'; } ?>><?php echo esc_html($status_name); ?></option>
					<?php endforeach; ?>
				</select>
				<?php } else {
					if($booking_status == 0 ) { 
						echo '<span class="aprobed">Pendiente de aceptación</span>';
					} elseif($booking_status == 1 ) { 
						echo '<span class="aprobed">Aprobado</span>';
					} elseif($booking_status == 2 ) {
						echo '<span class="pending">Rechazado</span>';
					} elseif($booking_status == 3 ) {
						echo '<span class="pending">Cancelado</span>';
					} elseif($booking_status == 4 ) {
						echo '<span class="pending">Falta pago online</span>';
					} elseif($booking_status == 5 ) {
						echo '<span class="pending">Falta ingreso</span>';
					} else {
						echo '<span class="nisu">'.$booking_status.'</span>'; 
					}
				} ?>
			</div>
		
		</div>


<?php //var_dump($booking);?>


	<?php } ?>





</div>
