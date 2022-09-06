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

    $(':password').on('keyup', (function () {
        $(':password').each(function () {

            if ($('#password').val().length >= 6) {
                $('#pass6chars').css('color', '#FFFFFF');
            } else {
                $('#pass6chars').css('color', '#909090');
            }

            if ($('#password').val() === $('#checkPassword').val()) {
                $('#checked').css('color', '#FFFFFF');
            } else {
                $('#checked').css('color', '#909090');
            }

            if ($('#password').val === '' || $('#checkPassword').val() === '') {
                $('#checked').css('color', '#909090');
            }
        });

    }));
});