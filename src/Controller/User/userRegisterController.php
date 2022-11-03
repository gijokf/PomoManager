<?php

namespace PomoManager\Controller\User;

use PDO;
use PDOException;
use PomoManager\Controller\controllersInterface;
use PomoManager\Entity\User;

class userRegisterController extends User implements controllersInterface
{

    public function __construct()
    {
        parent::__construct();
    }

    public function processaRequisicao(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userName = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
            $userEmail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $userPassword = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
            $userCheckPass = filter_input(INPUT_POST, 'checkPassword', FILTER_UNSAFE_RAW);
            $avatar = $_FILES['avatar'];

            if ($userPassword !== $userCheckPass) {
                header('Location: /register');
                session_start();
                $_SESSION['msg'] = '<p class="notificacao--estilo erro">
                                    <i data-feather="alert-triangle" aria-hidden="true"></i>
                                    As senhas não conferem.</p>';
                return;
            }

            if ($avatar['name'] !== '') {
                if ($avatar['size'] > 2097152) {
                    session_start();
                    $_SESSION['msg'] = '<p class="notificacao--estilo erro">
                                        <i data-feather="alert-triangle" aria-hidden="true"></i>
                                        Arquivo muito grande! Máx.: 2MB</p>';
                    header('Location: /register');
                }

                $folder = "assets/img/uploads/";
                $fileName = $avatar['name'];
                $newFileName = uniqid();
                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $userAvatar = $folder . $newFileName . "." . $extension;
                move_uploaded_file($avatar['tmp_name'], $userAvatar);
            } else {
                $userAvatar = 'assets/img/default-profile.png';
            }

            $hashPassword = password_hash($userPassword, PASSWORD_ARGON2I);

            try {
                $userExists = $this->connection->prepare('SELECT userName FROM users WHERE (userEmail = ?)');
                $userExists->bindParam(1, $userEmail, PDO::PARAM_STR);
                $userExists->execute();

                if ($userExists->rowCount() > 0) {
                    session_start();
                    $_SESSION['msg'] = '<p class="notificacao--estilo erro">
                                        <i data-feather="alert-triangle" aria-hidden="true"></i>
                                        Usuário já possui cadastro!</p>';
                    header('Location: /register');
                    die();
                } else {
                    $sqlQuery = $this->connection->prepare('INSERT INTO users (userName, userEmail, userPassword, userAvatar) VALUES (?, ?, ?, ?);');
                    $sqlQuery->bindParam(1, $userName, PDO::PARAM_STR);
                    $sqlQuery->bindParam(2, $userEmail, PDO::PARAM_STR);
                    $sqlQuery->bindParam(3, $hashPassword, PDO::PARAM_STR);
                    $sqlQuery->bindParam(4, $userAvatar, PDO::PARAM_LOB);
                    $sqlQuery->execute();

                    $sqlQuery = $this->connection->prepare('INSERT INTO profile (userID, profileShortBreak, profileLongBreak, profilePomodoro) VALUES (LAST_INSERT_ID(), 300, 900, 1500)');
                    $sqlQuery->execute();

                    session_start();
                    $_SESSION['msg'] = '<p class="notificacao--estilo sucesso">
                                        <i data-feather="check-circle" aria-hidden="true"></i>
                                        Cadastro efetuado com sucesso!</p>';
                    header('Location: /');
                    return;
                }

            } catch (PDOException $e) {
                echo "Erro:" . $e->getMessage();
                die();
            }
        }
    }
}