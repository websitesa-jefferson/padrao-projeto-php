<?php

namespace App\Criacao\FactoryMethod;

/**
 * Este produto concreto implementa a API do Facebook.
 */
class FacebookConnector implements SocialNetworkConnector
{
    private $login, $password;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function logIn(): void
    {
        echo "Enviar solicitação de API HTTP para login do usuário $this->login com senha $this->password<br>";
    }

    public function logOut(): void
    {
        echo "Enviar solicitação de API HTTP para logout do usuário $this->login<br>";
    }

    public function createPost($content): void
    {
        echo "Envie solicitações HTTP API para criar uma postagem na linha do tempo do Facebook.<br>";
    }
}
