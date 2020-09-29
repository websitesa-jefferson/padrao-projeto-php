<?php

namespace App\Criacao\AbstractFactory;

/**
 * A interface Abstract Factory declara um conjunto de métodos que retornam diferentes produtos abstratos.
 * Esses produtos são chamados de família e são relacionado por um tema ou conceito de alto nível.
 * Produtos de uma família geralmente são capazes de colaborar entre si.
 * Uma família de produtos pode ter N variantes, porém produtos de uma variante são incompatíveis com produtos de outro.
 */
interface AbstractFactory
{
    public function createProductA(): AbstractProductA;

    public function createProductB(): AbstractProductB;
}
