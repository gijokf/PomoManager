<?php

namespace PomoManager\Controller\User;

use PDO;
use PDOException;
use PomoManager\Controller\controllersInterface;
use PomoManager\Entity\User;

class userLoginController extends User implements controllersInterface
{

    public function __construct()
    {
        parent::__construct();
    }

    public function processaRequisicao(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userEmail = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $userPassword = filter_input(INPUT_POST, "password", FILTER_DEFAULT);

            session_start();

            try {
                $sqlQuery = $this->connection->prepare("SELECT * FROM users WHERE userEmail = ?");
                $sqlQuery->bindParam(1, $userEmail, PDO::PARAM_STR);
                $sqlQuery->execute();

                if ($sqlQuery->rowCount() > 0) {
                    $datas = $sqlQuery->fetch();
                    $hash = $datas["userPassword"];

                    $verifyPass = password_verify($userPassword, $hash);

                    if ($verifyPass) {
                        $_SESSION["userID"] = $datas["userID"];
                        $_SESSION["userName"] = $datas["userName"];
                        $_SESSION["userAvatar"] = $datas["userAvatar"];
                        $_SESSION["userExp"] = $datas["userExp"];

                        header('Location: /dashboard');
                    } else {
                        session_unset();
                        session_destroy();
                        header('Location: /');
                        session_start();
                        $_SESSION['msg'] = '<p class="notificacao--estilo erro">
                                            <i data-feather="alert-triangle" aria-hidden="true"></i>
                                            E-mail ou senha inválidos.</p>';
                        return;
                    }
                } else {
                    session_unset();
                    session_destroy();
                    header('Location: /');
                    session_start();
                    $_SESSION['msg'] = '<p class="notificacao--estilo erro">
                                        <i data-feather="alert-triangle" aria-hidden="true"></i>
                                        E-mail ou senha inválidos.</p>';
                    return;
                }
            } catch (PDOException $e) {
                echo "Erro:" . $e->getMessage();
                die();
            }
        }
    }
}