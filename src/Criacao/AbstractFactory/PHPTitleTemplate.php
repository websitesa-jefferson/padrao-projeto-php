<?php

namespace App\Criacao\AbstractFactory;

/**
 * E este produto concreto fornece modelos de título de página do PHPTemplate.
 */
class PHPTitleTemplate implements TitleTemplate
{
    public function getTemplateString(): string
    {
        return "<h1><?= \$title ?></h1>";
    }
}
