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