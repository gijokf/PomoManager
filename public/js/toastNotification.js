$(function () {
    const toast = $('.notificacao--toast');
    const close = $('.feather-x');

    close.on('click', function () {
        toast.removeClass('ativo');
    });
});