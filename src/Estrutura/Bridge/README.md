## PADRÃO BRIDGE

##### Objetivo
Permitir que você divida uma classe grande ou um conjunto de classes intimamente ligadas em duas hierarquias separadas—abstração e implementação—que podem ser desenvolvidas independentemente umas das outras.

##### Contexto
Este padrão é uma das formas de desacoplar objetos do sistema, porém este propôe a separação dos conceitos de implementação, ou seja, podemos ter uma classe que representa o conceito de algo e outra que especifica o código da classe.

##### Estrutura
- Abstração: fornece a lógica de controle de alto nível. Ela depende do objeto de implementação para fazer o verdadeiro trabalho de baixo nível;
- Implementação: declara a interface que é comum para todas as implementações concretas. Uma abstração só pode se comunicar com um objeto de implementação através de métodos que são declarados aqui.  
  A abstração pode listar os mesmos métodos que a implementação, mas geralmente a abstração declara alguns comportamentos complexos que dependem de uma ampla variedade de operações primitivas declaradas pela implementação;
- Implementações Concretas: contém código plataforma-específicos;
- Abstrações Refinadas: fornecem variantes para controle da lógica. Como seu superior, trabalham com diferentes implementações através da interface geral de implementação;
- Cliente: está apenas interessado em trabalhar com a abstração. Contudo, é trabalho do cliente ligar o objeto de abstração com um dos objetos de implementação.

##### Aplicabilidade
- Utilize o padrão Bridge quando você quer dividir e organizar uma classe monolítica que tem diversas variantes da mesma funcionalidade (por exemplo, se a classe pode trabalhar com diversos servidores de base de dados);
- Utilize o padrão quando você precisa estender uma classe em diversas dimensões ortogonais (independentes);
- Utilize o Bridge se você precisar ser capaz de trocar implementações durante o momento de execução.

~~~~
/**
 * A abstração.
 */
abstract class Page
{
    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * A abstração geralmente é inicializada com um dos objetos de implementação.
     */
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * O padrão Bridge permite substituir o objeto Implementation anexado dinamicamente.
     */
    public function changeRenderer(Renderer $renderer): void
    {
        $this->renderer = $renderer;
    }

    /**
     * O comportamento de "visualização" permanece abstrato, pois só pode ser fornecido por classes de Abstração Concreta.
     */
    abstract public function view(): string;
}

/**
 * Esta Abstração Concreta representa uma página simples.
 */
class SimplePage extends Page
{
    protected $title;
    protected $content;

    public function __construct(Renderer $renderer, string $title, string $content)
    {
        parent::__construct($renderer);
        $this->title = $title;
        $this->content = $content;
    }

    public function view(): string
    {
        return $this->renderer->renderParts([
            $this->renderer->renderHeader(),
            $this->renderer->renderTitle($this->title),
            $this->renderer->renderTextBlock($this->content),
            $this->renderer->renderFooter()
        ]);
    }
}

/**
 * Esta Abstração Concreta representa uma página mais complexa.
 */
class ProductPage extends Page
{
    protected $product;

    public function __construct(Renderer $renderer, Product $product)
    {
        parent::__construct($renderer);
        $this->product = $product;
    }

    public function view(): string
    {
        return $this->renderer->renderParts([
            $this->renderer->renderHeader(),
            $this->renderer->renderTitle($this->product->getTitle()),
            $this->renderer->renderTextBlock($this->product->getDescription()),
            $this->renderer->renderImage($this->product->getImage()),
            $this->renderer->renderLink("/cart/add/" . $this->product->getId(), "Add to cart"),
            $this->renderer->renderFooter()
        ]);
    }
}

/**
 * Uma classe auxiliar para a classe ProductPage.
 */
class Product
{
    private $id, $title, $description, $image, $price;

    public function __construct(
        string $id,
        string $title,
        string $description,
        string $image,
        float $price
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
    }

    public function getId(): string { return $this->id; }

    public function getTitle(): string { return $this->title; }

    public function getDescription(): string { return $this->description; }

    public function getImage(): string { return $this->image; }

    public function getPrice(): float { return $this->price; }
}

/**
 * A implementação declara um conjunto de métodos "reais", "ocultos" e "de plataforma".
 * Nesse caso, a Implementação lista os métodos de renderização que podem ser usados ​​para compor qualquer página da web.
 * Diferentes abstrações podem usar diferentes métodos de implementação.
 */
interface Renderer
{
    public function renderTitle(string $title): string;

    public function renderTextBlock(string $text): string;

    public function renderImage(string $url): string;

    public function renderLink(string $url, string $title): string;

    public function renderHeader(): string;

    public function renderFooter(): string;

    public function renderParts(array $parts): string;
}

/**
 * Esta implementação concreta renderiza uma página da web como HTML.
 */
class HTMLRenderer implements Renderer
{
    public function renderTitle(string $title): string
    {
        return "<h1>$title</h1>";
    }

    public function renderTextBlock(string $text): string
    {
        return "<div class='text'>$text</div>";
    }

    public function renderImage(string $url): string
    {
        return "<img src='$url'>";
    }

    public function renderLink(string $url, string $title): string
    {
        return "<a href='$url'>$title</a>";
    }

    public function renderHeader(): string
    {
        return "<html><body>";
    }

    public function renderFooter(): string
    {
        return "</body></html>";
    }

    public function renderParts(array $parts): string
    {
        return implode("<br>", $parts);
    }
}

/**
 * Esta implementação concreta renderiza uma página da web como strings JSON.
 */
class JsonRenderer implements Renderer
{
    public function renderTitle(string $title): string
    {
        return '"title": "' . $title . '"';
    }

    public function renderTextBlock(string $text): string
    {
        return '"text": "' . $text . '"';
    }

    public function renderImage(string $url): string
    {
        return '"img": "' . $url . '"';
    }

    public function renderLink(string $url, string $title): string
    {
        return '"link": {"href": "' . $title . '", "title": "' . $title . '""}';
    }

    public function renderHeader(): string
    {
        return '';
    }

    public function renderFooter(): string
    {
        return '';
    }

    public function renderParts(array $parts): string
    {
        return "{<br>" . implode(",<br>", array_filter($parts)) . "<br>}";
    }
}

/**
 * O código do cliente pode ser executado com qualquer combinação pré-configurada de Abstração + Implementação.
 */
$HTMLRenderer = new HTMLRenderer();
$JSONRenderer = new JsonRenderer();

$page = new SimplePage($HTMLRenderer, "Home", "Bem-vindo ao nosso site!");
echo "Visualização HTML de uma página de conteúdo simples:<br>";
clientCode($page);
echo "<br><br>";

/**
 * A Abstração pode alterar a Implementação vinculada no tempo de execução, se necessário.
 */
$page->changeRenderer($JSONRenderer);
echo "Visualização JSON de uma página de conteúdo simples, renderizada com o mesmo código de cliente:<br>";
clientCode($page);
echo "<br><br>";

$product = new Product("123", "Star Wars, episódio 1",
    "Há muito tempo em uma galáxia muito, muito distante ...",
    "https://images-na.ssl-images-amazon.com/images/I/41voG9enr5L._SX327_BO1,204,203,200_.jpg", 39.95);

$page = new ProductPage($HTMLRenderer, $product);
echo "Visualização HTML da página de um produto, mesmo código de cliente:<br>";
clientCode($page);
echo "<br><br>";

$page->changeRenderer($JSONRenderer);
echo "Visualização JSON de uma página de conteúdo simples, com o mesmo código de cliente:<br>";
clientCode($page);
~~~~
Fonte: https://refactoring.guru/pt-br/design-patterns/bridge/php/example#example-1
