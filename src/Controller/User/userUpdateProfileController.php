<?php

namespace PomoManager\Controller\User;

use PDO;
use PDOException;
use PomoManager\Controller\controllersInterface;
use PomoManager\Entity\User;

class userUpdateProfileController extends User implements controllersInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function processaRequisicao(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();

            $userID = $_SESSION['userID'];
            $userName = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
            $userEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $timePomodoro = filter_input(INPUT_POST, 'timePomodoro', FILTER_SANITIZE_NUMBER_INT);
            $timeShortBreak = filter_input(INPUT_POST, 'timeShortBreak', FILTER_SANITIZE_NUMBER_INT);
            $timeLongBreak = filter_input(INPUT_POST, 'timeLongBreak', FILTER_SANITIZE_NUMBER_INT);

            if (isset($_FILES['avatar'])) {
                $avatar = $_FILES['avatar'];

                if ($avatar['size'] > 2097152) {
                    session_start();
                    $_SESSION['msg'] = '<p class="notificacao--estilo erro">
                                    <i data-feather="alert-triangle" aria-hidden="true"></i>
                                    Arquivo muito grande! Máx.: 2MB</p>';
                    header('Location: /dashboard');
                }

                $sqlQuery = $this->connection->prepare('SELECT userAvatar FROM users where userID = ?');
                $sqlQuery->bindParam(1, $userID, PDO::PARAM_INT);
                $sqlQuery->execute();

                $oldAvatarPath = $sqlQuery->fetch();

//                if ($oldAvatarPath !== '') {
//                    unlink($oldAvatarPath);
//                }

                $folder = "assets/img/uploads/";
                $fileName = $avatar['name'];
                $newFileName = uniqid();
                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $userAvatar = $folder . $newFileName . "." . $extension;
                move_uploaded_file($avatar['tmp_name'], $userAvatar);
            }

            $timePomodoro = $timePomodoro * 60;
            $timeShortBreak = $timeShortBreak * 60;
            $timeLongBreak = $timeLongBreak * 60;

            try {
                $sqlQuery = $this->connection->prepare('UPDATE profile SET profileShortBreak = ?, profileLongBreak = ?, profilePomodoro = ? WHERE userID = ?');
                $sqlQuery->bindParam(1, $timeShortBreak, PDO::PARAM_INT);
                $sqlQuery->bindParam(2, $timeLongBreak, PDO::PARAM_INT);
                $sqlQuery->bindParam(3, $timePomodoro, PDO::PARAM_INT);
                $sqlQuery->bindParam(4, $userID, PDO::PARAM_INT);
                $sqlQuery->execute();

                if ($sqlQuery->execute()) {
                    $_SESSION["timePomodoro"] = $timePomodoro;
                    $_SESSION["timeShortBreak"] = $timeShortBreak;
                    $_SESSION["timeLongBreak"] = $timeLongBreak;
                }

                $sqlQuery = $this->connection->prepare('UPDATE users SET userName = ?, userEmail = ?, userAvatar = ? WHERE userID = ?');
                $sqlQuery->bindParam(1, $userName, PDO::PARAM_STR);
                $sqlQuery->bindParam(2, $userEmail, PDO::PARAM_STR);
                $sqlQuery->bindParam(3, $userAvatar, PDO::PARAM_LOB);
                $sqlQuery->bindParam(4, $userID, PDO::PARAM_INT);
                $sqlQuery->execute();

                if ($sqlQuery->execute()) {


                    $_SESSION["userName"] = $userName;
                    $_SESSION["userAvatar"] = $userAvatar;
                }

                $_SESSION['toast'] = '<div class="notificacao--toast ativo">
                                <div class="notificacao--conteudo">
                                    <i data-feather="check" aria-hidden="true"></i>
                                    <div class="mensagem">
                                        <span class="titulo">Sucesso!</span>
                                        <span>Perfil atualizado com sucesso.</span>
                                    </div>
                                </div>
                                    <i data-feather="x"></i>
                               </div>';

                header('Location: /dashboard');
                return;

            } catch (PDOException $e) {
                echo "Erro:" . $e->getMessage();
                die();
            }

        }
    }
}