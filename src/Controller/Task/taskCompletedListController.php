<?php

namespace PomoManager\Controller\Task;

use PDO;
use PomoManager\Entity\Task;

class taskCompletedListController extends Task
{
    public $connection;
    public $tasksCompleted;

    public function __construct()
    {
        parent::__construct();
    }

    public function processaRequisicao(string $taskDate = ''): void
    {
        session_start();

        $userID = $_SESSION['userID'];

        $sqlQuery = $this->connection->prepare('SELECT taskID, taskDescription from tasks where userID = ? and taskStatus = "COMPLETO" and taskDate = ?');
        $sqlQuery->bindParam(1, $userID, PDO::PARAM_INT);
        $sqlQuery->bindParam(2, $taskDate, PDO::PARAM_STR);
        $sqlQuery->execute();

        $this->tasksCompleted = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

    }
}