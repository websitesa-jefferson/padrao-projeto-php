<?php

use App\Estrutura\Adapter\Target;
use App\Estrutura\Adapter\Adaptee;
use App\Estrutura\Adapter\Adapter;

require __DIR__.'/../../bootstrap.php';

/**
 * O código do cliente oferece suporte a todas as classes que seguem a interface de destino.
 */
function clientCode(Target $target)
{
    echo $target->request();
}

echo "Cliente: Posso trabalhar muito bem com os objetos Alvo:<br>";
$target = new Target();
clientCode($target);
echo "<br><br>";

$adaptee = new Adaptee();
echo "Cliente: A classe Adaptee tem uma interface estranha. Veja, eu não entendo isso:<br>";
echo "Adaptee: " . $adaptee->specificRequest();
echo "<br><br>";

echo "Cliente: Mas posso trabalhar com isso por meio do Adaptador:<br>";
$adapter = new Adapter($adaptee);
clientCode($adapter);
