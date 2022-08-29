<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
    <link rel="stylesheet" href="css/components/input.css"/>
    <link rel="stylesheet" href="css/components/tabela.css"/>
    <link rel="stylesheet" href="css/components/modal.css"/>
    <script src="https://unpkg.com/feather-icons"></script>

    <?php
    session_start();
    if (!isset ($_SESSION["userID"])) {
        header('Location: /');
    }

    $userID = $_SESSION["userID"];
    $userName = $_SESSION["userName"];
    ?>
</head>
<body class="dashboard__body">
<header class="dashboard__cabecalho container">
    <div class="user__cabecalho">
        <img src="https://dummyimage.com/80x80/000/fff" class="user__avatar" alt="Avatar do usuário"/>
        <div class="titulo user__cabecalho--info">
            <h2><?= $userName; ?></h2>
            <h3>Lvl. 1</h3>
        </div>
    </div>

    <a class="botao botao--estilo logout" href="/logout"><i data-feather="log-out" aria-hidden="true"></i>Sair
    </a>
</header>
<main class="card__grid-container container">
    <?php
    require_once('../src/Controller/Task/taskListController.php');

    foreach ($tasks as $task) {
        ?>
        <div class="card__container">
            <div class="tabela__tarefas">
                <input type="checkbox" value="">
                <p><?= $task["taskDescription"] ?></p>
                <button class="botao__tabela--estilo alterar" id="abrir-alt" value="<?= $task["taskID"] ?>">
                    <i data-feather="edit" aria-hidden="true"></i>
                </button>
                <button class="botao__tabela--estilo deletar" id="abrir-dlt" value="<?= $task["taskID"] ?>">
                    <i data-feather="trash-2" aria-hidden="true"></i>
                </button>
            </div>

            <button class="botao botao--tarefa" id="abrir">Inserir tarefa</button>
        </div>
        <?php
    }
    ?>

    <div class="card__container">
        <div class="card__central">
            <div class="glass-effect">
                <h1 class="titulo">Tarefa atual</h1>
                <p class="titulo--destaque timer--tempo">00:00</p>
                <p>Ciclos da atividade atual: 0</p>
                <button class="botao--estilo botao__iniciar">Iniciar</button>
            </div>
        </div>
    </div>

    <div class="card__container">
        <div class="container card__tarefas">
            <h1 class="titulo">Buttons</h1>
        </div>
    </div>
</main>

<!-- Modal Inserir -->
<div class="modal-container" id="modal_container">
    <div class="modal">
        <form action="/add-task" method="POST">
            <h1 class="titulo">Inserir tarefa</h1>
            <p>Digite a descrição da tarefa</p>
            <input class="input" name="descricao" type="text">
            <label for="tier">Selecione a dificuldade da tarefa:</label>
            <select class="input" id="tier" name="tier">
                <option value="Fácil">Fácil</option>
                <option value="Médio">Médio</option>
                <option value="Difícil">Difícil</option>
            </select>
            <button class="botao botao--estilo modal--confirma" type="submit">Inserir</button>
            <button class="botao botao--estilo modal--cancela" id="fechar" type="reset">Cancelar</button>
        </form>
    </div>
</div>

<!-- Modal Alterar-->
<div class="modal-container" id="modal_container_alt">
    <div class="modal">
        <form action="" method="POST">
            <input type="hidden" name="id" id="idAlterar" value="">
            <h1 class="titulo">Alterar tarefa</h1>
            <p>Digite a nova descrição da tarefa</p>
            <label for="tier">Selecione a dificuldade da tarefa:</label>
            <select class="input" id="tier" name="tier">
                <option value="Fácil">Fácil</option>
                <option value="Médio">Médio</option>
                <option value="Difícil">Difícil</option>
            </select>
            <input class="input" name="descricao" type="text">
            <button class="botao botao--estilo modal--confirma" type="submit">Alterar</button>
            <button class="botao botao--estilo modal--cancela" id="fechar-alt" type="reset">Cancelar</button>
        </form>
    </div>
</div>

<!-- Modal Deletar -->
<div class="modal-container" id="modal_container_dlt">
    <div class="modal">
        <form action="" method="POST">
            <h1 class="titulo">Excluir tarefa</h1>
            <p>Você realmente deseja deletar essa tarefa?</p>
            <input type="hidden" name="id" id="idDeletar" value="">
            <button class="botao botao--estilo modal--confirma" type="submit">Sim</button>
            <button class="botao botao--estilo modal--cancela" id="fechar-dlt" type="reset">Cancelar</button>
        </form>
    </div>
</div>

<!--Ícones-->
<script>feather.replace()</script>

<script src="js/jQuery/jquery-3.6.0.js"></script>
<script src="js/modal.js"></script>
</body>
</html>