<?php

use App\Criacao\Builder\Director;
use App\Criacao\Builder\ConcreteBuilder1;

require __DIR__.'/../../bootstrap.php';

/**
 * O código do cliente cria um objeto construtor, passo-a-passo para o diretor e então inicia o processo de construção.
 * O resultado final é recuperado do objeto construtor.
 */
function clientCode(Director $director)
{
    $builder = new ConcreteBuilder1();
    $director->setBuilder($builder);

    echo "Produto básico padrão:<br>";
    $director->buildMinimalViableProduct();
    $builder->getProduct()->listParts();

    echo "Produto padrão completo:<br>";
    $director->buildFullFeaturedProduct();
    $builder->getProduct()->listParts();

    // Lembre-se de que o padrão Builder pode ser usado sem uma classe Director.
    echo "Custom product:<br>";
    $builder->producePartA();
    $builder->producePartC();
    $builder->getProduct()->listParts();
}

$director = new Director();
clientCode($director);
