<?php

namespace App\Criacao\AbstractFactory;

/**
 * Produtos concretos são criados por fábricas concretas correspondentes.
 */
class ConcreteProductB1 implements AbstractProductB
{
    public function usefulFunctionB(): string
    {
        return "O resultado do produto B1.";
    }

    /**
     * A variante, Produto B1, só funciona corretamente com a variante, Produto A1.
     * No entanto, ele aceita qualquer instância de AbstractProductA como um argumento.
     */
    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string
    {
        $result = $collaborator->usefulFunctionA();

        return "O resultado do B1 colaborando com o ({$result})";
    }
}
