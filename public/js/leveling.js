$(function () {
    const expAtual = parseInt($('#expAtual').text());
    const expProximo = parseInt($('#expProx').text());

    const porcentagem = (expAtual * 100) / expProximo;

    $('.bar .progress-line.html span').width(porcentagem.toFixed() + '%');
    $('.progress-line.html span').attr('porcentagem', porcentagem.toFixed().toString() + '%')
})