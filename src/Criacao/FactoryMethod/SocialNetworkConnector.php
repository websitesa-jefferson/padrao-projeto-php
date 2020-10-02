<?php

namespace App\Criacao\FactoryMethod;

/**
 * A interface do produto declara o comportamento de vários tipos de produtos.
 */
interface SocialNetworkConnector
{
    public function logIn(): void;

    public function logOut(): void;

    public function createPost($content): void;
}
