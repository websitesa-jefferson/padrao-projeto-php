<?php

namespace App\Criacao\AbstractFactory;

/**
 * Cada fábrica concreta corresponde a uma variante (ou família) específica de produtos.
 * Esta fábrica concreta cria modelos Twig.
 */
class TwigTemplateFactory implements TemplateFactory
{
    public function createTitleTemplate(): TitleTemplate
    {
        return new TwigTitleTemplate();
    }

    public function createPageTemplate(): PageTemplate
    {
        return new TwigPageTemplate($this->createTitleTemplate());
    }

    public function getRenderer(): TemplateRenderer
    {
        return new TwigRenderer();
    }
}
