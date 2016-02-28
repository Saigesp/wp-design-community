<footer id="footerpage" class="footerback">
	<div id="colophon" class="wraparch wrapfoot">
    	<div class="divleft">
    		<p><?php bloginfo('sitename'); ?></p>
    	</div>
		<div class="divright">
			<p><a href="http://www.talkandcode.com/Terms">Aviso legal</a>
				<a href="https://www.facebook.com/talkandcode"><?php the_svg_icon('facebook');?></a>
				<a href="https://twitter.com/talkandcode"><?php the_svg_icon('twitter');?></a>
				<a href="https://www.linkedin.com/company/5321507"><?php the_svg_icon('linkedin');?></a>
			</p>
    	</div>
	</div>
</footer> <!-- end footer -->


</div><!-- end of wrapper -->
  <!-- inject:js -->
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/chosen/chosen.jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/wp-design-community/wpdc.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/flickity/dist/flickity.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/github-ias/src/jquery-ias.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/github-imagefill/js/jquery-imagefill.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/masonry-layout/dist/masonry.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/medium-editor/dist/js/medium-editor.min.js"></script>
  <!-- endinject -->
<?php wp_footer(); ?>
<script>
jQuery(document).ready(function($) {
  $('#widgets').css("width", $(document).width() - $('#controlmenu').outerWidth());
  $('.listinfo').css("width", $('.listitem').width() - $('.listimage').outerWidth() - 10 - 25);
  var editor = new MediumEditor('.js-medium-editor',{
    placeholder: {
      text: 'Descripción'
    }
  })
});
</script>

</body>

</html> <!-- The End. what a ride! -->