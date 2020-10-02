<?php

use App\Criacao\FactoryMethod\FacebookPoster;
use App\Criacao\FactoryMethod\LinkedInPoster;
use App\Criacao\FactoryMethod\SocialNetworkPoster;

require __DIR__.'/../../bootstrap.php';

/**
 * O código do cliente pode funcionar com qualquer subclasse de SocialNetworkPoster, pois não depende de classes concretas.
 */
function clientCode(SocialNetworkPoster $creator)
{
    $creator->post("Olá Mundo!");
    $creator->post("Eu comi um hambúrguer grande esta manhã!");
}

/**
 * Durante a fase de inicialização, o aplicativo pode decidir com qual rede social deseja trabalhar, criar um objeto de
 * a subclasse apropriada e passe-a para o código do cliente.
 */
echo "Testando ConcreteCreator1:<br>";
clientCode(new FacebookPoster("john_smith", "******"));
echo "<br><br>";

echo "Testando ConcreteCreator2:<br>";
clientCode(new LinkedInPoster("john_smith@example.com", "******"));
