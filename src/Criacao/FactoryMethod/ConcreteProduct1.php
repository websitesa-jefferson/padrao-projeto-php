<?php

namespace App\Criacao\FactoryMethod;

/**
 * Os Produtos Concretos fornecem várias implementações da interface do Produto.
 */
class ConcreteProduct1 implements Product
{
    public function operation(): string
    {
        return "{Resultado do ConcreteProduct1}";
    }
}
