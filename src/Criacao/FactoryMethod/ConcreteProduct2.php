<?php

namespace App\Criacao\FactoryMethod;

class ConcreteProduct2 implements Product
{
    public function operation(): string
    {
        return "{Resultado do ConcreteProduct2}";
    }
}
