<?php

namespace PomoManager\Controller;

use PomoManager\Helper\RenderHtmlTrait;

class loginFormController implements controllersInterface
{
    use RenderHtmlTrait;

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('login.php');
    }
}