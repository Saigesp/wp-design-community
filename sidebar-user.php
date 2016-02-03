<?php
$image = get_the_author_meta('foto_personal', $current_user->ID );
?>

<div id="usersidebar" style="width: 210px;display: inline-block;vertical-align: top;padding: 10px;background: #666; height:100%;">

<div class="sidebar-block">
  	<div class="profile-mini-foto" style="float:left;">
        <?php echo wp_get_attachment_image( $image,array(26, 26) );?>
    </div>
		<p class="username-mini" style="float: left;margin-top: 11px;">
				<?php echo get_the_author_meta('first_name',$current_user->ID ).' '.get_the_author_meta('last_name',$current_user->ID ); ?>
		</p>
</div>

<div class="sidebar-block">
  <p class="sidebar">
  Últimos artículos
  </p>
</div>

<div class="sidebar-block">
  <p class="sidebar">
  Últimos usuarios
  </p>
</div>

<div class="sidebar-block">
  <p class="sidebar">
  Crear artículo
  </p>
</div>

</div>