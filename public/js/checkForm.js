// $(document).ready(function () {
//     //Form Registro
//     $('#buttonRegister').click(function () {
//         const name = $('#name').val();
//         const email = $('#email').val();
//         const password = $('#password').val();
//         const checkPassword = $('#checkPassword').val();
//
//         if (name === '' || email === '' || password === '' || checkPassword === '') {
//             $('#buttonRegister').prop("disabled", true);
//             alert('Há campos vazios!.');
//         } else {
//             if (password !== checkPassword) {
//                 alert('As senhas não conferem.');
//             } else {
//                 $('#formRegister').get(0).submit();
//             }
//         }
//
//     })
//
//     //Form Login
//     $('#buttonLogin').click(function () {
//         const email = $('#email').val();
//         const password = $('#password').val();
//
//         if (email === '' || password === '') {
//             alert('Há campos vazios!');
//         } else {
//             $('#formLogin').get(0).submit();
//         }
//     })
// })
$(document).ready(function() {
    $('.input').on('keyup', (function() {

        let empty = false;
        $('.input').each(function() {
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