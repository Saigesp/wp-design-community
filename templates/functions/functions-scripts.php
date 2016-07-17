<?php 

add_action( 'wp_head', 'inject_in_all' );

function inject_in_all() { ?>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script>

    function ToggleMenu(args){
      if(jQuery('#'+args).hasClass('active') || args == 'close'){
        jQuery('.js-menu').removeClass("active");
        //jQuery('#overlaybody').removeClass("active");
      }else{
        jQuery('.js-menu').removeClass("active");
        //jQuery('#overlaybody').addClass("active");
        jQuery('#'+args).addClass("active");
      }
    }

    function ToggleSection(elem){
      var elem = jQuery(elem)[0];
      var section = jQuery(elem).data('section');

      if(jQuery(elem).hasClass('active') || section == 'close'){
        jQuery(elem).removeClass('active');
        jQuery('.js-section').removeClass("active");
        jQuery('.js-section-launch').removeClass("active");
      }else{
        jQuery('.js-section').removeClass("active");
        jQuery('.js-section-launch').removeClass("active");
        jQuery('.js-section-'+section).addClass("active");
        jQuery('#'+section).addClass("active");
        jQuery(elem).addClass('active');
      } 
    }

    function ToggleSelect(select_id){
      var section = jQuery('#'+select_id+'-input option:selected').val();
      if(jQuery('#js-select-'+section).hasClass('active') || select_id == 'close'){
        jQuery('.js-select-'+select_id).removeClass("active");
      }else{
        jQuery('.js-select-'+select_id).removeClass("active");
        jQuery('#js-select-'+section).addClass("active");
      }
    }

    function imageresize() {
        if (jQuery('.js-fullheight').length > 0) jQuery('.js-fullheight').css("height", jQuery(window).height() - jQuery('#headertop').outerHeight());
        if (jQuery('.js-fullheight-thumb').length > 0) jQuery('.js-fullheight-thumb').imagefill();
    }

    function beautydate() {
      if (jQuery(".js-date").length > 0){
        jQuery('.js-date').each(function(i){
          var element = jQuery(this);
          var date = element.text();
          date = moment(date, "YYYY-MM-DD HH:mm:ss").format("D MMMM YYYY");
          element.text(date);
          element.removeClass('js-date')
        })
      }

      if (jQuery(".js-date-fromnow").length > 0){
        jQuery('.js-date-fromnow').each(function(i){
          var element = jQuery(this);
          var date = element.text();
          date = moment(date, "YYYY-MM-DD HH:mm:ss").fromNow();
          element.text(date);
        })
      }
    }


    /**
     * ALL PAGES
     ***********************************/




    jQuery(document).ready(function($) {


      imageresize();

      $('.wrap--alert').each(function(){
          if( $(this).data('auto-close') == true ){
              $(this).slideDown().delay( $(this).data('delay') * 1000 ).fadeOut();
          } else {
              $(this).slideDown();
          }
      });
      $('.wrap--alert .icon--close').on('click', function(e){
            e.preventDefault();
            $(this).parents('.wrap--alert').addClass('invisible');
      });

      if ($(".js-imagefill").length > 0){
        var imgLoad = imagesLoaded('.js-imagefill img');
        imgLoad.on( 'always', function( instance ) {
          $('.js-imagefill').imagefill();
        });
      }

      $(".js-showonload").removeClass("js-showonload-active");

      if ( $(".chosen").length > 0){
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

      moment.locale('es', {
          months : "enero_febrero_marzo_abril_mayo_junio_julio_agosto_septiembre_octubre_noviembre_diciembre".split("_"),
          monthsShort : "ene._feb._mar._abr._may._jun._jul._ago._sep._oct._nov._dic.".split("_"),
          weekdays : "domingo_lunes_martes_miércoles_jueves_viernes_sábado".split("_"),
          weekdaysShort : "dom._lun._mar._mie._jue._vie._sab.".split("_"),
          weekdaysMin : "Do_Lu_Ma_Mi_Ju_Vi_Sa".split("_"),
          longDateFormat : {
              LT : "HH:mm",
              LTS : "HH:mm:ss",
              L : "DD/MM/YYYY",
              LL : "D MMMM YYYY",
              LLL : "D MMMM YYYY LT",
              LLLL : "dddd D MMMM YYYY LT"
          },
          calendar : {
              sameDay: "[Hoy a las] LT",
              nextDay: '[Mañana a las] LT',
              nextWeek: 'dddd [a las] LT',
              lastDay: '[Ayer a las] LT',
              lastWeek: 'dddd [a las] LT',
              sameElse: 'L'
          },
          relativeTime : {
              future : "Dentro de %s",
              past : "Hace %s",
              s : "segundos",
              m : "un minuto",
              mm : "%d minutos",
              h : "una hora",
              hh : "%d horas",
              d : "un día",
              dd : "%d días",
              M : "un mes",
              MM : "%d meses",
              y : "un año",
              yy : "%d años"
          },
          ordinalParse : /\d{1,2}(er|ème)/,
          ordinal : function (number) {
              return number + 'º';
          },
          meridiemParse: /PD|MD/,
          isPM: function (input) {
              return input.charAt(0) === 'M';
          },
          meridiem : function (hours, minutes, isLower) {
              return hours < 12 ? 'PD' : 'MD';
          },
          week : {
              dow : 1, // Monday is the first day of the week.
              doy : 4  // The week that contains Jan 4th is the first week of the year.
          }
      });


      beautydate();



/**
     * HOME
     ***********************************/
    <?php if (is_home()) { ?>
     
       $(window).on('load',function() {

        var $carousel = $('#mainslider').flickity({
          wrapAround: true,
          freeScroll: true,
          contain: true
        });

      });


    <?php } ?>




    /**
     * SIGLE / ARCHIVE EVENT
     ***********************************/    
    <?php if ('event' == get_post_type()) { ?>


      <?php if(is_archive()){ ?>

        

      <?php }else{ ?>

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
     * SIGLE / ARCHIVE FEE
     ***********************************/
    <?php } elseif ('fee' == get_post_type()) { ?>

      if ($(".tolisten").length > 0) {
        $('.tolisten').change(function(){
          $('.wrap--submit').addClass('active');
        })
      }
      /*if ($("#paymethod").length > 0) {
        $('#paymethod').change(function(){
          $('.wrap--submit').addClass('active');
        })
      }*/



    /**
     * PAGE TREASURY
     ***********************************/
    <?php } ?>
    <?php if (is_page('configuration-treasury')) { ?>
      
      //$datepicker.pikaday('show').pikaday('nextMonth');

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
     * PAGE SECRETARY
     ***********************************/
    <?php } else if (is_page('configuration-secretary')) { ?>

      $('body').on('change', '#files-inputfile', function(e){
        $("#files-placename").empty();
        var $input = $(this);
        var inputFiles = this.files;
        if (inputFiles == undefined || inputFiles.length == 0) return;
        $.each(inputFiles, function(index, file) {
          $("#files-placename").append("<li>"+file.name+"</li>");
        }); 
        $('input[name="files-filename"]').focus();

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







jQuery(document).ready(function($) {
  $('.action--restore').on('click', function(){
    var elem = $(this);
    var id = elem.data('id');
    var nonce = elem.data('nonce');
    var elem = $(elem)[0];
    var id = $(elem).data('id');
    var nonce = $(elem).data('nonce');
    var notifications = Number($('.notificationresume .number').text());
    
    if(notifications >= 1){
      notifications++;
      $('#notificationcount .number').text(notifications);
    }else{
      $('#notificationcount').html('Tienes <span class="number">1</span> notificaciones pendiente:');
    }

    $('#notification-'+id).prependTo('#notificationnow .list');
    if($("#notificationhistory .notification").length > 0) $('#archivelaunch').removeClass('hide');
    else {
      $('#archivelaunch').addClass('hide').removeClass('active');
      $('#notificationhistory').removeClass('active');
    }

    $.ajax({
      type: 'post',
      url: Ajax.ajaxurl,
      data: {
        action: 'approve_post_FTW',
        nonce: nonce,
        id: id
      },
      success: function(){
      },
      error: function(){
        alert('No se ha podido procesar la solicitud :/');
        $('#notification-'+id).prependTo('#notificationhistory .list');
      }
    });
  });

  $('.action--archive').on('click', function(){
    var elem = $(this);
    var id = elem.data('id');
    var nonce = elem.data('nonce');
    var notifications = Number($('.notificationresume .number').text());

    if(notifications > 1){
      notifications--;
      $('#notificationcount .number').text(notifications);
    }else if(notifications == 1) $('#notificationcount').text('Todo está en regla ¡Que tengas un buen día!');

    $('#notification-'+id).prependTo('#notificationhistory .list');
    if($("#notificationhistory .notification").length > 0) $('#archivelaunch').removeClass('hide');
    else {
      $('#archivelaunch').addClass('hide').removeClass('active');
      $('#notificationhistory').removeClass('active');
    }

    $.ajax({
      type: 'post',
      url: Ajax.ajaxurl,
      data: {
        action: 'delete_post',
        nonce: nonce,
        id: id
      },
      success: function(){
      },
      error: function(){
        alert('No se ha podido procesar la solicitud :/');
        $('#notification-'+id).prependTo('#notificationnow .list');
      }
    });

  });

  $('.action--remove').on('click', function(){
    var elem = $(this);
    var id = elem.data('id');
    var nonce = elem.data('nonce');
    $('#notification-'+id).addClass('hide');

    if($("#notificationhistory .notification").length > 0) $('#archivelaunch').removeClass('hide');
    else {
      $('#archivelaunch').addClass('hide').removeClass('active');
      $('#notificationhistory').removeClass('active');
    }

    $.ajax({
      type: 'post',
      url: Ajax.ajaxurl,
      data: {
        action: 'delete_post_FTW',
        nonce: nonce,
        id: id
      },
      success: function(){
        $('#notification-'+id).remove();
      },
      error: function(){
        alert('No se ha podido procesar la solicitud :/');
        $('#notification-'+id).removeClass('hide');
      }
    });


  });
});







  </script>
<?php } ?>