<?php

namespace App\Criacao\FactoryMethod;

/**
 * Este produto concreto implementa a API do LinkedIn.
 */
class LinkedInConnector implements SocialNetworkConnector
{
    private $email, $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function logIn(): void
    {
        echo "Enviar solicitação de API HTTP para login do usuário $this->email com senha $this->password<br>";
    }

    public function logOut(): void
    {
        echo "Enviar solicitação de API HTTP para logout do usuário $this->email<br>";
    }

    public function createPost($content): void
    {
        echo "Envie solicitações HTTP API para criar uma postagem na linha do tempo do LinkedIn.<br>";
    }
}
