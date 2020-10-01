<?php

namespace App\Criacao\FactoryMethod;

/**
 * A classe Creator declara o método de fábrica que deve retornar um objeto de uma classe Product.
 * As subclasses do Criador geralmente fornecem a implementação desse método.
 */
abstract class Creator
{
    /**
     * Observe que o Criador também pode fornecer alguma implementação padrão do método de fábrica.
     */
    abstract public function factoryMethod(): Product;

    /**
     * Observe também que, apesar do nome, a principal responsabilidade do Criador não é criar produtos.
     * Normalmente, ele contém alguma lógica de negócios central que depende de objetos Produto, retornados pelo método de fábrica.
     * As subclasses podem alterar indiretamente essa lógica de negócios, substituindo o método de fábrica e retornando um diferente
     * tipo de produto dele.
     */
    public function someOperation(): string
    {
        // Chame o método de fábrica para criar um objeto Produto.
        $product = $this->factoryMethod();
        // Now, use the product.
        $result = "Criador: o mesmo código do criador acabou de trabalhar com ". $product->operation();

        return $result;
    }
}
