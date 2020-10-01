<?php

namespace App\Criacao\Prototype;

/**
 * A classe de exemplo que possui capacidade de clonagem.
 * Veremos como os valores de campo com diferentes tipos serão clonados.
 */
class Prototype
{
    public $primitive;
    public $component;
    public $circularReference;

    /**
     * PHP possui suporte embutido para clonagem.
     * Você pode `clonar` um objeto sem definir quaisquer métodos especiais, desde que possui campos de tipos primitivos.
     * Os campos que contêm objetos retêm suas referências em um objeto clonado.
     * Portanto, em alguns casos, você pode querer clonar esses objetos referenciados também.
     * Você pode fazer isso em um método especial `__clone()`.
     */
    public function __clone()
    {
        $this->component = clone $this->component;

        // A clonagem de um objeto que possui um objeto aninhado com referência anterior requer tratamento especial.
        // Depois que a clonagem for concluída, o objeto aninhado deve apontar para o objeto clonado, em vez do original
        // objeto.
        $this->circularReference = clone $this->circularReference;
        $this->circularReference->prototype = $this;
    }
}
