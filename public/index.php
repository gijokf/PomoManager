<?php

require __DIR__ . '/../vendor/autoload.php';

use PomoManager\Controller\controllersInterface;

$caminho = $_SERVER['REQUEST_URI'];
$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($caminho, $rotas)) {
    echo "<pre>";
    print_r($GLOBALS);
    echo "</pre>";
    http_response_code(404);
    exit();
}

$classeControladora = $rotas[$caminho];
/** @var controllersInterface $controlador */
$controlador = new $classeControladora();
$controlador->processaRequisicao();