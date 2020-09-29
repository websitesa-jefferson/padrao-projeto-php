<?php

namespace App\Criacao\Builder;

/**
 * As classes Concrete Builder seguem a interface Builder e fornecem implementações específicas das etapas de construção.
 * Seu programa pode ter vários variações de Builders, implementadas de forma diferente.
 */
class ConcreteBuilder1 implements Builder
{
    private $product;

    /**
     * Uma nova instância do construtor deve conter um objeto de produto em branco, que é usado na montagem posterior.
     */
    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->product = new Product1();
    }

    /**
     * Todas as etapas de produção funcionam com a mesma instância do produto.
     */
    public function producePartA(): void
    {
        $this->product->parts[] = "PartA1";
    }

    public function producePartB(): void
    {
        $this->product->parts[] = "PartB1";
    }

    public function producePartC(): void
    {
        $this->product->parts[] = "PartC1";
    }

    /**
     * Os construtores concretos devem fornecer seus próprios métodos para recuperação de resultados.
     * Isso porque vários tipos de construtores podem criar produtos totalmente diferentes que não seguem a mesma
     * interface.
     * Portanto, esses métodos não podem ser declarados na interface do Builder base (pelo menos em uma linguagem de
     * programação digitada estaticamente).
     * Observe que o PHP é um linguagem digitada dinamicamente e este método PODE estar na interface base.
     * No entanto, não o declararemos lá por uma questão de clareza.
     *
     * Normalmente, após retornar o resultado final ao cliente, uma instância do construtor deverá estar pronto para
     * iniciar a produção de outro produto.
     * É por isso é uma prática comum chamar o método de redefinição no final do Corpo do método `getProduct`.
     * No entanto, esse comportamento não é obrigatório e você pode fazer seus construtores esperarem por uma chamada
     * de reconfiguração explícita do código do cliente antes de descartar o resultado anterior.
     */
    public function getProduct(): Product1
    {
        $result = $this->product;
        $this->reset();

        return $result;
    }
}
