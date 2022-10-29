<?php

namespace PomoManager\Controller\Task;

use PDO;
use PomoManager\Entity\Task;

class taskListController extends Task
{
    public $connection;
    public $tasks;

    public function __construct()
    {
        parent::__construct();
    }

    public function processaRequisicao(string $taskDate = ''): void
    {
        session_start();

        $userID = $_SESSION['userID'];

        $sqlQuery = $this->connection->prepare('SELECT * from tasks where userID = ? and taskStatus = "INCOMPLETO" and taskDate = ?');
        $sqlQuery->bindParam(1, $userID, PDO::PARAM_INT);
        $sqlQuery->bindParam(2, $taskDate, PDO::PARAM_STR);
        $sqlQuery->execute();

        $this->tasks = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

    }
}