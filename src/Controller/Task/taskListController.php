<?php

namespace PomoManager\Controller\Task;

use DateTime;
use PDO;
use PomoManager\Controller\controllersInterface;
use PomoManager\Entity\Task;

class taskListController extends Task implements controllersInterface
{
    public $connection;
    public $tasks;

    public function __construct()
    {
        parent::__construct();
    }

    public function processaRequisicao(): void
    {
        $userID = $_SESSION['userID'];

        if (!isset($_POST['taskDate'])) {
            $currentDate = new DateTime();
            $taskDate = $currentDate->format('Y-m-d');
        } else {
            $taskDate = $_POST['taskDate'];
        }


        $sqlQuery = $this->connection->prepare('SELECT taskID, taskDescription, taskExp from tasks where userID = ? and taskStatus = "INCOMPLETO" and taskDate = ?');
        $sqlQuery->bindParam(1, $userID, PDO::PARAM_INT);
        $sqlQuery->bindParam(2, $taskDate, PDO::PARAM_STR);
        $sqlQuery->execute();

        $this->tasks = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

    }
}