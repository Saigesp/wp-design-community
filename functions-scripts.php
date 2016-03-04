<?php 


add_action( 'wp_head', 'inject_in_all' );


// Create pages to extend theme
new_page_title('Edit Event');

/**
 * ALL PAGES
 ***********************************/
function inject_in_all() { ?>
  <script>

    function ToggleMenu(args){
      if(!jQuery('#'+args).hasClass('active')){
        jQuery('.js-menu').removeClass("active");
        jQuery('#'+args).addClass("active");
      }else{
        jQuery('.js-menu').removeClass("active");
      }
    }

    jQuery(document).ready(function($) {

      imageresize($);

      if ($(".js-imagefill").length > 0){
        var imgLoad = imagesLoaded('.js-imagefill img');
        imgLoad.on( 'always', function( instance ) {
          $('.js-imagefill').imagefill();
        });
      }

      $(".js-showonload").removeClass("js-showonload-active");

      $("#close").on("click", function(){
        $(".alert").removeClass('alert--error').addClass('hide');
        //$("")
      })

    <?php if (is_page('control-users')) { ?>
        $('#user-labels').chosen();
    <?php } ?>
    <?php if ('event' == get_post_type()) { ?>
        if ($(".em-ticket").length > 1) {
          $("<h3>Datos de contacto</h3>").insertBefore(".em-booking-form-details");
        }
        if ($(".em-booking-login").length) {
          $('<h3 style="margin-top:20px;">Datos de contacto</h3>').insertBefore(".em-tickets-spaces + .input-user-field");
        }
        if ($(".em-booking-form").length) {
          $(".em-booking-form").prepend("<h3>Registro</h3>");
        }
        if ($(".em-booking-login-form").length) {
          $('<h3>Inicia sesión</h3>').insertBefore(".em-booking-login-form");
        }
    <?php } ?>
    <?php if (is_page('edit-event')) { ?>
        if ($("#em-location-data i").length) $("#em-location-data i").prev().attr("placeholder", "Obligatorio");
        if ($("#event-form > .wrap").length)  $("#event-form > .wrap").addClass("flexboxer flexboxer--event flexboxer--event__edit").removeClass("wrap");

        // Hide thumbnail && extra info && add classes
        $('.inside').each(function(){
            var elemClass = $(this).attr('class').split(/\s+/);
            elemClass = 'wrap--'+elemClass[1]
            $(this).prev('h3').andSelf().wrapAll('<div class="wrap wrap--content hide '+elemClass+'"/>');
        });
        $(".wrap--event-form-image").addClass("wrap--frame").removeClass("wrap--content hide");
        $('.flexboxer--event__edit + p.submit').addClass('hide').children('input').attr("value", "Presentar evento");

        // Add default image && resize
        $(".wrap--event-form-image")
        .prepend('<div class="overflow overflow--black__hover js-thumbnail-upload"></div><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/noimage600x600.png"><div class="title title--article"><div class="divtextarticle"><h2 class="titletextarticle titlesarticle"></h2></div></div>')
        .imagefill()
        .children('img').animate({ opacity: 1}, 3000);

        // Trigger upload thumbnail
        $(".js-thumbnail-upload").click(function() {
            $("#event-image").trigger('click');
        });
        $("#event-image").change(function(){
          $('.wrap--event-form-image').css("opacity", 0);
          var $input = $(this);
          var inputFiles = this.files;
          if (inputFiles == undefined || inputFiles.length == 0) return;
          var inputFile = inputFiles[0];
          var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
          var extension = inputFile.name.split('.').pop().toLowerCase();
          var isSuccess = fileTypes.indexOf(extension) > -1;
          if (isSuccess) {
              var reader = new FileReader();
              reader.onload = function(event) {
                  $('.wrap--event-form-image img').attr("src", event.target.result);
                  $('.wrap--event-form-image')
                    .imagefill()
                    .animate({ opacity: 1}, 3000);

                  $('.wrap--event-form-name').removeClass('hide');
              };
              reader.readAsDataURL(inputFile);

          } else {
              alert('Formatos permitidos: jpg, gif, png');
              $('.wrap--event-form-name').addClass('hide');
          }
          reader.onerror = function(event) {
              alert("ERROR: " + event.target.error.code);
          };
        });

        // Update title in thumbnail
        $('.event-form-name input').on('keyup', function() {
          var text = $('.event-form-name input').val();
          if(text != '' && text.length > 0) {
            $('.wrap--event-form-when').removeClass('hide');
            $('.wrap--event-form-image .overflow').addClass('overflow--black');
          } 
          $('.titletextarticle').text(text);
        });

        /* Habilite form details */
        $('.event-form-when .em-date-end').change(function() {
          $('.wrap--event-form-details').removeClass('hide');
        });
        $('.event-form-when .em-date-end').change(function() {
          $('.wrap--event-form-details').removeClass('hide');
        });

        // Create medium editor
        var editor = new MediumEditor('#em-editor-content', {
            placeholder: {
                text: 'Información del evento',
                hideOnClick: true
            }
        });
        editor.subscribe('editableInput', function (event, editable) {
          var text = $('#em-editor-content').val();
          if(text != '' && text.length > 15) {
            $('.wrap--event-form-where').removeClass('hide');
          } 
        });

        /* Location && submit */
        $('#location-name').change(function() {
          $('.wrap--event-form-bookings').removeClass('hide');
          $('p.submit').removeClass('hide');
        });

        $(".event-categories select").chosen();
        $('#location-country').chosen(); 

    <?php } ?>
    });
  </script>
<?php } ?>