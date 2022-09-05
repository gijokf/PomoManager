$(document).ready(function () {
    $('.input').on('keyup', (function () {

        let empty = false;
        $('.input').each(function () {
            if ($(this).val().length === 0) {
                empty = true;
            }
        });

        if (empty) {
            $('.botao--estilo').attr('disabled', 'disabled');
        } else {
            $('.botao--estilo').attr('disabled', false);
        }
    }));
});