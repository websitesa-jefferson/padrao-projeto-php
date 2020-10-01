<?php


namespace App\Criacao\AbstractFactory;

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

    // Veja como você usaria o modelo na vida real. Observe que a classe de página não depende de nenhum
    // classes de template concretas.
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
