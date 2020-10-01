## PADRÃO FACTORY METHOD

##### Objetivo
Definir uma interface para criação de objeto que permita que as subclasses decidam qual classe será instanciada.

##### Contexto
Sistemas que manipulam um número variável de tipos de objetos podem utilizar este modelo devido à sua flexibilidade.
Permite que a aplicação final implemente o suporte aos objetos necessários.

##### Estrutura
Product: define as interfaces dos objetos criados por este padrão;
ConcreteProduct: implementa a interface do produto;
Creator: declara o método que retorna o objeto do tipo esperado;
ConcreteCreator: sobreescreve o método original para retornar uma instancia do objeto esperado, ou seja, o ConcreteProduct.

##### Aplicabilidade
- A aplicação não pode antecipar o tipos de objetos que devem se criados;
- Uma classe espera que suas subclasses especifiquem o tipo de objeto a ser criado;
- As classes delegam a responsabilidade a uma das subclasses e você quer identificar de qual subclasses advém o conhecimento.

~~~~
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

/**
 * Os criadores concretos substituem o método de fábrica para alterar o tipo do produto resultante.
 */
class ConcreteCreator1 extends Creator
{
    /**
     * Observe que a assinatura do método ainda usa o tipo de produto abstrato, mesmo que o produto concreto seja
     * realmente retornado do método.
     * Desta forma, o Criador pode permanecer independente de classes de produtos concretas.
     */
    public function factoryMethod(): Product
    {
        return new ConcreteProduct1();
    }
}

class ConcreteCreator2 extends Creator
{
    public function factoryMethod(): Product
    {
        return new ConcreteProduct2();
    }
}

/**
 * A interface do produto declara as operações que todos os produtos concretos devem implementar.
 */
interface Product
{
    public function operation(): string;
}

/**
 * Os Produtos Concretos fornecem várias implementações da interface do Produto.
 */
class ConcreteProduct1 implements Product
{
    public function operation(): string
    {
        return "{Resultado do ConcreteProduct1}";
    }
}

class ConcreteProduct2 implements Product
{
    public function operation(): string
    {
        return "{Resultado do ConcreteProduct2}";
    }
}

/**
 * O código do cliente funciona com uma instância de um criador concreto, embora por meio de sua interface base.
 * Contanto que o cliente continue trabalhando com o criador por meio da interface base, você pode passá-lo para
 * qualquer subclasse do criador.
 */
function clientCode(Creator $creator)
{
    // ...
    echo "Cliente: Não conhece a classe do criador, mas ainda funciona.<br>". $creator->someOperation();
    // ...
}

/**
 * O aplicativo escolhe o tipo de criador, dependendo da configuração ou ambiente.
 */
echo "App: Lançado com o ConcreteCreator1.<br>";
clientCode(new ConcreteCreator1());
echo "<br><br>";

echo "App: Lançado com o ConcreteCreator2.<br>";
clientCode(new ConcreteCreator2());
~~~~
Fonte: https://refactoring.guru/pt-br/design-patterns/factory-method/php/example#lang-features
