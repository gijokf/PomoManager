$(function () {
    const botaoIniciar = $('#botao_timer.botao__iniciar');
    const botaoParar = $('#botao_timer.botao__parar');
    const click_sound = new Audio('assets/click.mp3');
    const sino = new Audio('assets/bell.mp3');
    const timer = $('#timer');

    let intervalo = null;
    let segundosRestantes = 1500;

    atualizaTimer();

    botaoIniciar.on('click', function () {
        click_sound.play();
        botaoIniciar.text(botaoIniciar.text() === 'Iniciar' ? 'Parar' : 'Iniciar');
        botaoIniciar.toggleClass('botao__parar');

        if (intervalo === null) {
            iniciar()
        } else {
            parar();
        }
    });

    const botaoPomodoro = $('#pomodoro');
    const descansoCurto = $('#descansoCurto');
    const descansoLongo = $('#descansoLongo');

    botaoPomodoro.on('click', function () {
        if (intervalo !== null) {
            if (confirm("Você tem certeza que quer parar o timer atual?")) {
                parar();

                segundosRestantes = 1500;

                atualizaTimer();
                botaoIniciar.text('Iniciar');
                botaoIniciar.removeClass('botao__parar');
            } else {
                return;
            }
        } else {
            segundosRestantes = 1500;
            atualizaTimer();
        }
    });

    descansoCurto.on('click', function () {
        if (intervalo !== null) {
            if (confirm("Você tem certeza que quer parar o timer atual?")) {
                parar();

                segundosRestantes = 300;

                atualizaTimer();
                botaoIniciar.text('Iniciar');
                botaoIniciar.removeClass('botao__parar');
            } else {
                return;
            }
        } else {
            segundosRestantes = 300;
            atualizaTimer();
        }
    });

    descansoLongo.on('click', function () {
        if (intervalo !== null) {
            if (confirm("Você tem certeza que quer parar o timer atual?")) {
                parar();

                segundosRestantes = 900;

                atualizaTimer();
                botaoIniciar.text('Iniciar');
                botaoIniciar.removeClass('botao__parar');
            } else {
                return;
            }
        } else {
            segundosRestantes = 900;
            atualizaTimer();
        }
    });

    function atualizaTimer() {
        let minutos = Math.floor(segundosRestantes / 60);
        let segundos = segundosRestantes % 60;

        minutos = minutos.toString().padStart(2, '0');
        segundos = segundos.toString().padStart(2, '0');

        timer.text(`${minutos}:${segundos}`);
    }

    function iniciar() {
        if (segundosRestantes === 0) return;

        intervalo = setInterval(() => {
            segundosRestantes--;
            atualizaTimer();

            if (segundosRestantes === 0) {
                sino.play();
                parar();
            }
        }, 1000);
    }

    function parar() {
        click_sound.play();

        clearInterval(intervalo);
        intervalo = null;
    }
});