<?php

namespace App\Estrutura\Adapter;

/**
 * O Adaptee contém alguns comportamentos úteis, mas sua interface é incompatível com o código do cliente existente.
 * O Adaptee precisa de alguma adaptação antes que o código do cliente possa usá-lo.
 */
class Adaptee
{
    public function specificRequest(): string
    {
        return ".eetpadA od laicepse otnematropmoC";
    }
}
