function deleteNotification(elem){
  var elem = jQuery(elem)[0];
  var id = jQuery(elem).data('id');
  var nonce = jQuery(elem).data('nonce');
  jQuery.ajax({
    type: 'post',
    url: Ajax.ajaxurl,
    data: {
      action: 'my_delete_post',
      nonce: nonce,
      id: id
    },
    success: function(){
      jQuery('#notification-'+id).remove();
    },
    error: function(){
      alert('failure');
    }
  });
}