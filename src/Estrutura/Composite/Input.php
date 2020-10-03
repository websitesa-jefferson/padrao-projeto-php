<?php

namespace App\Estrutura\Composite;

/**
 * Este é um componente Folha. Como todas as Folhas, não pode ter filhos.
 */
class Input extends FormElement
{
    private $type;

    public function __construct(string $name, string $title, string $type)
    {
        parent::__construct($name, $title);
        $this->type = $type;
    }

    /**
     * Since Leaf components don't have any children that may handle the bulk of the work for them, usually it
     * is the Leaves who do the most of the heavy-lifting within the Composite pattern.
     */
    public function render(): string
    {
        return "<label for=\"{$this->name}\">{$this->title}</label><br>" .
            "<input name=\"{$this->name}\" type=\"{$this->type}\" value=\"{$this->data}\"><br>";
    }
}
