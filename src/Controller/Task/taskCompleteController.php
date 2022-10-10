<?php

namespace PomoManager\Controller\Task;

use PDO;
use PomoManager\Controller\controllersInterface;
use PomoManager\Entity\User;

class taskCompleteController extends User implements controllersInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function processaRequisicao(): void
    {

        session_start();
        $userID = $_SESSION['userID'];
        $taskID = filter_input(INPUT_POST, 'taskID', FILTER_SANITIZE_NUMBER_INT);
        $taskExp = filter_input(INPUT_POST, 'tier', FILTER_SANITIZE_NUMBER_INT);

        $sqlQuery = $this->connection->prepare('SELECT userExperience FROM users WHERE userID = ?');
        $sqlQuery->bindParam(1, $userID, PDO::PARAM_INT);
        $sqlQuery->execute();
        $currentExp = $sqlQuery->fetch(PDO::FETCH_ASSOC);

        $newExp = intval($currentExp['userExperience']) + $taskExp;

        $sqlQuery = $this->connection->prepare('UPDATE users SET userExperience = ? WHERE userID = ?');
        $sqlQuery->bindParam(1, $newExp, PDO::PARAM_INT);
        $sqlQuery->bindParam(2, $userID, PDO::PARAM_INT);
        $sqlQuery->execute();

        $sqlQuery = $this->connection->prepare('UPDATE tasks SET taskStatus = "COMPLETO" WHERE taskID = ?');
        $sqlQuery->bindParam(1, $taskID, PDO::PARAM_INT);
        $sqlQuery->execute();

        session_start();
        $_SESSION['toast'] = '<div class="notificacao--toast ativo">
                                <div class="notificacao--conteudo">
                                    <i data-feather="check" aria-hidden="true"></i>
                                    <div class="mensagem">
                                        <span>Sucesso!</span>
                                        <span>Tarefa concluída com sucesso.</span>
                                    </div>
                                </div>
                                    <i data-feather="x"></i>
                               </div>';

        header('Location: /dashboard');
    }
}