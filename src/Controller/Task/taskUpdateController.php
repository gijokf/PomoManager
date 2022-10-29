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
        $taskDate = filter_input(INPUT_POST, 'taskDate', FILTER_DEFAULT);
        $taskExp = filter_input(INPUT_POST, 'tier', FILTER_SANITIZE_NUMBER_INT);

        $sqlQuery = $this->connection->prepare('UPDATE tasks SET taskDescription = ?, taskExp = ?, taskDate = ? WHERE taskID = ?');
        $sqlQuery->bindParam(1, $taskDescription, PDO::PARAM_STR);
        $sqlQuery->bindParam(2, $taskExp, PDO::PARAM_INT);
        $sqlQuery->bindParam(3, $taskDate, PDO::PARAM_STR);
        $sqlQuery->bindParam(4, $taskID, PDO::PARAM_INT);
        $sqlQuery->execute();

        session_start();
        $_SESSION['toast'] = '<div class="notificacao--toast ativo">
                                <div class="notificacao--conteudo">
                                    <i data-feather="check" aria-hidden="true"></i>
                                    <div class="mensagem">
                                        <span class="titulo">Sucesso!</span>
                                        <span>Tarefa alterada com sucesso.</span>
                                    </div>
                                </div>
                                    <i data-feather="x"></i>
                               </div>';

        header('Location: /dashboard');
    }
}