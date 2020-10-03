<?php

namespace App\Estrutura\Bridge;

/**
 * A abstração.
 */
abstract class Page
{
    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * A abstração geralmente é inicializada com um dos objetos de implementação.
     */
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * O padrão Bridge permite substituir o objeto Implementation anexado dinamicamente.
     */
    public function changeRenderer(Renderer $renderer): void
    {
        $this->renderer = $renderer;
    }

    /**
     * O comportamento de "visualização" permanece abstrato, pois só pode ser fornecido por classes de Abstração Concreta.
     */
    abstract public function view(): string;
}
