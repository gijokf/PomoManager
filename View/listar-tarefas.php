<?php

use PomoManager\Controller\Task\taskListController;

$tasks = [];
$taskListController = new taskListController();
$taskListController->processaRequisicao();
$tasks = $taskListController->tasks;
foreach ($tasks as $task): ?>
    <div class="tabela__tarefas">
        <div class="tabela--detalhes">
            <input type="checkbox" name="task" value="<?= $task["taskID"]; ?>"
                   data-name="<?= $task["taskDescription"]; ?>">
            <label><?= $task["taskDescription"]; ?></label>
        </div>

        <div class="tabela--botoes">
            <button class="botao__tabela--estilo alterar" id="abrir-alt" data-id="<?= $task["taskID"]; ?>">
                <i data-feather="edit" aria-hidden="true"></i>
            </button>
            <button class="botao__tabela--estilo deletar" id="abrir-dlt" data-id="<?= $task["taskID"]; ?>">
                <i data-feather="trash-2" aria-hidden="true"></i>
            </button>
            <button class="botao__tabela--estilo concluir" id="abrir-clr" data-id="<?= $task["taskID"]; ?>"
                    data-exp="<?= $task["taskExp"] ?>">
                <i data-feather="check-square" aria-hidden="true"></i>
            </button>
        </div>
    </div>
<?php endforeach; ?>