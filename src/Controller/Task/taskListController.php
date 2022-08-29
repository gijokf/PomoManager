<?php

namespace PomoManager\Controller\Task;

use PDO;
use PomoManager\Controller\controllersInterface;
use PomoManager\Entity\Task;

class taskListController extends Task implements controllersInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function processaRequisicao(): void
    {
        session_start();

        $userID = $_SESSION['userID'];
        $sqlQuery = $this->connection->prepare('SELECT taskID, taskDescription from tasks where userID = ?');
        $sqlQuery->bindParam(1, $userID, PDO::PARAM_INT);
        $sqlQuery->execute();

        $tasks = $sqlQuery->fetch(PDO::FETCH_ASSOC);
    }
}