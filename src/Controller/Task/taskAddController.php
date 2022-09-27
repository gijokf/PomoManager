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
        $taskExp = filter_input(INPUT_POST, 'tier', FILTER_SANITIZE_NUMBER_INT);

        $sqlQuery = $this->connection->prepare('INSERT INTO tasks (userID, taskDescription, taskExp) VALUES (?, ?, ?)');
        $sqlQuery->bindParam(1, $userID, PDO::PARAM_INT);
        $sqlQuery->bindParam(2, $taskDescription, PDO::PARAM_STR);
        $sqlQuery->bindParam(3, $taskExp, PDO::PARAM_INT);
        $sqlQuery->execute();

        $_SESSION['toast'] = '<div class="notificacao--toast ativo">
                                <div class="notificacao--conteudo">
                                    <i data-feather="check" aria-hidden="true"></i>
                                    <div class="mensagem">
                                        <span class="titulo">Sucesso!</span>
                                        <span>Nova tarefa foi inserida.</span>
                                    </div>
                                </div>
                                    <i data-feather="x"></i>
                               </div>';

        header('Location: /dashboard');
    }
}