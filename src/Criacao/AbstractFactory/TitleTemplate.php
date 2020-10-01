<?php

namespace App\Criacao\AbstractFactory;

/**
 * Cada tipo de produto distinto deve ter uma interface separada.
 * Todas as variantes do produto devem seguir a mesma interface.
 * Por exemplo, esta interface de Produto Abstrato descreve o comportamento dos modelos de título de página.
 */
interface TitleTemplate
{
    public function getTemplateString(): string;
}
