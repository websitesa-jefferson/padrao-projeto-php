<?php

namespace App\Criacao\AbstractFactory;

/**
 * Este produto concreto fornece modelos de título de página Twig.
 */
class TwigTitleTemplate implements TitleTemplate
{
    public function getTemplateString(): string
    {
        return "<h1>{{ title }}</h1>";
    }
}
