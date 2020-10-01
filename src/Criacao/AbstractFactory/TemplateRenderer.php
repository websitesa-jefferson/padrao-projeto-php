<?php

namespace App\Criacao\AbstractFactory;

/**
 * O renderizador é responsável por converter uma string de template no código HTML real.
 * Cada renderizador se comporta de maneira diferente e espera que seu próprio tipo de string de modelo seja passado a ele.
 * Modelos de cozimento com a fábrica permitem que você passe tipos adequados de modelos para renderizações adequadas.
 */
interface TemplateRenderer
{
    public function render(string $templateString, array $arguments = []): string;
}
