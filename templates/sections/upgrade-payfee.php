<section class="wrap wrap--content wrap--shadow wrap--form">
	<form method="post" action="">
		<div class="wrap wrap--frame">
			<?php
			if(get_option("text_asociate_payfee") != ''){
				echo html_entity_decode(get_option("text_asociate_payfee"));
			}else{
				echo 'Ya estás asociado!';
			}

			?>
		</div>
	</form>
</section>