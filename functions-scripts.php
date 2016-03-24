<?php 

add_action( 'wp_head', 'inject_in_all' );

function inject_in_all() { ?>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script>

    function ToggleMenu(args){
      if(jQuery('#'+args).hasClass('active') || args == 'close'){
        jQuery('.js-menu').removeClass("active");
        jQuery('#overlaybody').removeClass("active");
      }else{
        jQuery('.js-menu').removeClass("active");
        jQuery('#overlaybody').addClass("active");
        jQuery('#'+args).addClass("active");
      }
    }

    function ToggleSection(args){
      if(jQuery('#'+args).hasClass('active') || args == 'close'){
        jQuery('.js-section').removeClass("active");
      }else{
        jQuery('.js-section').removeClass("active");
        jQuery('#'+args).addClass("active");
      }
    }

    function ToggleSelect(select_id){
      var section = jQuery('#'+select_id+' option:selected').val();
      console.log(section);
      if(jQuery('#js-select-'+section).hasClass('active') || select_id == 'close'){
        jQuery('.js-select').removeClass("active");
      }else{
        jQuery('.js-select').removeClass("active");
        jQuery('#js-select-'+section).addClass("active");
      }
    }

    function imageresize() {
        if (jQuery('.js-fullheight').length > 0) jQuery('.js-fullheight').css("height", jQuery(window).height() - jQuery('#headertop').outerHeight());
        if (jQuery('.js-fullheight-thumb').length > 0) jQuery('.js-fullheight-thumb').imagefill();
    }


    /**
     * ALL PAGES
     ***********************************/


    jQuery(document).ready(function($) {

      imageresize();

      if ($(".js-imagefill").length > 0){
        var imgLoad = imagesLoaded('.js-imagefill img');
        imgLoad.on( 'always', function( instance ) {
          $('.js-imagefill').imagefill();
        });
      }

      $(".js-showonload").removeClass("js-showonload-active");

      $("#close").on("click", function(){
        $(".alert").removeClass('alert--error').addClass('hide');
      });

      if ($(".chosen").length > 0){
        $('.chosen').chosen();
      }

      $('#wrapper form').submit(function(event){
        var errors = [];
        $('#wrapper form input').each(function(){
          if($(this).prop('required') && $(this).val() == ''){ //|| $(this).attr('type') != 'hidden'
              errors.push('Campo requerido: ' + $(this).attr('placeholder'));
          }
        });
        if(errors.length > 0) {
          //$('#alerts').html('');
          for (i = 0; i < errors.length; i++){
            $('#alerts').append(
              '<div class="alert alert--error">'+
                '<p>'+errors[i]+'</p>'+
              '</div>');
          }
          return false;
        }else{
          return true;
        }
        
      });

    <?php if (is_home()) { ?>
     /**
     * HOME
     ***********************************/

       $(window).on('load',function() {

        var $carousel = $('#mainslider').flickity({
          wrapAround: true,
          freeScroll: true,
          contain: true
        });

        // Flickity instance
        var flkty = $carousel.data('flickity');
        // elements
        var $cellButtonGroup = $('.button-group--cells');
        var $cellButtons = $cellButtonGroup.find('.button');

        // update selected cellButtons
        $carousel.on( 'cellSelect', function() {
          $cellButtons.filter('.is-selected')
            .removeClass('is-selected');
          $cellButtons.eq( flkty.selectedIndex )
            .addClass('is-selected');
        });

        // select cell on button click
        $cellButtonGroup.on( 'click', '.button', function() {
          var index = $(this).index();
          $carousel.flickity( 'select', index );
        });

        $carousel.flickity('resize');

      });


    <?php } ?>

    
    <?php if ('event' == get_post_type()) { ?>
    /**
     * SIGLE EVENT
     ***********************************/

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

        <?php if(true){ ?>

          if ($("#bookingmanager-form select").length > 0) {
            $("#bookingmanager-form select").change(function() {
              $(this).attr("class", "").addClass("booking_status--"+this.value);
              $("#bookingmanager-form .button-primary").removeClass('hide');
            });
          }


          if ($("#pdf_icon").length > 0) {
            $("#pdf_icon").on("click", function(){
              $('#bookingmanager-form-list').printThis({
                title: 'Lista de reservas de <?php the_title(); ?>, <?php bloginfo("name"); ?>, @<?php echo get_userdata(get_current_user_id())->user_login;?>',
                exclude: ['.do_not_print', '.print_exclude' ],
                styles: ['http://www.saigesp.es/wp-content/themes/gridly/style.css']
              });
            })
          }

        <?php } ?>




    /**
     * SIGLE FEE
     ***********************************/
    <?php } elseif ('fee' == get_post_type()) { ?>


    /**
     * PAGE CONTROL USERS
     ***********************************/
    <?php } ?>
    <?php if (is_archive('fee')) { ?>


    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'YYYY-MM-DD h:mm:ss',
        onSelect: function() {
        }
    });









    /**
     * PAGE CONFIGURATION
     ***********************************/
    <?php } else if (is_page('configuration')) { ?>

        $('#automatic-twitter').change(function() {
            if($(this).is(":checked")) {
              //var returnVal = confirm("Are you sure?");
              //$(this).attr("checked", returnVal);
              $('.wrap--twitteroptions').removeClass('hide');
            }else{
              $('.wrap--twitteroptions').addClass('hide');
            }
        });


    /**
     * PAGE EDIT EVENT
     ***********************************/
    <?php } else if (is_page('edit-event')) { ?>


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