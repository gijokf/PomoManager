<?php

namespace PomoManager\Controller\Task;

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

        $taskExp = filter_input(INPUT_POST, 'tier', FILTER_SANITIZE_NUMBER_INT);

        $currentExp = $this->getUserExp();

        $newExp = $currentExp + $taskExp;

        $sqlQuery = $this->connection->prepare('UPDATE users SET userExp = ?');
        $sqlQuery->bindParam(1, $newExp, PDO::PARAM_INT);
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