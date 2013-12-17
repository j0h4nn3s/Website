$(function () {
    $('.folder img').click(function () {
        $('#bigfatimage').attr('style', 'transition-delay:0.3s;');
        $('#pictureinformation').attr('style', 'transition-delay:0.3s;');
        $('#modal-background').attr('style', 'transition-delay:0s;');
        $('#overlay').addClass('visible');
        loadImages(this);
    });
    $('#nextimage').click(function () {
        $('#bigfatimage').attr('style', 'transition-delay:0.3s;');
        $('#pictureinformation').attr('style', 'transition-delay:0.3s;');
        $('#modal-background').attr('style', 'transition-delay:0s;');
        $('#overlay').addClass('visible');
        loadImages(this);
    });
    $('#previousimage').click(function () {
        $('#bigfatimage').attr('style', 'transition-delay:0.3s;');
        $('#pictureinformation').attr('style', 'transition-delay:0.3s;');
        $('#modal-background').attr('style', 'transition-delay:0s;');
        $('#overlay').addClass('visible');
        loadImages(this);
    });
    $(window).keydown(function (e) {
        if ($('#overlay').hasClass('visible')) {            
            if (e.keyCode == 40 || e.keyCode == 39) {
                e.preventDefault();
                var nextImage = getImage(1);
                if (nextImage != null) {
                    loadImages(nextImage);
                }

            }
            else if (e.keyCode == 38 || e.keyCode == 37) {
                e.preventDefault();
                var nextImage = getImage(-1);
                if (nextImage != null) {
                    loadImages(nextImage);
                }
            }
            else if (e.keyCode == 27 ) {
                e.preventDefault();
                closeOverlay();
            }
        }
    });
    $('#modal-container').click(function (e) {
        if (e.target.id == 'modal-container') {
            closeOverlay();
        }
    });
    
});
function closeOverlay() {
    $('#bigfatimage').attr('style', 'transition-delay:0s;');
    $('#pictureinformation').attr('style', 'transition-delay:0s;');
    $('#modal-background').attr('style', 'transition-delay:0.3s;');
    $('#overlay').removeClass('visible');
    $('#bigfatimage').removeClass('big');
    $('#pictureinformation').removeClass('big');
}
function getImage(offset) {
    var id = $('#bigfatimage').attr('data-id');
    var currentImage = $('#img-' + id)[0];
    var images = $(currentImage.parentNode.parentNode).find('img');
    var nextImageIndex = images.index(currentImage) + offset;
    if (nextImageIndex >= 0 && nextImageIndex < images.length) {
        var nextImage = images[nextImageIndex];
        return nextImage;
    }
    else {
        return null;
    }
    
}
function loadImages(image) {
    loadImage(image, '#bigfatimage', 'true');
    loadImage(getImage(1), '#nextimage', 'false');
    loadImage(getImage(-1), '#previousimage', 'false');
}
function loadImage(image, pictureid, loadcomments) {
    
    var src = $(image).attr('src');
    var id = $(image).attr('id');
    id = id.substring(4);
    $(pictureid).attr('src', src);
    $(pictureid).addClass('big');
    $(pictureid).attr('data-id', id);
    if (loadcomments == 'true') {
        if (longRequest != null) {
            longRequest.abort();
        }
        $('#pictureinformation').addClass('big');
        $('#pictureinformation').addClass('loading');
        var container = $('#pictureinformation')[0];
        container.innerHTML = '';
        longRequest = $.ajax("api/picture.php?id=" + id, {
            async: 'true',
            timeout: 5000,
            complete: function (request, status) {
                console.log('Complete: ' + status);
                $('#pictureinformation').removeClass('loading');
                longRequest = null;
            },
            error: function (request, status, error) {
                console.log('Error: ' + error);
            },
            success: function (data, status, request) {

                var picture = $.parseJSON(data);
                var heading = document.createElement('h2');
                heading.innerHTML = picture.title;
                var date = document.createElement('h3');
                date.innerHTML = picture.timestamp;
                var description = document.createElement('p');
                description.innerHTML = picture.description;
                var list = document.createElement('ul');
                list.className = 'comments';
                if (picture.comments.length > 0) {
                    for (var i = 0; i < picture.comments.length ; i++) {
                        var li = document.createElement('li');
                        list.appendChild(li);
                        var strong = document.createElement('strong');
                        strong.innerHTML = picture.comments[i].username;
                        var span = document.createElement('span');
                        span.innerHTML = ' schrieb am ' + picture.comments[i].date + ' um ' + picture.comments[i].time + ' Uhr:';
                        //var time = document.createElement('time');
                        //time.innerHTML = picture.comments[i].date;
                        var paragraph = document.createElement('p');
                        paragraph.innerHTML = '"' + picture.comments[i].text + '"';
                        li.appendChild(strong);
                        li.appendChild(span);
                        li.appendChild(paragraph);
                    }
                }
                else {
                    var li = document.createElement('li');
                    list.appendChild(li);
                    var paragraph = document.createElement('p');
                    paragraph.innerHTML = 'Keine Kommentare vorhanden';
                    li.appendChild(paragraph);
                }
                //$('#pictureinformation').html('abc');

                container.appendChild(heading);
                container.appendChild(date);
                container.appendChild(description);
                container.appendChild(list);
            }
        });
    }
}
var longRequest = null;