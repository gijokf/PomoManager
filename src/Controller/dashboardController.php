<?php

namespace PomoManager\Controller;

use PomoManager\Helper\RenderHtmlTrait;

class dashboardController implements controllersInterface
{
    use RenderHtmlTrait;

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('dashboard.php');
    }
}