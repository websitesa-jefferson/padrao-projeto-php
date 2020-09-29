<?php

namespace App\Criacao\Builder;

/**
 * Faz sentido usar o padrão Builder apenas quando seus produtos são bastante complexos e exigem configuração extensiva.
 *
 * Ao contrário de outros padrões de criação, diferentes construtores concretos podem produzir produtos não relacionados.
 * Em outras palavras, os resultados de vários construtores nem sempre seguem a mesma interface.
 */
class Product1
{
    public $parts = [];

    public function listParts(): void
    {
        echo "Peças do produto: " . implode(', ', $this->parts) . "<br><br>";
    }
}
