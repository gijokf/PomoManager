$(document).ready(function () {
    //Modal Inserir
    const abrir = $('#abrir');
    const fechar = $('#fechar');

    abrir.click(function () {
        $('#modal_container').addClass('show')
    })

    fechar.click(function () {
        $('#modal_container').removeClass('show')
    })

    //Modal Alterar
    const abrir_alt = $('#abrir-alt');
    const fechar_alt = $('#fechar-alt');
    let idAlterar = abrir_alt.val();

    abrir_alt.click(function () {
        $('#modal_container_alt').addClass('show');
        $('#idAlterar').val(idAlterar)
    })

    fechar_alt.click(function () {
        $('#modal_container_alt').removeClass('show');
    })

    //Modal Deletar
    const abrir_dlt = $('#abrir-dlt');
    const fechar_dlt = $('#fechar-dlt');
    let idDeletar = abrir_dlt.val();

    abrir_dlt.click(function () {
        $('#modal_container_dlt').addClass('show');
        $('#idDeletar').val(idDeletar)
    })

    fechar_dlt.click(function () {
        $('#modal_container_dlt').removeClass('show');
    })
})