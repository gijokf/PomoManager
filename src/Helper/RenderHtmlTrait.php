<?php

namespace PomoManager\Helper;

trait RenderHtmlTrait
{
    public function renderizaHtml(string $caminhoTemplate): string
    {
//        extract($dados);
        ob_start();
        require __DIR__ . '/../../View/' . $caminhoTemplate;
        $html = ob_get_clean();

        return $html;
    }
}