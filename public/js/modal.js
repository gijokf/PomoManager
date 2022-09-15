$(function () {
    //Modal Inserir
    const abrir = $('#abrir');
    const fechar = $('#fechar');

    abrir.on('click', function () {
        $('#modal_container').addClass('show')
    });

    fechar.on('click', function () {
        $('#modal_container').removeClass('show')
    });

    //Modal Alterar
    const abrir_alt = $('.alterar');
    const fechar_alt = $('#fechar-alt');

    abrir_alt.on('click', function () {
        $('#modal_container_alt').addClass('show');
        $('#idAlterar').val($(this).attr("data-id"))
    });

    fechar_alt.on('click', function () {
        $('#modal_container_alt').removeClass('show');
    });

    //Modal Deletar
    const abrir_dlt = $('.deletar');
    const fechar_dlt = $('#fechar-dlt');

    abrir_dlt.on('click', function () {
        $('#modal_container_dlt').addClass('show');
        $('#idDeletar').val($(this).attr("data-id"));
    });

    fechar_dlt.on('click', function () {
        $('#modal_container_dlt').removeClass('show');
    });

    //Modal Concluir
    const abrir_clr = $('.concluir');
    const fechar_clr = $('#fechar-clr');

    abrir_clr.on('click', function () {
        $('#modal_container_clr').addClass('show');
        $('#idConcluir').val($(this).attr("data-id"))
    });

    fechar_clr.on('click', function () {
        $('#modal_container_clr').removeClass('show');
    });
});