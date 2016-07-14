</div><!-- end of wrapper -->

<!-- footer -->
<footer id="footer" class="wrap wrap--footer">
  <div class="flexboxer">
  
    <div class="wrap wrap--frame wrap--flex">
      <div class="wrap wrap--frame__middle">
        <ul>
          <li> &copy; <?php echo get_the_date('Y');?> <a href="<?php bloginfo('url'); ?>" target="_blank"><?php bloginfo('sitename'); ?></a></li>
        </ul>
            <!-- middlemenu -->
            <?php /* if (has_nav_menu('menufooter')) { ?>
              <?php wp_nav_menu( array( 'theme_location' => 'menufooter', 'container' => false ) ); ?>
            <?php } */ ?><!-- end of middlemenu -->
      </div>
      <div class="wrap wrap--frame__middle text--right">
        <ul>
          <li>
          <a href="https://www.facebook.com/aedisevilla/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/facebook.svg" alt="Facebook" class="icon icon--rrss"></a>
          <a href="https://twitter.com/AEDISevilla" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/twitter.svg" alt="Twitter" class="icon icon--rrss"></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer> <!-- end footer -->


  <!-- inject:js -->
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/jquery/dist/jquery.min.js"></script>
  <?php /* <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/jquery/dist/jquery.slim.min.js"></script> */?>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/chosen/chosen.jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/moment/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/pikaday/plugins/pikaday.jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/pikaday/pikaday.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/flickity/dist/flickity.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/github-ias/src/jquery-ias.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/github-imagefill/js/jquery-imagefill.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/jquery-plugin-printthis/lib/jquery.printThis.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/moment/min/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/medium-editor/dist/js/medium-editor.min.js"></script>

  
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/handlebars/handlebars.runtime.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/jquery-sortable/source/js/jquery-sortable-min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/jquery.ui.widget.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/jquery.iframe-transport.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/jquery.fileupload.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/medium-editor-insert-plugin/dist/js/medium-editor-insert-plugin.min.js"></script>
  <!-- endinject -->



<?php wp_footer(); ?>

<script>
jQuery(document).ready(function($) {

  if ($('.js-medium-editor').length > 0){
    var editor = new MediumEditor('.js-medium-editor',{
      placeholder: {
        text: 'Descripción'
      }
    });

    $('.js-medium-editor').mediumInsert({
        editor: editor
    });
  }
});
</script>
</body>
</html> <!-- The End. what a ride! -->