<?php

namespace App\Criacao\Builder;

/**
 * A interface Builder especifica métodos para criar as diferentes partes dos objetos Product.
 */
interface Builder
{
    public function producePartA(): void;

    public function producePartB(): void;

    public function producePartC(): void;
}
