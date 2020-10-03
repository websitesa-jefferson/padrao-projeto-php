## PADRÃO ABSTRACT FACTORY

##### Objetivo
Permitir que você produza famílias de objetos relacionados sem ter que especificar suas classes concretas.

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
- Alguns objetos relacionados foram projetados para serem utilizados em conjunto, e você precisa impor essa restrição;
- Você quer fornecer uma biblioteca de classes e pretende revelar apenas suas interfaces, não suas implementações.

~~~~
/**
 * A interface Abstract Factory declara métodos de criação para cada tipo de produto distinto.
 */
interface TemplateFactory
{
    public function createTitleTemplate(): TitleTemplate;

    public function createPageTemplate(): PageTemplate;

    public function getRenderer(): TemplateRenderer;
}

/**
 * Cada fábrica concreta corresponde a uma variante (ou família) específica de produtos.
 * Esta fábrica concreta cria modelos Twig.
 */
class TwigTemplateFactory implements TemplateFactory
{
    public function createTitleTemplate(): TitleTemplate
    {
        return new TwigTitleTemplate();
    }

    public function createPageTemplate(): PageTemplate
    {
        return new TwigPageTemplate($this->createTitleTemplate());
    }

    public function getRenderer(): TemplateRenderer
    {
        return new TwigRenderer();
    }
}

/**
 * E esta fábrica concreta cria modelos de PHPTemplate.
 */
class PHPTemplateFactory implements TemplateFactory
{
    public function createTitleTemplate(): TitleTemplate
    {
        return new PHPTemplateTitleTemplate();
    }

    public function createPageTemplate(): PageTemplate
    {
        return new PHPTemplatePageTemplate($this->createTitleTemplate());
    }

    public function getRenderer(): TemplateRenderer
    {
        return new PHPTemplateRenderer();
    }
}

/**
 * Cada tipo de produto distinto deve ter uma interface separada.
 * Todas as variantes do produto devem seguir a mesma interface.
 * Por exemplo, esta interface de Produto Abstrato descreve o comportamento dos modelos de título de página.
 */
interface TitleTemplate
{
    public function getTemplateString(): string;
}

/**
 * Este produto concreto fornece modelos de título de página Twig.
 */
class TwigTitleTemplate implements TitleTemplate
{
    public function getTemplateString(): string
    {
        return "<h1>{{ title }}</h1>";
    }
}

/**
 * E este produto concreto fornece modelos de título de página do PHPTemplate.
 */
class PHPTemplateTitleTemplate implements TitleTemplate
{
    public function getTemplateString(): string
    {
        return "<h1><?= \$title ?></h1>";
    }
}

/**
 * Este é outro tipo de produto abstrato, que descreve modelos de páginas inteiras.
 */
interface PageTemplate
{
    public function getTemplateString(): string;
}

/**
 * O modelo de página usa o sub-modelo de título, portanto, temos que fornecer uma maneira de defini-lo no objeto de sub-modelo.
 * A fábrica de resumo vinculará o modelo de página a um modelo de título da mesma variante.
 */
abstract class BasePageTemplate implements PageTemplate
{
    protected $titleTemplate;

    public function __construct(TitleTemplate $titleTemplate)
    {
        $this->titleTemplate = $titleTemplate;
    }
}

/**
 * A variante Twig de todos os modelos de página.
 */
class TwigPageTemplate extends BasePageTemplate
{
    public function getTemplateString(): string
    {
        $renderedTitle = $this->titleTemplate->getTemplateString();

        return <<<HTML
        <div class="page">
            $renderedTitle
            <article class="content">{{ content }}</article>
        </div>
        HTML;
    }
}

/**
 * A variante PHPTemplate de todos os modelos de página.
 */
class PHPPageTemplate extends BasePageTemplate
{
    public function getTemplateString(): string
    {
        $renderedTitle = $this->titleTemplate->getTemplateString();

        return <<<HTML
        <div class="page">
            $renderedTitle
            <article class="content"><?= \$content ?></article>
        </div>
        HTML;
    }
}

/**
 * O renderizador é responsável por converter uma string de template no código HTML real.
 * Cada renderizador se comporta de maneira diferente e espera que seu próprio tipo de string de modelo seja passado a ele.
 * Modelos de cozimento com a fábrica permitem que você passe tipos adequados de modelos para renderizações adequadas.
 */
interface TemplateRenderer
{
    public function render(string $templateString, array $arguments = []): string;
}

/**
 * O renderizador para modelos Twig.
 */
class TwigRenderer implements TemplateRenderer
{
    public function render(string $templateString, array $arguments = []): string
    {
        return \Twig::render($templateString, $arguments);
    }
}

/**
 * O renderizador para modelos de PHPTemplate. Observe que esta implementação é muito básica, senão grosseira.
 * Usar a função `eval` tem muitas implicações de segurança, então use-a com cuidado em projetos reais.
 */
class PHPRenderer implements TemplateRenderer
{
    public function render(string $templateString, array $arguments = []): string
    {
        extract($arguments);

        ob_start();
        eval(' ?>' . $templateString . '<?php ');
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }
}

/**
 * O código do cliente.
 * Observe que ele aceita a classe Abstract Factory como parâmetro, o que permite que o cliente trabalhe com qualquer
 * tipo de fábrica de concreto.
 */
class Page
{
    public $title;

    public $content;

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    // Veja como você usaria o modelo na vida real.
    // Observe que a classe de página não depende de nenhum classes de template concretas.
    public function render(TemplateFactory $factory): string
    {
        $pageTemplate = $factory->createPageTemplate();

        $renderer = $factory->getRenderer();

        return $renderer->render($pageTemplate->getTemplateString(), [
            'title' => $this->title,
            'content' => $this->content
        ]);
    }
}

/**
 * Agora, em outras partes do aplicativo, o código do cliente pode aceitar objetos de fábrica de qualquer tipo.
 */
$page = new Page('Página de exemplo', 'Este é o corpo.');

echo "Testando a renderização real com a fábrica PHPTemplate:<br>";
echo $page->render(new PHPTemplateFactory());

// Descomente o seguinte se você tiver o Twig instalado.
// echo "Teste de renderização com a fábrica Twig:<br>"; echo $page->render(new TwigTemplateFactory());
~~~~

Fonte: https://refactoring.guru/pt-br/design-patterns/abstract-factory/php/example#lang-features
