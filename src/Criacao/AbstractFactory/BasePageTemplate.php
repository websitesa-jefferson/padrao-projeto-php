<?php

namespace App\Criacao\AbstractFactory;

/**
 * O modelo de página usa o sub-modelo de título, portanto, temos que fornecer uma maneira de defini-lo no objeto de sub-modelo.
 * A fábrica de resumo vinculará o modelo de página a um modelo de título da mesma variante.
 */
abstract class BasePageTemplate implements PageTemplate
{
    protected $titleTemplate;

    public function __construct(TitleTemplate $titleTemplate)
    {
        $this->titleTemplate = $titleTemplate;
    }
}
