<?php

use App\Criacao\AbstractFactory\AbstractFactory;
use App\Criacao\AbstractFactory\ConcreteFactory1;
use App\Criacao\AbstractFactory\ConcreteFactory2;

require __DIR__.'/../../bootstrap.php';

/**
 * O código do cliente funciona com fábricas e produtos apenas por meio de resumo.
 * tipos: AbstractFactory e AbstractProduct.
 * Isso permite que você passe por qualquer fábrica ou subclasse do produto para o código do cliente sem quebrá-lo.
 */
function clientCode(AbstractFactory $factory)
{
    $productA = $factory->createProductA();
    $productB = $factory->createProductB();

    echo $productB->usefulFunctionB();
    echo "<br>";
    echo $productB->anotherUsefulFunctionB($productA);
}

/**
 * O código do cliente pode funcionar com qualquer classe de fábrica concreta.
 */
echo "Cliente: Testando o código do cliente com o primeiro tipo de fábrica:";
echo "<br>";
clientCode(new ConcreteFactory1());
echo "<br><br>";
echo "Cliente: Testando o mesmo código de cliente com o segundo tipo de fábrica:";
echo "<br>";
clientCode(new ConcreteFactory2());
