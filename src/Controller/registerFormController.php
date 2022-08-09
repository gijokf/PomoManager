<?php

namespace PomoManager\Controller;

use PomoManager\Helper\RenderHtmlTrait;

class registerFormController implements controllersInterface
{
    use RenderHtmlTrait;

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('register.php');
    }
}