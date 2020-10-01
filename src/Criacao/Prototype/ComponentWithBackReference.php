<?php

namespace App\Criacao\Prototype;

class ComponentWithBackReference
{
    public $prototype;

    /**
     * Observe que o construtor não será executado durante a clonagem.
     * Se você tem uma lógica complexa dentro do construtor, você pode precisar executá-la no método `__clone` também.
     */
    public function __construct(Prototype $prototype)
    {
        $this->prototype = $prototype;
    }
}
