<?php

namespace App\Criacao\AbstractFactory;

/**
 * Este é outro tipo de produto abstrato, que descreve modelos de páginas inteiras.
 */
interface PageTemplate
{
    public function getTemplateString(): string;
}
