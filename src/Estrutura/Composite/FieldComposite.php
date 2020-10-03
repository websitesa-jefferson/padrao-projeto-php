<?php

namespace App\Estrutura\Composite;

/**
 * A classe base Composite implementa a infraestrutura para gerenciar objetos filhos, reutilizada por todos os
 * Concrete Composites.
 */
abstract class FieldComposite extends FormElement
{
    /**
     * @var FormElement[]
     */
    protected $fields = [];

    /**
     * Os métodos para adicionar / remover subobjetos.
     */
    public function add(FormElement $field): void
    {
        $name = $field->getName();
        $this->fields[$name] = $field;
    }

    public function remove(FormElement $component): void
    {
        $this->fields = array_filter($this->fields, function ($child) use ($component) {
            return $child != $component;
        });
    }

    /**
     * Enquanto o método da Folha apenas faz o trabalho, o método do Composite quase sempre tem que pegar seus subobjetos
     * em consideração.
     * Nesse caso, o composto pode aceitar dados estruturados.
     * @param array $ data
     */
    public function setData($data): void
    {
        foreach ($this->fields as $name => $field) {
            if (isset($data[$name])) {
                $field->setData($data[$name]);
            }
        }
    }

    /**
     * A mesma lógica se aplica ao getter. Ele retorna os dados estruturados do próprio composto (se houver) e todos
     * os dados dos filhos.
     */
    public function getData(): array
    {
        $data = [];

        foreach ($this->fields as $name => $field) {
            $data[$name] = $field->getData();
        }

        return $data;
    }

    /**
     * A implementação básica da renderização do Composite simplesmente combina os resultados de todos os filhos.
     * Concrete Composites será capaz de reutilizar esta implementação em suas implementações de renderização real.
     */
    public function render(): string
    {
        $output = "";

        foreach ($this->fields as $name => $field) {
            $output .= $field->render();
        }

        return $output;
    }
}
