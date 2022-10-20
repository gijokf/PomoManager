<?php

use PomoManager\Controller\Task\taskCompletedListController;

$tasksCompleted = [];
$taskCompletedListController = new taskCompletedListController();
$taskCompletedListController->processaRequisicao();
$tasksCompleted = $taskCompletedListController->tasksCompleted;
foreach ($tasksCompleted as $taskCompleted): ?>
    <div class="tabela__tarefas">
        <div class="tabela--detalhes">
            <label><?= $taskCompleted["taskDescription"]; ?></label>
        </div>
    </div>
<?php endforeach; ?>