$(function() {
    $('.popup-modal').click(function(e) {
        e.preventDefault();
        var modal = $('#modal-delete').modal('show');
        modal.find('.modal-body').load($('.modal-dialog'));
        var that = $(this);
        var id = that.data('id');
        var name = that.data('name');
        modal.find('.modal-title').text('Удаление пользователя ' + name);

        $('#delete-confirm').click(function(e) {
            e.preventDefault();
            window.location = 'user/delete?id='+id;
        });
    });

    $('.popup-modal-1').click(function(e) {
        e.preventDefault();
        var modal = $('#confirm').modal('show');
        console.log($(this).attr('href'));
        modal.find('.modal-body').load($(this).attr('href'));
        var that = $(this);
        var id = that.data('id');
        var name = that.data('name');
        modal.find('.modal-title').text(that.data('title'));
    });

});

function GetLinks() {
    $('.loader-wrapper').fadeIn(1000);
    $('#links-data').fadeOut(1000)
    var data = $('#urls').val();
    $('#links_info').load('core', {'urls': data, 'do':'info'}, function (responseTxt, statusTxt, xhr) {
        if(statusTxt == "success"){
            $(this).fadeIn(1500);
        }
        if (statusTxt == "error") {
            var msg = "Sorry but there was an error: ";
            $(this).html(msg + xhr.status + " " + xhr.statusText);
            $(this).fadeIn(1500);
        }
        $('.loader-wrapper').fadeOut(1000);
    });
}