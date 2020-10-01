<?php

namespace App\Criacao\FactoryMethod;

/**
 * A interface do produto declara as operações que todos os produtos concretos devem implementar.
 */
interface Product
{
    public function operation(): string;
}
