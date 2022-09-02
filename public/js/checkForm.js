$(document).ready(function () {
    //Form Registro
    $('#buttonRegister').click(function () {
        const name = $('#name').val();
        const email = $('#email').val();
        const password = $('#password').val();
        const checkPassword = $('#checkPassword').val();

        if (name === '' || email === '' || password === '' || checkPassword === '') {
            $('#buttonRegister').prop("disabled", true);
            alert('Há campos vazios!.');
        } else {
            if (password !== checkPassword) {
                alert('As senhas não conferem.');
            } else {
                $('#formRegister').get(0).submit();
            }
        }

    })

    //Form Login
    $('#buttonLogin').click(function () {
        const email = $('#email').val();
        const password = $('#password').val();

        if (email === '' || password === '') {
            $('#buttonRegister').disable();
            alert('Há campos vazios!');
        } else {
            $('#formLogin').get(0).submit();
        }
    })
})