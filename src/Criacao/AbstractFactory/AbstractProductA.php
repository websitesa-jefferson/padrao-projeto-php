<?php

namespace App\Criacao\AbstractFactory;

/**
 * Cada produto distinto de uma família de produtos deve ter uma interface básica.
 * variantes do produto devem implementar esta interface.
 */
interface AbstractProductA
{
    public function usefulFunctionA(): string;
}
