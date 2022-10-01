$(function () {
    const botaoIniciar = $('#botao_timer.botao__iniciar');
    const click_sound = new Audio('assets/click.mp3');
    const sino = new Audio('assets/bell.mp3');
    const timer = $('#timer');
    const taskSelected = $("input:checkbox");
    let ciclo = 0;

    taskSelected.on('click', function () {
        let $box = $(this);
        if ($box.is(":checked")) {

            let group = "input:checkbox[name='" + $box.attr("name") + "']";

            $(group).prop("checked", false);
            $box.prop("checked", true);

            $("#taskDescricao").text($box.attr("data-name"));
        } else {
            $box.prop("checked", false);
            $("#taskDescricao").text('Nenhuma tarefa selecionada...')
        }
    });

    let intervalo = null;
    let segundosRestantes = 5;

    atualizaTimer();

    botaoIniciar.on('click', function () {
        if ($("#taskDescricao").text() === 'Nenhuma tarefa selecionada...') {
            alert('Selecione uma tarefa antes de iniciar!')
        } else {
            click_sound.play();
            botaoIniciar.text(botaoIniciar.text() === 'Iniciar' ? 'Parar' : 'Iniciar');
            botaoIniciar.toggleClass('botao__parar');

            if (intervalo === null) {
                iniciar();
            } else {
                parar();
            }
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
                botaoIniciar.removeClass('botao__parar')
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
            }
        } else {
            segundosRestantes = 900;
            atualizaTimer();
        }
    });

    function Pomodoro() {
        segundosRestantes = 1000;

        atualizaTimer();
        botaoIniciar.text('Iniciar');
        botaoIniciar.removeClass('botao__parar');
    }

    function Curto() {
        ciclo += 1;
        segundosRestantes = 3;
        atualizaTimer();

        botaoIniciar.text('Iniciar');
        botaoIniciar.removeClass('botao__parar')
    }

    function Longo() {
        ciclo = 0;
        segundosRestantes = 10;

        atualizaTimer();
        botaoIniciar.text('Iniciar');
        botaoIniciar.removeClass('botao__parar');
    }

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
                tempoAcabou();
            }
        }, 1000);
    }

    function parar() {
        click_sound.play();

        clearInterval(intervalo);
        intervalo = null;
    }

    function tempoAcabou() {
        if (ciclo <= 3) {
            Curto();
        } else {
            Longo();
        }

        clearInterval(intervalo);
        intervalo = null;
    }
});