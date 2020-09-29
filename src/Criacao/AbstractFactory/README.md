## PADRÃO ABSTRACT FACTORY

##### Objetivo
Fornecer uma interface para criação de grupos de objetos relacionados aos dependentes sem especificar suas classes concretas.

##### Contexto
Produtos portáveis utilizam o conceito abstrato deste padrão para desvincular código fundamental da aplicação de recursos que são dependentes da plataforma.

##### Estrutura
- AbstractFactory: declara uma interface para operações que criam objetos abstratos;
- ConcreteFactory: implementa operações específicas para criar objetos concretos;
- AbstractProduct: declara uma interface para cada tipo de objeto;
- ConcreteProduct: implementa uma interface de AbstractProduct para definir um objeto que pode ser criado por sua ConcreteFactory correspondente;
- Client: utiliza as interfaces declaradas pelo AbstractFactory e AbstractProduct sem se preocupar com as implementações concretas.

##### Aplicabilidade
- Um sistema deve ser independente do modo como seus objetos são criados, compostos e representados;
- Um sistema deve ser configurado com vários grupos distintos de objetos;
- Alguns objetos relacionados formam projetados para serem utilizados em conjunto, e você precisa impor essa restrição;
- Você quer fornecer uma biblioteca de classes e pretende revelar apenas suas interfaces, não suas implementações.

~~~~
/**
 * A interface Abstract Factory declara um conjunto de métodos que retornam diferentes produtos abstratos.
 * Esses produtos são chamados de família e são relacionado por um tema ou conceito de alto nível.
 * Produtos de uma família geralmente são capazes de colaborar entre si.
 * Uma família de produtos pode ter N variantes, porém produtos de uma variante são incompatíveis com produtos de outro.
 */
interface AbstractFactory
{
    public function createProductA(): AbstractProductA;

    public function createProductB(): AbstractProductB;
}

/**
 * As fábricas concretas produzem uma família de produtos que pertencem a uma única variante.
 * A fábrica garante que os produtos resultantes são compatíveis.
 * Note que as assinaturas dos métodos da Fábrica da Concreta retornam um produto abstrato, enquanto dentro do método
 * um produto concreto é instanciado.
 */
class ConcreteFactory1 implements AbstractFactory
{
    public function createProductA(): AbstractProductA
    {
        return new ConcreteProductA1();
    }

    public function createProductB(): AbstractProductB
    {
        return new ConcreteProductB1();
    }
}

/**
 * Cada fábrica de concreto possui uma variante de produto correspondente.
 */
class ConcreteFactory2 implements AbstractFactory
{
    public function createProductA(): AbstractProductA
    {
        return new ConcreteProductA2();
    }

    public function createProductB(): AbstractProductB
    {
        return new ConcreteProductB2();
    }
}

/**
 * Cada produto distinto de uma família de produtos deve ter uma interface básica.
 * variantes do produto devem implementar esta interface.
 */
interface AbstractProductA
{
    public function usefulFunctionA(): string;
}

/**
 * Produtos concretos são criados por fábricas concretas correspondentes.
 */
class ConcreteProductA1 implements AbstractProductA
{
    public function usefulFunctionA(): string
    {
        return "O resultado do produto A1.";
    }
}

/**
 * Produtos concretos são criados por fábricas concretas correspondentes.
 */
class ConcreteProductA2 implements AbstractProductA
{
    public function usefulFunctionA(): string
    {
        return "O resultado do produto A2.";
    }
}

/**
 * Esta é a interface básica de outro produto.
 * Todos os produtos podem interagir entre si, mas a interação adequada só é possível entre produtos de a mesma variante
 * concreta.
 */
interface AbstractProductB
{
    /**
     * O produto B é capaz de fazer suas próprias coisas ...
     */
    public function usefulFunctionB(): string;

    /**
     * ... mas também pode colaborar com o ProdutoA.
     *
     * A Abstract Factory certifica-se de que todos os produtos que cria são da mesma variante e, portanto, compatível.
     */
    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string;
}

/**
 * Produtos concretos são criados por fábricas concretas correspondentes.
 */
class ConcreteProductB1 implements AbstractProductB
{
    public function usefulFunctionB(): string
    {
        return "O resultado do produto B1.";
    }

    /**
     * A variante, Produto B1, só funciona corretamente com a variante, Produto A1.
     * No entanto, ele aceita qualquer instância de AbstractProductA como um argumento.
     */
    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string
    {
        $result = $collaborator->usefulFunctionA();

        return "O resultado do B1 colaborando com o ({$result})";
    }
}

class ConcreteProductB2 implements AbstractProductB
{
    public function usefulFunctionB(): string
    {
        return "O resultado do produto B2.";
    }

    /**
     * A variante, Produto B2, só funciona corretamente com a variante, Produto A2.
     * No entanto, ele aceita qualquer instância de AbstractProductA como um argumento.
     */
    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string
    {
        $result = $collaborator->usefulFunctionA();

        return "O resultado do B2 colaborando com o ({$result})";
    }
}

/**
 * O código do cliente funciona com fábricas e produtos apenas por meio de resumo.
 * tipos: AbstractFactory e AbstractProduct.
 * Isso permite que você passe por qualquer fábrica ou subclasse do produto para o código do cliente sem quebrá-lo.
 */
function clientCode(AbstractFactory $factory)
{
    $productA = $factory->createProductA();
    $productB = $factory->createProductB();

    echo $productB->usefulFunctionB();
    echo "<br>";
    echo $productB->anotherUsefulFunctionB($productA);
}

/**
 * O código do cliente pode funcionar com qualquer classe de fábrica concreta.
 */
echo "Cliente: Testando o código do cliente com o primeiro tipo de fábrica:";
echo "<br>";
clientCode(new ConcreteFactory1());
echo "<br><br>";
echo "Cliente: Testando o mesmo código de cliente com o segundo tipo de fábrica:";
echo "<br>";
clientCode(new ConcreteFactory2());

Resultado da execução:
Cliente: Testando o código do cliente com o primeiro tipo de fábrica:
O resultado do produto B1.
O resultado do B1 colaborando com o (O resultado do produto A1.)

Cliente: Testando o mesmo código de cliente com o segundo tipo de fábrica:
O resultado do produto B2.
O resultado do B2 colaborando com o (O resultado do produto A2.)
~~~~

Fonte: https://refactoring.guru/pt-br/design-patterns/abstract-factory/php/example#lang-features
