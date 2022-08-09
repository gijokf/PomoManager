<?php

namespace PomoManager\Controller;

use PomoConfig\connection\Connect;
use PomoManager\Helper\RenderHtmlTrait;

class dashboardController extends Connect implements controllersInterface
{
    use RenderHtmlTrait;

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('dashboard.php');
    }
}