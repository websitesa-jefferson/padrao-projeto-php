<?php

namespace App\Criacao\AbstractFactory;

/**
 * Produtos concretos são criados por fábricas concretas correspondentes.
 */
class ConcreteProductA1 implements AbstractProductA
{
    public function usefulFunctionA(): string
    {
        return "O resultado do produto A1.";
    }
}
