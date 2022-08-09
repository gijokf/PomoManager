<?php

namespace PomoManager\Controller\User;

use PDO;
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
            define('imageSize', (2 * 80 * 80));

            //        if (!isset($_FILES['avatar']))
            //        {
            //            echo retorno('Selecione uma imagem');
            //            exit;
            //        }

            //        $image = $_FILES['avatar'];

            $userName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $userEmail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $userPassword = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
            //        $userAvatar = file_get_contents($image['tmp_name']);

            $hashPassword = password_hash($userPassword, PASSWORD_ARGON2I);

            $sqlQuery = $this->connection->prepare('INSERT INTO users (userName, userEmail, userPassword) VALUES (?, ?, ?);');
            $sqlQuery->bindParam(1, $userName, PDO::PARAM_STR);
            $sqlQuery->bindParam(2, $userEmail, PDO::PARAM_STR);
            $sqlQuery->bindParam(3, $hashPassword, PDO::PARAM_STR);
            //        $sqlQuery->bindParam(4, $userAvatar, PDO::PARAM_LOB);
            $sqlQuery->execute();

            header('Location: /login');
        }
    }
}