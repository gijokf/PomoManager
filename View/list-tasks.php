<script src="js/jQuery/jquery-3.6.0.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>feather.replace()</script>
<script src="js/timer.js"></script>
<script src="js/modal.js"></script>

<h1 class="titulo--destaque">Tarefas</h1>

<?php

use PomoManager\Controller\Task\taskListController;

$tasks = [];

if (isset($_POST['dateFilter'])) {
    $taskListController = new taskListController();
    $taskListController->processaRequisicao($_POST['dateFilter']);
    $tasks = $taskListController->tasks;
}
foreach ($tasks as $task): ?>
    <div class="tabela__tarefas">
        <div class="tabela--detalhes">
            <input type="checkbox" name="task" value="<?= $task["taskID"]; ?>"
                   data-name="<?= $task["taskDescription"]; ?>">
            <label><?= $task["taskDescription"]; ?></label>
        </div>

        <div class="tabela--botoes">
            <button class="botao__tabela--estilo alterar" data-id="<?= $task["taskID"]; ?>"
                    data-name="<?= $task["taskDescription"]; ?>"
                    data-date="<?= $task["taskDate"]; ?>"
                    data-exp="<?= $task["taskExp"]; ?>">
                <i data-feather="edit" aria-hidden="true"></i>
            </button>
            <button class="botao__tabela--estilo deletar" data-id="<?= $task["taskID"]; ?>">
                <i data-feather="trash-2" aria-hidden="true"></i>
            </button>
            <button class="botao__tabela--estilo concluir" data-id="<?= $task["taskID"]; ?>"
                    data-exp="<?= $task["taskExp"] ?>">
                <i data-feather="check-square" aria-hidden="true"></i>
            </button>
        </div>
    </div>
<?php endforeach; ?>

<button class="botao botao--tarefa inserir">Inserir tarefa</button>