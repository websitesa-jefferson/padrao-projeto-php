<?php

namespace App\Estrutura\Adapter;

/**
 * Aqui está um exemplo da classe existente que segue a interface Target.
 *
 * A verdade é que muitos aplicativos reais podem não ter essa interface claramente definida.
 * Se você estiver nesse barco, sua melhor aposta seria estender o adaptador de uma das classes existentes em seu aplicativo.
 * Se isso for estranho (por exemplo, SlackNotification não parece uma subclasse de EmailNotification), então
 * extrair uma interface deve ser o primeiro passo.
 */
class EmailNotification implements Notification
{
    private $adminEmail;

    public function __construct(string $adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    public function send(string $title, string $message): void
    {
        mail($this->adminEmail, $title, $message);
        echo "Email enviado com título '$title' para '{$this->adminEmail}' isso diz '$message'.";
    }
}
