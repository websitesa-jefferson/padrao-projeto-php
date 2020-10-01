<?php

use App\Criacao\FactoryMethod\Creator;
use App\Criacao\FactoryMethod\ConcreteCreator1;
use App\Criacao\FactoryMethod\ConcreteCreator2;

require __DIR__.'/../../bootstrap.php';

/**
 * O código do cliente funciona com uma instância de um criador concreto, embora por meio de sua interface base.
 * Contanto que o cliente continue trabalhando com o criador por meio da interface base, você pode passá-lo para
 * qualquer subclasse do criador.
 */
function clientCode(Creator $creator)
{
    // ...
    echo "Cliente: Não conhece a classe do criador, mas ainda funciona.<br>". $creator->someOperation();
    // ...
}

/**
 * O aplicativo escolhe o tipo de criador, dependendo da configuração ou ambiente.
 */
echo "App: Lançado com o ConcreteCreator1.<br>";
clientCode(new ConcreteCreator1());
echo "<br><br>";

echo "App: Lançado com o ConcreteCreator2.<br>";
clientCode(new ConcreteCreator2());
