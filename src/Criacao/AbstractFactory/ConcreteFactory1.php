<?php

namespace App\Criacao\AbstractFactory;

/**
 * As fábricas concretas produzem uma família de produtos que pertencem a uma única variante.
 * A fábrica garante que os produtos resultantes são compatíveis.
 * Nota que as assinaturas dos métodos da Fábrica da Concreta retornam um produto abstrato,
 * enquanto dentro do método um produto concreto é instanciado.
 */
class ConcreteFactory1 implements AbstractFactory
{
    public function createProductA(): AbstractProductA
    {
        return new ConcreteProductA1();
    }

    public function createProductB(): AbstractProductB
    {
        return new ConcreteProductB1();
    }
}
