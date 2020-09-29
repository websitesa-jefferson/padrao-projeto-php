<?php

namespace App\Criacao\Builder;

/**
 * O Diretor é responsável apenas por executar as etapas de construção em uma sequência particular.
 * É útil ao produzir produtos de acordo com um pedido ou configuração específica.
 * A rigor, a classe Director é opcional, pois o cliente pode controlar os construtores diretamente.
 */
class Director
{
    /**
     * @var Builder
     */
    private $builder;

    /**
     * O Director funciona com qualquer instância do construtor que o código do cliente passa para ele.
     * Desta forma, o código do cliente pode alterar o tipo final do produto recém-montado.
     */
    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    /**
     * O Diretor pode construir várias variações de produto usando as mesmas etapas de construção.
     */
    public function buildMinimalViableProduct(): void
    {
        $this->builder->producePartA();
    }

    public function buildFullFeaturedProduct(): void
    {
        $this->builder->producePartA();
        $this->builder->producePartB();
        $this->builder->producePartC();
    }
}
