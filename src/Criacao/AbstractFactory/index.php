<?php

use App\Criacao\AbstractFactory\Page;
use App\Criacao\AbstractFactory\PHPTemplateFactory;

require __DIR__.'/../../bootstrap.php';

/**
 * Agora, em outras partes do aplicativo, o código do cliente pode aceitar objetos de fábrica de qualquer tipo.
 */
$page = new Page('Página de exemplo', 'Este é o corpo.');

echo "Testando a renderização real com a fábrica PHPTemplate:<br>";
echo $page->render(new PHPTemplateFactory());

// Descomente o seguinte se você tiver o Twig instalado.
// echo "Teste de renderização com a fábrica Twig:<br>"; echo $page->render(new TwigTemplateFactory());
