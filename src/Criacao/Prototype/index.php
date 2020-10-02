<?php

use App\Criacao\Prototype\Page;
use App\Criacao\Prototype\Author;

require __DIR__.'/../../bootstrap.php';

/**
 * O código do cliente.
 */
function clientCode()
{
    $author = new Author("John Smith");
    $page = new Page("Dica do dia", "Mantenha a calma e continue.", $author);

    $page->addComment("Nice tip, thanks!");

    $draft = clone $page;
    echo "Despejo do clone. Observe que o autor agora está se referindo a dois objetos.<br><br>";
    echo '<pre>';
    print_r($draft);
}

clientCode();
