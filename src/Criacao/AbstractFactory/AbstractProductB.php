<?php

namespace App\Criacao\AbstractFactory;

/**
 * Esta é a interface básica de outro produto.
 * Todos os produtos podem interagir entre si, mas a interação adequada só é possível entre produtos de a mesma variante
 * concreta.
 */
interface AbstractProductB
{
    /**
     * O produto B é capaz de fazer suas próprias coisas ...
     */
    public function usefulFunctionB(): string;

    /**
     * ... mas também pode colaborar com o ProdutoA.
     *
     * A Abstract Factory certifica-se de que todos os produtos que cria são da mesma variante e, portanto, compatível.
     */
    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string;
}
