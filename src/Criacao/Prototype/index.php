<?php

use App\Criacao\Prototype\Page;
use App\Criacao\Prototype\Author;

require __DIR__.'/../../bootstrap.php';

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
