<?php

namespace App\Estrutura\Adapter;

/**
 * O Adaptador torna a interface do Adaptee compatível com a interface do Destino.
 */
class Adapter extends Target
{
    private $adaptee;

    public function __construct(Adaptee $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function request(): string
    {
        return "Adaptador: (TRADUZIDO) " . strrev($this->adaptee->specificRequest());
    }
}
