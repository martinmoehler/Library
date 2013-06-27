var galleryTimeout;
var galleryChooserState = 'closed';

$('#galleryChooserContainer').on('mouseenter', function() {
    $(this).css('backgroundColor', Models.galleryChooser.CSS.openedBackGround);

    galleryTimeout = setTimeout(function(){
        (function() {
            $('#galleryChooserContainer ul').css('display', 'block');
        })();
        $('#galleryChooserContainer ul').animate({
            opacity: 1
        });
        $('#galleryChooserContainer').animate({
            right : '0px'
        }, function () {
            Models.galleryChooserState = 'opened';
        });
    }, 1000);
});

$('#galleryChooserContainer').on('mouseleave', function() {
    $(this).css('backgroundColor', Models.galleryChooser.CSS.closedBackGround);
    clearTimeout(galleryTimeout);
    $('#galleryChooserContainer ul').animate({
            opacity: 0
    }, function() {
            $('#galleryChooserContainer ul').css('display', 'none');
        });
    $('#galleryChooserContainer').animate({
        right : Models.galleryChooser.CSS.closedRight
    }, function() {
        galleryChooserState = 'closed';
    });
});

$('#galleryChooserContainer').on('click', function() {
    clearTimeout(galleryTimeout);
    if(galleryChooserState === "opened") {
        $(this).css('backgroundColor', Models.galleryChooser.CSS.closedBackGround);
        var width = $('#galleryChooserContainer').width();
        $('#galleryChooserContainer ul').animate({
            opacity: 0
        }, function() {
            $('#galleryChooserContainer ul').css('display', 'none');
        });
        $('#galleryChooserContainer').animate({
            right : Models.galleryChooser.CSS.closedRight
        }, function() {
            galleryChooserState = 'closed';
        });
    } else {
        (function() {
            $('#galleryChooserContainer ul').css('display', 'block');
        })();
        $('#galleryChooserContainer ul').animate({
            opacity: 1
        });
        $('#galleryChooserContainer').animate({
            right : '0px'
        }, function () {
            galleryChooserState = 'opened';
        });
    }
});
