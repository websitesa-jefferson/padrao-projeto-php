<?php

use App\Estrutura\Bridge\Page;
use App\Estrutura\Bridge\Product;
use App\Estrutura\Bridge\SimplePage;
use App\Estrutura\Bridge\ProductPage;
use App\Estrutura\Bridge\HTMLRenderer;
use App\Estrutura\Bridge\JsonRenderer;

require __DIR__.'/../../bootstrap.php';

/**
 * O código do cliente geralmente lida apenas com os objetos Abstraction.
 */
function clientCode(Page $page)
{
    echo $page->view();
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
