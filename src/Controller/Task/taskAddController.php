<?php

namespace PomoManager\Controller\Task;

use PDO;
use PomoManager\Controller\controllersInterface;
use PomoManager\Entity\Task;

class taskAddController extends Task implements controllersInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function processaRequisicao(): void
    {
        session_start();
        $userID = $_SESSION['userID'];
        $taskDescription = filter_input(INPUT_POST, 'descricao');
        $taskTier = filter_input(INPUT_POST, 'tier');
        $taskExp = 0;

        $sqlQuery = $this->connection->prepare('INSERT INTO tasks (userID, taskDescription, taskExp) VALUES (?, ?, ?)');
        $sqlQuery->bindParam(1, $userID, PDO::PARAM_INT);
        $sqlQuery->bindParam(2, $taskDescription, PDO::PARAM_STR);
        $sqlQuery->bindParam(3, $taskExp, PDO::PARAM_INT);
        $sqlQuery->execute();

        header('Location: /dashboard');
    }
}