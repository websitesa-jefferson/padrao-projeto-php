<?php

namespace App\Estrutura\Composite;

/**
 * O elemento fieldset é um composto concreto.
 */
class Fieldset extends FieldComposite
{
    public function render(): string
    {
        // Observe como o resultado da renderização combinada de filhos é incorporado à tag fieldset.
        $output = parent::render();

        return "<fieldset><legend>{$this->title}</legend><br>$output</fieldset><br>";
    }
}
