<?php

namespace App\Criacao\FactoryMethod;

/**
 * Este Concrete Creator é compatível com o Facebook.
 * Lembre-se de que essa classe também herda o método 'post' da classe pai.
 * Os Criadores Concretos são as classes que o Cliente realmente usa.
 */
class FacebookPoster extends SocialNetworkPoster
{
    private $login, $password;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new FacebookConnector($this->login, $this->password);
    }
}
