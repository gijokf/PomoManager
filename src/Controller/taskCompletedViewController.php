<?php

namespace PomoManager\Controller;

use PomoManager\Helper\RenderHtmlTrait;

class taskCompletedViewController implements controllersInterface
{
    use RenderHtmlTrait;

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('list-completed.php');
    }
}