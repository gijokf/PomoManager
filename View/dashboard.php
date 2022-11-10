<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="js/jQuery/jquery-3.6.0.js"></script>
    <title>PomoManager | Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
            href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;700&display=swap"
            rel="stylesheet"
    />
    <link rel="icon" href="assets/img/pomomanager_icon.png"/>
    <link rel="stylesheet" href="css/base/base.css"/>
    <link rel="stylesheet" href="css/components/cabecalho.css"/>
    <link rel="stylesheet" href="css/components/botao.css"/>
    <link rel="stylesheet" href="css/components/card.css"/>
    <link rel="stylesheet" href="css/components/label.css"/>
    <link rel="stylesheet" href="css/components/input.css"/>
    <link rel="stylesheet" href="css/components/tabela.css"/>
    <link rel="stylesheet" href="css/components/modal.css"/>
    <link rel="stylesheet" href="css/components/notificacao.css"/>
    <link rel="stylesheet" href="css/components/experiencia.css"/>
    <script src="https://unpkg.com/feather-icons"></script>

    <?php
    session_start();
    if (!isset ($_SESSION["userID"])) {
        header('Location: /');
    }

    $userID = $_SESSION["userID"];
    $userName = $_SESSION["userName"];
    $userEmail = $_SESSION["userEmail"];
    $userAvatar = $_SESSION["userAvatar"];
    $userExp = $_SESSION["userExp"];
    $pomodoro = $_SESSION["timePomodoro"] / 60;
    $shortBreak = $_SESSION["timeShortBreak"] / 60;
    $longBreak = $_SESSION["timeLongBreak"] / 60;

    use PomoManager\Entity\User;

    $User = new User();

    $userLevel = $User->calcLevel($userExp, .1);
    $xpToNextLevel = $User->xpToNextLevel($userLevel, .1);
    $atualXP = $User->calcXP($userLevel, .1);

    if ($userExp >= $atualXP) {
        $progressXP = $userExp - $atualXP;
    } else {
        $progressXP = $atualXP - $userExp;
    }

    ?>
</head>
<body>

<script src="js/dateFilter.js"></script>
<?php
//Notificação
if (isset($_SESSION['toast'])):
    echo $_SESSION['toast'];
endif;

unset($_SESSION['toast']);
?>

<header class="dashboard__cabecalho container">
    <div class="user__cabecalho">
        <img src="<?= $userAvatar ?>" id="config" class="user__avatar" alt="Avatar do usuário"/>
        <div class="titulo user__cabecalho--info">
            <h2><?= $userName; ?></h2>
            <h3>Lvl. <?= $userLevel; ?></h3>
        </div>
    </div>

    <!--    Barra de exp-->
    <div class="skill-bars">
        <div class="bar">
            <div class="info">
                <span>Experiência</span>
            </div>
            <div class="progress-line html">
                <span></span>
            </div>
        </div>
        <div class="skill-bars--info">
            <span id="expProx"><?= $progressXP; ?></span>
            <span id="expAtual"><?= $xpToNextLevel; ?></span>
        </div>
    </div>


    <div class="botao__cabecalho">
        <a class="botao botao--estilo logout" href="/logout"><i data-feather="log-out" aria-hidden="true"></i>Sair
        </a>
    </div>
</header>

<main class="card__main">
    <div class="card__grid-container container">

        <!-- Tarefas -->
        <div class="side__container tasks">

            <?php include __DIR__ . '/list-tasks.php'; ?>

        </div>

        <!-- Timer -->
        <div class="center__container">
            <label>Data
                <input class=input type="date" id="taskDate">
            </label>
            <div class="card__central">
                <div class="timer_conteudo">
                    <h1 class="titulo" id="taskDescricao">Nenhuma tarefa selecionada...</h1>
                    <p class="titulo--destaque timer--tempo" id="timer"></p>
                    <button class="botao botao--estilo botao__iniciar" id="botao_timer">Iniciar</button>
                </div>
            </div>
        </div>

        <!-- Tarefas completas -->
        <div class="side__container completed">

            <?php include __DIR__ . '/list-completed.php'; ?>

        </div>
    </div>

    <div class="card__botoes">
        <button class="botao botao--estilo" id="pomodoro">Pomodoro</button>
        <button class="botao botao--estilo" id="descansoCurto">Descanso Curto</button>
        <button class="botao botao--estilo" id="descansoLongo">Descanso Longo</button>
        <button class="botao botao--estilo" id="apresentacao">Apresentação</button>
    </div>
</main>


<!-- Modal Inserir -->
<div class="modal-container" id="modal_container">
    <div class="modal">
        <form action="/add-task" method="POST">
            <h1 class="titulo">Inserir tarefa</h1>
            <p class="modal__alert">Há campos vazios!</p>
            <label for="taskDescription">Digite a descrição da tarefa</label>
            <input class="input" name="taskDescription" type="text" id="taskDescription" placeholder="Descrição">
            <label for="tier">Selecione a dificuldade da tarefa:</label>
            <select class="input" name="tier" id="tier">
                <option value="100">Fácil</option>
                <option value="250">Médio</option>
                <option value="500">Difícil</option>
            </select>
            <button class="botao botao--estilo modal--confirma" type="submit">Inserir</button>
            <button class="botao botao--estilo modal--cancela" id="fechar" type="reset">Cancelar</button>
        </form>
    </div>
</div>

<!-- Modal Alterar-->
<div class="modal-container" id="modal_container_alt">
    <div class="modal">
        <form action="/update-task" method="POST">
            <input type="hidden" name="taskID" id="idAlterar">
            <h1 class="titulo">Alterar tarefa</h1>
            <p class="modal__alert">Há campos vazios!</p>
            <label for="altDescricao">Digite a descrição da tarefa</label>
            <input class="input" name="taskDescription" type="text" id="altDescricao">
            <label for="altData">Selecione a data da tarefa</label>
            <input class="input" name="taskDate" type="date" id="altData">
            <label for="altExp">Selecione a dificuldade da tarefa:</label>
            <select class="input" name="tier" id="altExp">
                <option value="100">Fácil</option>
                <option value="250">Médio</option>
                <option value="500">Difícil</option>
            </select>
            <button class="botao botao--estilo modal--confirma" type="submit">Alterar</button>
            <button class="botao botao--estilo modal--cancela" id="fechar-alt" type="reset">Cancelar</button>
        </form>
    </div>
</div>

<!-- Modal Deletar -->
<div class="modal-container" id="modal_container_dlt">
    <div class="modal">
        <form action="/delete-task" method="POST">
            <h1 class="titulo">Excluir tarefa</h1>
            <p>Você realmente deseja deletar essa tarefa?</p>
            <input type="hidden" name="taskID" id="idDeletar">
            <button class="botao botao--estilo modal--confirma" type="submit">Sim</button>
            <button class="botao botao--estilo modal--cancela" id="fechar-dlt" type="reset">Cancelar</button>
        </form>
    </div>
</div>

<!-- Modal Concluir -->
<div class="modal-container" id="modal_container_clr">
    <div class="modal">
        <form action="/complete-task" method="POST">
            <h1 class="titulo">Concluir tarefa</h1>
            <p>Confirme a conclusão da tarefa para ganhar EXP!</p>
            <input type="hidden" name="taskID" id="idConcluir">
            <input type="hidden" name="tier" id="taskExperience">
            <button class="botao botao--estilo modal--confirma" type="submit">Concluir!</button>
            <button class="botao botao--estilo modal--cancela" id="fechar-clr" type="reset">Cancelar</button>
        </form>
    </div>
</div>

<!-- Modal Config -->
<div class="modal-container" id="modal_container_config">
    <div class="modal">
        <form action="/profile-update" method="POST" enctype="multipart/form-data">
            <h1 class="titulo">Configurações do perfil</h1>
            <div class="input__avatar">
                <label for="avatar">
                    <img class="input--image" id="avatarPrev" src="<?= $userAvatar ?>"
                         alt="Avatar Preview">
                </label>
                <input id="avatar" type="file" name="avatar"
                       onchange="document.getElementById('avatarPrev').src = window.URL.createObjectURL(this.files[0]);"
                       accept="image/png, image/jpeg">
            </div>

            <label class="label" for="name">Nome</label>
            <input type="text" id="name" name="name" placeholder="Nome" class="input" value="<?= $userName ?>"/>

            <label class="label" for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="E-mail" class="input"
                   value="<?= $userEmail ?>"/>

            <div class="modal__config">
                <label for="timePomodoro">Ciclo Pomodoro:</label>
                <input type="number" name="timePomodoro" id="timePomodoro" class="input input__timer"
                       placeholder="Minutos"
                       value="<?= $pomodoro; ?>"
                       min="25"
                       max="60"/>

                <label for="timeShortBreak">Descanso curto:</label>
                <input type="number" name="timeShortBreak" id="timeShortBreak" class="input input__timer"
                       placeholder="Minutos"
                       value="<?= $shortBreak; ?>"
                       min="5"
                       max="60"/>

                <label for="timeLongBreak">Descanso longo:</label>
                <input type="number" name="timeLongBreak" id="timeLongBreak" class="input input__timer"
                       placeholder="Minutos"
                       value="<?= $longBreak; ?>"
                       min="15"
                       max="60"/>
            </div>

            <button class="botao botao--estilo modal--confirma" type="submit">Salvar</button>
            <button class="botao botao--estilo modal--cancela" id="fechar-config" type="reset">Cancelar</button>
        </form>
    </div>
</div>


<!--Ícones-->
<script>feather.replace()</script>
<script src="js/modal.js"></script>
<script src="js/timer.js"></script>
<script src="js/leveling.js"></script>
<script src="js/toastNotification.js"></script>
</body>
</html>