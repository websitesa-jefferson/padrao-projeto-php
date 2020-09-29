## PADRÃO SINGLETON

##### Objetivo
Separar a construção de um objeto complexo da sua representação, de modo que o mesmo processo de construção possa criar diferentes representações.

##### Contexto
Sistema capaz de gerar ações indeterminadas para uma única aplicação, utilizam a estrutura modular deste padrão para permitir a implementação do soluções alternativas que utilizem de uma fonte única.

##### Estrutura
Builder: especifica uma interface abstrata para a criação de módulos do sistema;
ConcreteBuilder: cria e executa móudulos através da interface Builder, controla a representação criada e fornece um meio obtenção dos resultados;
Director: constroi o objeto principal utilizando a interface Builder;
Product: prepresenta um módulo alternativo que inclui interfaces para geração do resultado final;

##### Aplicabilidade
- O processo e construção deve permitir diferentes representações para o objeto contruído.

~~~~
/**
 * A interface Builder especifica métodos para criar as diferentes partes dos objetos Product.
 */
interface Builder
{
    public function producePartA(): void;

    public function producePartB(): void;

    public function producePartC(): void;
}

/**
 * As classes Concrete Builder seguem a interface Builder e fornecem implementações específicas das etapas de construção.
 * Seu programa pode ter N variações de Builders, implementadas de forma diferente.
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

/**
 * O Diretor é responsável apenas por executar as etapas de construção em uma sequência particular.
 * É útil ao produzir produtos de acordo com um pedido ou configuração específica.
 * A rigor, a classe Director é opcional, pois o cliente pode controlar os construtores diretamente.
 */
class Director
{
    /**
     * @var Builder
     */
    private $builder;

    /**
     * O Director funciona com qualquer instância do construtor que o código do cliente passa para ele.
     * Desta forma, o código do cliente pode alterar o tipo final do produto recém-montado.
     */
    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    /**
     * O Diretor pode construir várias variações de produto usando as mesmas etapas de construção.
     */
    public function buildMinimalViableProduct(): void
    {
        $this->builder->producePartA();
    }

    public function buildFullFeaturedProduct(): void
    {
        $this->builder->producePartA();
        $this->builder->producePartB();
        $this->builder->producePartC();
    }
}

/**
 * O código do cliente cria um objeto construtor, passo-a-passo para o diretor e então inicia o processo de construção.
 * O resultado final é recuperado do objeto construtor.
 */
function clientCode(Director $director)
{
    $builder = new ConcreteBuilder1();
    $director->setBuilder($builder);

    echo "Produto básico padrão:<br>";
    $director->buildMinimalViableProduct();
    $builder->getProduct()->listParts();

    echo "Produto padrão completo:<br>";
    $director->buildFullFeaturedProduct();
    $builder->getProduct()->listParts();

    // Lembre-se de que o padrão Builder pode ser usado sem uma classe Director.
    echo "Custom product:<br>";
    $builder->producePartA();
    $builder->producePartC();
    $builder->getProduct()->listParts();
}

$director = new Director();
clientCode($director);

Resultado da execução:
Produto básico padrão:
Peças do produto: PartA1

Produto padrão completo:
Peças do produto: PartA1, PartB1, PartC1

Custom product:
Peças do produto: PartA1, PartC1
~~~~

Fonte: https://refactoring.guru/pt-br/design-patterns/builder/php/example#lang-features
