## PADRÃO PROTOTYPE

##### Objetivo
Espeficiar tipos de objetos através de uma instância-protótipo e criar novos objetos através da cópia dessa instancia.

##### Contexto
Permite a implementação de variações de uma classe sem o uso de subclasses, através da criação de instâncias-protótipo com características específicas pré-definidas.

##### Estrutura
Prototype: declara uma interface para autoclonagem;
ConcretePrototype: implementa a operação da autoclonagem;
Cliente: cria objetos solicitando um clone a protótipo.

##### Aplicabilidade
- As classes a serem instanciadas são especificadas em tempo de execução;
- Quando a instância de uma classe pode ter diferentes estados;

~~~~
/**
 * A classe de exemplo que possui capacidade de clonagem.
 * Veremos como os valores de campo com diferentes tipos serão clonados.
 */
class Prototype
{
    public $primitive;
    public $component;
    public $circularReference;

    /**
     * PHP possui suporte embutido para clonagem. Você pode `clonar` um objeto sem definir quaisquer métodos especiais,
     * desde que possui campos de tipos primitivos.
     * Os campos que contêm objetos retêm suas referências em um objeto clonado.
     * Portanto, em alguns casos, você pode querer clonar esses objetos referenciados também.
     * Você pode fazer isso em um método especial `__clone()`.
     */
    public function __clone()
    {
        $this->component = clone $this->component;

        // A clonagem de um objeto que possui um objeto aninhado com referência anterior requer tratamento especial.
        // Depois que a clonagem for concluída, o objeto aninhado deve apontar para o objeto clonado, em vez do original
        // objeto.
        $this->circularReference = clone $this->circularReference;
        $this->circularReference->prototype = $this;
    }
}

class ComponentWithBackReference
{
    public $prototype;

    /**
     * Observe que o construtor não será executado durante a clonagem.
     * Se você tem uma lógica complexa dentro do construtor, você pode precisar executá-la no método `__clone` também.
     */
    public function __construct(Prototype $prototype)
    {
        $this->prototype = $prototype;
    }
}

function clientCode()
{
    $p1 = new Prototype();
    $p1->primitive = 245;
    $p1->component = new \DateTime();
    $p1->circularReference = new ComponentWithBackReference($p1);

    $p2 = clone $p1;
    if ($p1->primitive === $p2->primitive) {
        echo "Os valores de campo primitivos foram transportados para um clone.<br>";
    } else {
        echo "Os valores do campo primitivo não foram copiados.<br>";
    }
    if ($p1->component === $p2->component) {
        echo "O componente simples não foi clonado.<br>";
    } else {
        echo "O componente simples foi clonado.<br>";
    }

    if ($p1->circularReference === $p2->circularReference) {
        echo "O componente com referência anterior não foi clonado.<br>";
    } else {
        echo "O componente com referência anterior foi clonado.<br>";
    }

    if ($p1->circularReference->prototype === $p2->circularReference->prototype) {
        echo "O componente com referência anterior está vinculado ao objeto original.<br>";
    } else {
        echo "O componente com referência anterior está vinculado ao clone.<br>";
    }
}

clientCode();

~~~~
Fonte: https://refactoring.guru/pt-br/design-patterns/prototype/php/example#lang-features
