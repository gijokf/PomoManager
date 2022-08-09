<?php

namespace PomoManager\Controller\User;

use PomoManager\Controller\controllersInterface;

class userLogoutController implements controllersInterface
{

    public function processaRequisicao(): void
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /login");
    }
}