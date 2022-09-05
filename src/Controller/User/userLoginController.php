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

                        header('Location: /dashboard');
                    } else {
                        session_unset();
                        session_destroy();
                        echo "E-mail ou senha inválidos";
                        return;
                    }
                } else {
                    session_unset();
                    session_destroy();
                    header('Location: /');
                }
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
        }
    }
}