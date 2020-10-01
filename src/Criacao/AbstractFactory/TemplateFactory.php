<?php

namespace App\Criacao\AbstractFactory;

/**
 * A interface Abstract Factory declara métodos de criação para cada tipo de produto distinto.
 */
interface TemplateFactory
{
    public function createTitleTemplate(): TitleTemplate;

    public function createPageTemplate(): PageTemplate;

    public function getRenderer(): TemplateRenderer;
}
