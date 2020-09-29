<?php

namespace App\Criacao\AbstractFactory;

/**
 * Cada fábrica de concreto possui uma variante de produto correspondente.
 */
class ConcreteFactory2 implements AbstractFactory
{
    public function createProductA(): AbstractProductA
    {
        return new ConcreteProductA2();
    }

    public function createProductB(): AbstractProductB
    {
        return new ConcreteProductB2();
    }
}
