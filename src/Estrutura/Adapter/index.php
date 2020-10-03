<?php

use App\Estrutura\Adapter\SlackApi;
use App\Estrutura\Adapter\Notification;
use App\Estrutura\Adapter\EmailNotification;
use App\Estrutura\Adapter\SlackNotification;

require __DIR__.'/../../bootstrap.php';

/**
 * O código do cliente pode funcionar com qualquer classe que siga a interface Target.
 */
function clientCode(Notification $notification)
{
    echo $notification->send("Site está fora do ar!",
        "<strong style='color:red;font-size: 50px;'>Alerta!</strong> " .
        "Nosso site não está respondendo. Ligue para os administradores e abra!");
}

echo "O código do cliente foi projetado corretamente e funciona com notificações por e-mail:<br>";
$notification = new EmailNotification("developers@example.com");
clientCode($notification);
echo "<br><br>";


echo "O mesmo código do cliente pode funcionar com outras classes via adaptador:<br>";
$slackApi = new SlackApi("example.com", "XXXXXXXX");
$notification = new SlackNotification($slackApi, "Example.com Developers");
clientCode($notification);
