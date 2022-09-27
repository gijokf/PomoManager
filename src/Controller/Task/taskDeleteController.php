<?php

namespace PomoManager\Controller\Task;

use PDO;
use PomoManager\Controller\controllersInterface;
use PomoManager\Entity\Task;

class taskDeleteController extends Task implements controllersInterface
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

        $sqlQuery = $this->connection->prepare('DELETE FROM tasks WHERE taskID = ? and userID = ?');
        $sqlQuery->bindParam(1, $taskID, PDO::PARAM_INT);
        $sqlQuery->bindParam(2, $userID, PDO::PARAM_INT);
        $sqlQuery->execute();

        $_SESSION['toast'] = '<div class="notificacao--toast ativo">
                                <div class="notificacao--conteudo">
                                    <i data-feather="check" aria-hidden="true"></i>
                                    <div class="mensagem">
                                        <span class="titulo">Sucesso</span>
                                        <span>Tarefa foi excluída.</span>
                                    </div>
                                </div>
                                    <i data-feather="x"></i>
                               </div>';

        header('Location: /dashboard');
    }
}