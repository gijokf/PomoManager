$(function () {
    //Modal Inserir
    const abrir = $('.inserir');
    const fechar = $('#fechar');
    const insDescricao = $('#taskDescription');
    const button = $('.modal--confirma');

    insDescricao.on('keyup', (function () {
        let empty = false;
        insDescricao.each(function () {
            if ($(this).val().length === 0) {
                empty = true;
            }
        });

        if (empty) {
            button.attr('disabled', 'disabled');
            $('.modal__alert').show();
        } else {
            button.attr('disabled', false);
            $('.modal__alert').hide();
        }
    }));


    abrir.on('click', function () {
        $('#modal_container').addClass('show')
    });

    fechar.on('click', function () {
        $('#modal_container').removeClass('show')
    });

    //Modal Alterar
    const abrir_alt = $('.alterar');
    const fechar_alt = $('#fechar-alt');
    const altDescricao = $('#altDescricao');

    altDescricao.on('keyup', (function () {
        let empty = false;
        altDescricao.each(function () {
            if ($(this).val().length === 0) {
                empty = true;
            }
        });

        if (empty) {
            button.attr('disabled', 'disabled');
            $('.modal__alert').show();
        } else {
            button.attr('disabled', false);
            $('.modal__alert').hide();
        }
    }));

    abrir_alt.on('click', function () {
        $('#modal_container_alt').addClass('show');
        $('#idAlterar').val($(this).attr("data-id"));
        $('#altDescricao').val($(this).attr("data-name"));
        $('#altData').val($(this).attr("data-date"));
        $('#altExp').val($(this).attr("data-exp"));

        console.log($(this).attr("data-exp"));
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
        $('#idConcluir').val($(this).attr("data-id"));
        $('#taskExperience').val($(this).attr("data-exp"));
    });

    fechar_clr.on('click', function () {
        $('#modal_container_clr').removeClass('show');
    });

    //Modal Config
    const abrir_config = $('#config');
    const fechar_config = $('#fechar-config');

    abrir_config.on('click', function () {
        $('#modal_container_config').addClass('show');
    });

    fechar_config.on('click', function () {
        $('#modal_container_config').removeClass('show');
    });
});