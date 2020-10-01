<?php

namespace App\Criacao\AbstractFactory;

/**
 * O renderizador para modelos Twig.
 */
class TwigRenderer implements TemplateRenderer
{
    public function render(string $templateString, array $arguments = []): string
    {
        return \Twig::render($templateString, $arguments);
    }
}
