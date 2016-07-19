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
          <?php if(get_option('asoc_facebook') != ''){?>
            <a href="<?php echo get_option('asoc_facebook');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/facebook.svg" alt="Facebook" class="icon icon--rrss"></a>
          <?php } ?>
          <?php if(get_option('asoc_twitter') != ''){?>
            <a href="<?php echo get_option('asoc_twitter');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/twitter.svg" alt="Twitter" class="icon icon--rrss"></a>
          <?php } ?>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer> <!-- end footer -->

  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/chosen/chosen.jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/flickity/dist/flickity.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/github-imagefill/js/jquery-imagefill.min.js"></script>
  
<?php if(!is_page('edit-event')){ ?> 
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/jquery/dist/jquery.slim.min.js"></script>
<?php } ?>

  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/jquery-plugin-printthis/lib/jquery.printThis.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/moment/min/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/medium-editor/dist/js/medium-editor.min.js"></script>

<?php if(is_archive()){ ?> 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/github-ias/src/jquery-ias.min.js"></script>
  <script> 
jQuery(document).ready(function($) {
  var ias = $.ias({
    container: "#ias",
    item: ".ias-item",
    pagination: ".navigation",
   next: "a.next",
  });

  ias.on('render', function(items) { $(items).css({ opacity: 0 });});

  ias.on('rendered', function(items) {
    $(items).css({ opacity: 1 });
  });

  ias.extension(new IASSpinnerExtension({
      src: 'http://xn--diseadoresindustriales-nec.es/wp-content/themes/disindu/img/ajax-loader.gif', // optionally
  }));
  ias.extension(new IASTriggerExtension({
      text: 'Ver más',
      offset: 5,
  }));
  ias.extension(new IASNoneLeftExtension({
    text: "No hay más resultados",
  })); 
}); 
  </script>
<?php } ?>

  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/pikaday/pikaday.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/pikaday/plugins/pikaday.jquery.min.js"></script>
<script>
jQuery(document).ready(function($) {

  if ($('.js-medium-editor').length > 0){
    var editor = new MediumEditor('.js-medium-editor',{
      placeholder: {
        text: '...'
      }
    });
  }

  if ($('.js-pikaday').length > 0){
    var $datepicker = $('.js-pikaday').pikaday({
        format: 'YYYY-MM-DD h:mm:ss',
        minDate: new Date(2016, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [2016,2020],
        onSelect: function() {
        },          
    });
  }

});
</script>

<?php wp_footer(); ?>
</body>
</html> <!-- The End. what a ride! -->