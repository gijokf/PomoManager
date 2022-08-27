<?php

namespace PomoManager\Controller\Task;

use PDO;

class taskDeleteController extends \PomoManager\Entity\Task implements \PomoManager\Controller\controllersInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function processaRequisicao(): void
    {
        $taskID = filter_input(INPUT_POST, 'taskID', FILTER_SANITIZE_NUMBER_INT);

        $sqlQuery = $this->connection->prepare('DELETE FROM tasks WHERE taskID = ?');
        $sqlQuery->bindParam(1, $taskID, PDO::PARAM_INT);
        $sqlQuery->execute();

        header('Location: /dashboard');
    }
}