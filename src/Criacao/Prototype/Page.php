<?php

namespace App\Criacao\Prototype;

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
