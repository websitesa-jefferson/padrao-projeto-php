<?php

use App\Criacao\Prototype\Prototype;
use App\Criacao\Prototype\ComponentWithBackReference;

require __DIR__.'/../../bootstrap.php';

function clientCode()
{
    $p1 = new Prototype();
    $p1->primitive = 245;
    $p1->component = new \DateTime();
    $p1->circularReference = new ComponentWithBackReference($p1);

    $p2 = clone $p1;
    if ($p1->primitive === $p2->primitive) {
        echo "Os valores de campo primitivos foram transportados para um clone.<br>";
    } else {
        echo "Os valores do campo primitivo não foram copiados.<br>";
    }
    if ($p1->component === $p2->component) {
        echo "O componente simples não foi clonado.<br>";
    } else {
        echo "O componente simples foi clonado.<br>";
    }

    if ($p1->circularReference === $p2->circularReference) {
        echo "O componente com referência anterior não foi clonado.<br>";
    } else {
        echo "O componente com referência anterior foi clonado.<br>";
    }

    if ($p1->circularReference->prototype === $p2->circularReference->prototype) {
        echo "O componente com referência anterior está vinculado ao objeto original.<br>";
    } else {
        echo "O componente com referência anterior está vinculado ao clone.<br>";
    }
}

clientCode();
