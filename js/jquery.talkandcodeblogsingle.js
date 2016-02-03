$(document).ready(function() {
	// Share on twitter
  	$('.contentarticle p').selectionSharer();

    var thumbHeight = $('#thumbnail').height();// + $('#headertop').outerHeight();
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if(scroll  > thumbHeight) {
            $("#buttons-share").addClass("buttons-share__fixed");
        }else{
            $("#buttons-share").removeClass("buttons-share__fixed");
        }
    });
    $('#sharebuttoncont').on('click', function() {
        $('#buttons-share').toggleClass('buttons-share__expanded');
    });
    
});