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
    const abrir_alt = $('#abrir-alt');
    const fechar_alt = $('#fechar-alt');
    let idAlterar = abrir_alt.val();

    abrir_alt.on('click', function () {
        $('#modal_container_alt').addClass('show');
        $('#idAlterar').val(idAlterar)
    });

    fechar_alt.on('click', function () {
        $('#modal_container_alt').removeClass('show');
    });

    //Modal Deletar
    const abrir_dlt = $('#abrir-dlt');
    const fechar_dlt = $('#fechar-dlt');
    let idDeletar = abrir_dlt.val();

    abrir_dlt.on('click', function () {
        $('#modal_container_dlt').addClass('show');
        $('#idDeletar').val(idDeletar)
    });

    fechar_dlt.on('click', function () {
        $('#modal_container_dlt').removeClass('show');
    });

    //Modal Concluir
    const abrir_clr = $('#abrir-clr');
    const fechar_clr = $('#fechar-clr');
    let idConcluir = abrir_dlt.val();

    abrir_clr.on('click', function () {
        $('#modal_container_clr').addClass('show');
        $('#idConcluir').val(idConcluir)
    });

    fechar_clr.on('click', function () {
        $('#modal_container_clr').removeClass('show');
    });
});