$(function () {
    const taskDate = $('#taskDate');
    let data = new Date();

    let ano = data.getFullYear();
    let mes = data.getMonth() + 1;
    let dia = data.getDate();

    taskDate.val(ano + '-' + mes + '-' + dia);

    taskDate.on('change', function () {
        $.ajax({
            type: "POST",
            data: {"taskDate": taskDate.val()},
            success: function () {

            }

        })
    })
})