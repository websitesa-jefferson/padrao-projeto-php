<?php

namespace App\Estrutura\Composite;

/**
 * E também o é o elemento do formulário.
 */
class Form extends FieldComposite
{
    protected $url;

    public function __construct(string $name, string $title, string $url)
    {
        parent::__construct($name, $title);
        $this->url = $url;
    }

    public function render(): string
    {
        $output = parent::render();
        return "<form action=\"{$this->url}\"><br><h3>{$this->title}</h3><br>$output</form><br>";
    }
}
