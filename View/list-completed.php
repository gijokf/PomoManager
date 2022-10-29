<h1 class="titulo--destaque">Completas</h1>

<?php

use PomoManager\Controller\Task\taskCompletedListController;

$tasksCompleted = [];

if (isset($_POST['dateFilter'])) {
    $taskCompletedListController = new taskCompletedListController();
    $taskCompletedListController->processaRequisicao($_POST['dateFilter']);
    $tasksCompleted = $taskCompletedListController->tasksCompleted;
}
foreach ($tasksCompleted as $taskCompleted): ?>
    <div class="tabela__tarefas">
        <div class="tabela--detalhes">
            <input type="hidden" value="<?= $taskCompleted["taskID"] ?>">
            <label><?= $taskCompleted["taskDescription"]; ?></label>
        </div>
    </div>
<?php endforeach; ?>