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
<body>
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
<main class="card__main">
    <div class="card__grid-container container">

        <!-- Tarefas -->
        <div class="side__container">
            <h1 class="titulo--destaque">Tarefas</h1>
            <?php
            require_once('../src/Controller/Task/taskListController.php');

            use PomoManager\Controller\Task\taskListController;

            $tasks = [];
            $taskListController = new taskListController();
            $taskListController->processaRequisicao();
            $tasks = $taskListController->tasks;
            foreach ($tasks as $task): ?>
                <div class="tabela__tarefas">
                    <div class="tabela--detalhes">
                        <input type="checkbox" value="<?= $task["taskID"]; ?>">
                        <p><?= $task["taskDescription"]; ?></p>
                    </div>

                    <div class="tabela--botoes">
                        <button class="botao__tabela--estilo alterar" id="abrir-alt" value="<?= $task["taskID"]; ?>">
                            <i data-feather="edit" aria-hidden="true"></i>
                        </button>
                        <button class="botao__tabela--estilo deletar" id="abrir-dlt" value="<?= $task["taskID"]; ?>">
                            <i data-feather="trash-2" aria-hidden="true"></i>
                        </button>
                        <button class="botao__tabela--estilo concluir" id="abrir-clr" value="<?= $task["taskID"]; ?>">
                            <i data-feather="check-square" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>

            <button class="botao botao--tarefa" id="abrir">Inserir tarefa</button>
        </div>

        <!-- Timer -->
        <div class="center__container">
            <div class="card__central">
                <div class="timer_conteudo">
                    <h1 class="titulo" id="taskDescricao">Tarefa atual</h1>
                    <p class="titulo--destaque timer--tempo" id="timer"></p>
                    <button class="botao botao--estilo botao__iniciar" id="botao_timer">Iniciar</button>
                </div>
            </div>
        </div>

        <!-- Tarefas completas -->
        <div class="side__container">
            <h1 class="titulo--destaque">Completas</h1>
            <div class="tabela__tarefas">
                <div class="tabela--detalhes">
                    <input type="checkbox" value="">
                    <p>teste</p>
                </div>
                <div class="tabela--botoes">
                    <button class="botao__tabela--estilo alterar" id="abrir-alt" value="">
                        <i data-feather="edit" aria-hidden="true"></i>
                    </button>
                    <button class="botao__tabela--estilo deletar" id="abrir-dlt" value="">
                        <i data-feather="trash-2" aria-hidden="true"></i>
                    </button>
                    <button class="botao__tabela--estilo concluir" id="abrir-clr" value="">
                        <i data-feather="check-square" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card__botoes">

        <button class="botao botao--estilo" id="pomodoro">Pomodoro</button>
        <button class="botao botao--estilo" id="descansoCurto">Descanso Curto</button>
        <button class="botao botao--estilo" id="descansoLongo">Descanso Longo</button>

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
            <input class="input" name="descricao" type="text">
            <label for="tier">Selecione a dificuldade da tarefa:</label>
            <select class="input" id="tier" name="tier">
                <option value="Fácil">Fácil</option>
                <option value="Médio">Médio</option>
                <option value="Difícil">Difícil</option>
            </select>
            <button class="botao botao--estilo modal--confirma" type="submit">Alterar</button>
            <button class="botao botao--estilo modal--cancela" id="fechar-alt" type="reset">Cancelar</button>
        </form>
    </div>
</div>

<!-- Modal Deletar -->
<div class="modal-container" id="modal_container_dlt">
    <div class="modal">
        <form action="/delete-task?<?= $task['taskID'] ?>" method="POST">
            <h1 class="titulo">Excluir tarefa</h1>
            <p>Você realmente deseja deletar essa tarefa?</p>
            <input type="hidden" name="id" id="idDeletar" value="<?= $task["taskID"]; ?>">
            <button class="botao botao--estilo modal--confirma" type="submit">Sim</button>
            <button class="botao botao--estilo modal--cancela" id="fechar-dlt" type="reset">Cancelar</button>
        </form>
    </div>
</div>

<!-- Modal Concluir -->
<div class="modal-container" id="modal_container_clr">
    <div class="modal">
        <form action="" method="POST">
            <h1 class="titulo">Concluir tarefa</h1>
            <p>Confirme a conclusão da tarefa para ganhar EXP!</p>
            <input type="hidden" name="id" id="idConcluir" value="<?= $task["taskID"]; ?>">
            <button class="botao botao--estilo modal--confirma" type="submit">Concluir!</button>
            <button class="botao botao--estilo modal--cancela" id="fechar-clr" type="reset">Cancelar</button>
        </form>
    </div>
</div>

<!--Ícones-->
<script>feather.replace()</script>
<script src="js/jQuery/jquery-3.6.0.js"></script>
<script src="js/modal.js"></script>
<script src="js/timer.js"></script>
</body>
</html>