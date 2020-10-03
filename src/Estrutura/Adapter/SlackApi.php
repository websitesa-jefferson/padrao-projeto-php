<?php

namespace App\Estrutura\Adapter;

/**
 * O Adaptee é uma classe útil, incompatível com a interface Target.
 * Você não pode simplesmente entrar e alterar o código da classe para seguir a interface de destino, pois o código pode ser
 * fornecido por uma biblioteca de terceiros.
 */
class SlackApi
{
    private $login;
    private $apiKey;

    public function __construct(string $login, string $apiKey)
    {
        $this->login = $login;
        $this->apiKey = $apiKey;
    }

    public function logIn(): void
    {
        // Envie a solicitação de autenticação para o serviço da Web do Slack.
        echo "Conectado a uma conta slack '{$this->login}'.<br>";
    }

    public function sendMessage(string $chatId, string $message): void
    {
        // Envie uma solicitação de postagem de mensagem para o serviço da Web do Slack.
        echo "Postado a seguinte mensagem no '$chatId' bate-papo: '$message'.<br>";
    }
}
