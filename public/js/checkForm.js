$(function () {
    const input = $('.input');
    const botao = $('.botao--estilo');

    input.on('keyup', (function () {
        let empty = false;
        input.each(function () {
            if ($(this).val().length === 0) {
                empty = true;
            }
        });

        if (empty) {
            botao.attr('disabled', 'disabled');
        } else {
            botao.attr('disabled', false);
        }
    }));

    const password = $('#password');
    const checkPassword = $('#checkPassword');

    $(':password').on('keyup', (function () {
        $(':password').each(function () {

            if (password.val().length >= 6) {
                $('#pass6chars').css('color', '#FFFFFF');
            } else {
                $('#pass6chars').css('color', '#909090');
            }

            if (password.val() === checkPassword.val()) {
                $('#checked').css('color', '#FFFFFF');
            } else {
                $('#checked').css('color', '#909090');
            }

            if (checkPassword.val() === '') {
                $('#checked').css('color', '#909090');
            }
        });

    }));
});