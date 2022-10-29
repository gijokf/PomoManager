<?php

namespace PomoManager\Controller;

use PomoManager\Helper\RenderHtmlTrait;

class taskListViewController implements controllersInterface
{
    use RenderHtmlTrait;

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('list-tasks.php');
    }
}