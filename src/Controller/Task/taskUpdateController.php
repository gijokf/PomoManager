<?php

namespace PomoManager\Controller\Task;

use PDO;
use PomoManager\Controller\controllersInterface;
use PomoManager\Entity\Task;

class taskUpdateController extends Task implements controllersInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function processaRequisicao(): void
    {
        $taskID = filter_input(INPUT_POST, 'taskID', FILTER_SANITIZE_NUMBER_INT);
        $taskDescription = filter_input(INPUT_POST, 'taskDescription', FILTER_DEFAULT);
        $taskExp = filter_input(INPUT_POST, 'tier', FILTER_SANITIZE_NUMBER_INT);

        $sqlQuery = $this->connection->prepare('UPDATE tasks SET taskDescription = ?, taskExp = ? WHERE taskID = ?');
        $sqlQuery->bindParam(1, $taskDescription, PDO::PARAM_STR);
        $sqlQuery->bindParam(2, $taskExp, PDO::PARAM_INT);
        $sqlQuery->bindParam(3, $taskID, PDO::PARAM_INT);
        $sqlQuery->execute();

        header('Location: /dashboard');
    }
}