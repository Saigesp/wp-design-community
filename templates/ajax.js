
// Aprobar notificación (restaurar)
function approveNotificationFTW(elem){
  var elem = jQuery(elem)[0];
  var id = jQuery(elem).data('id');
  var nonce = jQuery(elem).data('nonce');
  var notifications = Number(jQuery('.notificationresume .number').text());
  
  if(notifications >= 1){
    notifications++;
    jQuery('#notificationcount .number').text(notifications);
  }else{
    jQuery('#notificationcount').html('Tienes <span class="number">1</span> notificaciones pendiente:');
  }

  jQuery('#notification-'+id).prependTo('#notificationnow .list');
  if(jQuery("#notificationhistory .notification").length > 0) jQuery('#archivelaunch').removeClass('hide');
  else {
    jQuery('#archivelaunch').addClass('hide').removeClass('active');
    jQuery('#notificationhistory').removeClass('active');
  }

  jQuery.ajax({
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
      jQuery('#notification-'+id).prependTo('#notificationhistory .list');
    }
  });
}

// Archivar notificación (al archivo)
function deleteNotification(elem){
  var elem = jQuery(elem)[0];
  var id = jQuery(elem).data('id');
  var nonce = jQuery(elem).data('nonce');
  var notifications = Number(jQuery('.notificationresume .number').text());

  if(notifications > 1){
    notifications--;
    jQuery('#notificationcount .number').text(notifications);
  }else if(notifications == 1) jQuery('#notificationcount').text('Todo está en regla ¡Que tengas un buen día!');

  jQuery('#notification-'+id).prependTo('#notificationhistory .list');
  if(jQuery("#notificationhistory .notification").length > 0) jQuery('#archivelaunch').removeClass('hide');
  else {
    jQuery('#archivelaunch').addClass('hide').removeClass('active');
    jQuery('#notificationhistory').removeClass('active');
  }

  jQuery.ajax({
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
      jQuery('#notification-'+id).prependTo('#notificationnow .list');
    }
  });
}

// Borrar notificación definitivamente
function deleteNotificationFTW(elem){
  var elem = jQuery(elem)[0];
  var id = jQuery(elem).data('id');
  var nonce = jQuery(elem).data('nonce');
  jQuery('#notification-'+id).addClass('hide');

  if(jQuery("#notificationhistory .notification").length > 0) jQuery('#archivelaunch').removeClass('hide');
  else {
    jQuery('#archivelaunch').addClass('hide').removeClass('active');
    jQuery('#notificationhistory').removeClass('active');
  }


  jQuery.ajax({
    type: 'post',
    url: Ajax.ajaxurl,
    data: {
      action: 'delete_post_FTW',
      nonce: nonce,
      id: id
    },
    success: function(){
      jQuery('#notification-'+id).remove();
    },
    error: function(){
      alert('No se ha podido procesar la solicitud :/');
      jQuery('#notification-'+id).removeClass('hide');
    }
  });
}