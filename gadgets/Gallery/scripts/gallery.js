var galleryTimeout;
var galleryChooserState = 'closed';

$('#galleryChooserContainer').on('mouseenter', function() {
    $(this).css('backgroundColor', 'rgba(70,250,70,.6)');

    galleryTimeout = setTimeout(function(){
        $('#galleryChooserContainer').animate({
            right : '0px'
        }, function () {
            galleryChooserState = 'opened';
        });
    }, 1000);
});

$('#galleryChooserContainer').on('mouseleave', function() {
    $(this).css('backgroundColor', 'rgb(160,160,160)');
    clearTimeout(galleryTimeout);
    $('#galleryChooserContainer').animate({
        right : '-130px'
    }, function() {
        galleryChooserState = 'closed';
    });
});

$('#galleryChooserContainer').on('click', function() {
    clearTimeout(galleryTimeout);
    if(galleryChooserState === "opened") {
        $(this).css('backgroundColor', 'rgb(160,160,160)');
        
        $('#galleryChooserContainer').animate({
            right : '-130px'
        }, function() {
            galleryChooserState = 'closed';
        });
    } else {
        $('#galleryChooserContainer').animate({
            right : '0px'
        }, function () {
            galleryChooserState = 'opened';
        });
    }
});
