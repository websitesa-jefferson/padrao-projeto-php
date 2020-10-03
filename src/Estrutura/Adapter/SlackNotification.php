<?php

namespace App\Estrutura\Adapter;

/**
 * O Adaptador é uma classe que vincula a interface Target e a classe Adaptee.
 * Nesse caso, permite que o aplicativo envie notificações usando a API Slack.
 */
class SlackNotification implements Notification
{
    private $slack;
    private $chatId;

    public function __construct(SlackApi $slack, string $chatId)
    {
        $this->slack = $slack;
        $this->chatId = $chatId;
    }

    /**
     * Um adaptador não é apenas capaz de adaptar interfaces, mas também pode converter dados de entrada para o formato
     * exigido pelo Adaptado.
     */
    public function send(string $title, string $message): void
    {
        $slackMessage = "#" . $title . "# " . strip_tags($message);
        $this->slack->logIn();
        $this->slack->sendMessage($this->chatId, $slackMessage);
    }
}
