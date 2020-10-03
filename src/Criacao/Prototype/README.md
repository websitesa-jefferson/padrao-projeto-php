## PADRÃO PROTOTYPE

##### Objetivo
Espeficiar tipos de objetos através de uma instância-protótipo e criar novos objetos através da cópia dessa instancia.

##### Contexto
Permite a implementação de variações de uma classe sem o uso de subclasses, através da criação de instâncias-protótipo com características específicas pré-definidas.

##### Estrutura
- Prototype: declara uma interface para autoclonagem;
- ConcretePrototype: implementa a operação da autoclonagem;
- Cliente: cria objetos solicitando um clone a protótipo.

##### Aplicabilidade
- As classes a serem instanciadas são especificadas em tempo de execução;
- Quando a instância de uma classe pode ter diferentes estados.

~~~~
/**
 * Prototype.
 */
class Page
{
    private $title;

    private $body;

    /**
     * @var Author
     */
    private $author;

    private $comments = [];

    /**
     * @var \DateTime
     */
    private $date;

    // +100 private fields.

    public function __construct(string $title, string $body, Author $author)
    {
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
        $this->author->addToPage($this);
        $this->date = new \DateTime();
    }

    public function addComment(string $comment): void
    {
        $this->comments[] = $comment;
    }

    /**
     * Você pode controlar quais dados deseja transportar para o objeto clonado.
     *
     * Por exemplo, quando uma página é clonada:
     * - Recebe um novo título "Cópia de ...".
     * - O autor da página permanece o mesmo.
     * - Portanto, deixamos a referência ao objeto existente ao adicionar a página clonada para a lista de páginas do autor.
     * - Não transportamos os comentários da página antiga.
     * - Também anexamos um novo objeto de data à página.
     */
    public function __clone()
    {
        $this->title = "Cópia de " . $this->title;
        $this->author->addToPage($this);
        $this->comments = [];
        $this->date = new \DateTime();
    }
}

class Author
{
    private $name;

    /**
     * @var Page[]
     */
    private $pages = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addToPage(Page $page): void
    {
        $this->pages[] = $page;
    }
}

/**
 * O código do cliente.
 */
function clientCode()
{
    echo '<pre>';
    $author = new Author("John Smith");
    $page = new Page("Dica do dia", "Mantenha a calma e continue.", $author);

    $page->addComment("Boa dica, obrigado!");

    $draft = clone $page;
    echo "Despejo do clone.<br>Observe que o autor agora está se referindo a dois objetos.<br><br>";
    print_r($draft);
}

clientCode();
~~~~
Fonte: https://refactoring.guru/pt-br/design-patterns/prototype/php/example#lang-features
