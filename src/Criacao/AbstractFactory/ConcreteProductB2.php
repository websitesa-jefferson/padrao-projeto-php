<?php

namespace App\Criacao\AbstractFactory;

class ConcreteProductB2 implements AbstractProductB
{
    public function usefulFunctionB(): string
    {
        return "O resultado do produto B2.";
    }

    /**
     * A variante, Produto B2, só funciona corretamente com a variante, Produto A2.
     * No entanto, ele aceita qualquer instância de AbstractProductA como um argumento.
     */
    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string
    {
        $result = $collaborator->usefulFunctionA();

        return "O resultado do B2 colaborando com o ({$result})";
    }
}
