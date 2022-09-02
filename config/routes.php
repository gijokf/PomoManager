<?php

namespace PomoConfig;

use PomoManager\Controller\dashboardController;
use PomoManager\Controller\loginFormController;
use PomoManager\Controller\registerFormController;
use PomoManager\Controller\Task\taskAddController;
use PomoManager\Controller\User\userLoginController;
use PomoManager\Controller\User\userLogoutController;
use PomoManager\Controller\User\userRegisterController;

return [
    '/' => loginFormController::class,
    '/register' => registerFormController::class,
    '/register-user' => userRegisterController::class,
    '/dashboard' => dashboardController::class,
    '/realize-login' => userLoginController::class,
    '/logout' => userLogoutController::class,
    '/add-task' => taskAddController::class,
];