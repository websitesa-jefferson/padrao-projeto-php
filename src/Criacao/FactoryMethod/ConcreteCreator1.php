<?php

namespace App\Criacao\FactoryMethod;

/**
 * Os criadores concretos substituem o método de fábrica para alterar o tipo do produto resultante.
 */
class ConcreteCreator1 extends Creator
{
    /**
     * Observe que a assinatura do método ainda usa o tipo de produto abstrato, mesmo que o produto concreto seja
     * realmente retornado do método.
     * Desta forma, o Criador pode permanecer independente de classes de produtos concretas.
     */
    public function factoryMethod(): Product
    {
        return new ConcreteProduct1();
    }
}
