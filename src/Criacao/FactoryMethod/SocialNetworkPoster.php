<?php

namespace App\Criacao\FactoryMethod;

/**
 * O Criador declara um método de fábrica que pode ser usado como uma substituição para as chamadas diretas do
 * construtor de produtos, por exemplo:
 *
 * - Antes: $p = new FacebookConnector();
 * - Depois de: $p = $this->getSocialNetwork;
 *
 * Isso permite alterar o tipo de produto que está sendo criado pelas subclasses de SocialNetworkPoster.
 */
abstract class SocialNetworkPoster
{
    /**
     * O método de fábrica real.
     * Observe que ele retorna o conector abstrato.
     * Isso permite que as subclasses retornem quaisquer conectores concretos sem quebrar o contrato da superclasse.
     */
    abstract public function getSocialNetwork(): SocialNetworkConnector;

    /**
     * Quando o método de fábrica é usado dentro da lógica de negócios do Criador, as subclasses podem alterar a lógica
     * indiretamente, retornando diferentes tipos de conector do método de fábrica.
     */
    public function post($content): void
    {
        // Chame o método de fábrica para criar um objeto Produto ...
        $network = $this->getSocialNetwork();
        // ...em seguida, use-o como quiser.
        $network->logIn();
        $network->createPost($content);
        $network->logout();
    }
}
