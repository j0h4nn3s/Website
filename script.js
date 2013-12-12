$(function () {
    $('.folder img').click(function () {
        $('#bigfatimage').attr('style', 'transition-delay:0.3s;');
        $('#pictureinformation').attr('style', 'transition-delay:0.3s;');
        $('#modal-background').attr('style', 'transition-delay:0s;');
        $('#overlay').addClass('visible');
        var src = $(this).attr('src');
        $('#bigfatimage').attr('src', src);
        $('#bigfatimage').addClass('big');      
        $('#pictureinformation').addClass('big');

    });
    $('#modal-container').click(function (e) {
        if (e.target.id == 'modal-container') {
            $('#bigfatimage').attr('style', 'transition-delay:0s;');
            $('#pictureinformation').attr('style', 'transition-delay:0s;');
            $('#modal-background').attr('style', 'transition-delay:0.3s;');
            $('#overlay').removeClass('visible');
            $('#bigfatimage').removeClass('big');
            $('#pictureinformation').removeClass('big');
        }
        });
});