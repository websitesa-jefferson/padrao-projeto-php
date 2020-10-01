<?php

namespace App\Estrutura\Adapter;

/**
 * O destino define a interface específica do domínio usada pelo código do cliente.
 */
class Target
{
    public function request(): string
    {
        return "Alvo: o comportamento do alvo padrão.";
    }
}
