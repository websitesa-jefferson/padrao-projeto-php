<?php

namespace App\criacao;

/**
 * Se precisar de suporte a vários tipos de singletons em seu aplicativo, você pode
 * definir os recursos básicos do Singleton em uma classe base, enquanto move o
 * lógica de negócios real (como registro) para subclasses.
 */
class Singleton
{
    /**
     * A instância do singleton real quase sempre reside dentro de um estático
     * campo. Neste caso, o campo estático é uma matriz, onde cada subclasse de
     * Singleton armazena sua própria instância.
     */
    private static $instances = [];

    /**
     * O construtor de Singleton não deve ser público. Porém, não pode ser
     * private se quisermos permitir subclasses.
     */
    protected function __construct() { }

    /**
     * A clonagem e a desserialização não são permitidas para singletons.
     */
    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Não é possível desserializar o singleton");
    }

    /**
     * O método que você usa para obter a instância do Singleton.
     */
    public static function getInstance()
    {
        $subclass = static::class;
        if (! isset(self::$instances[$subclass])) {
            // Observe que aqui usamos a palavra-chave "static" em vez da palavra-chave
            // nome da classe. Neste contexto, a palavra-chave "static" significa "o nome
            // da classe atual ". Esse detalhe é importante porque quando o
            // método é chamado na subclasse, queremos uma instância dessa
            // subclasse a ser criada aqui.
            self::$instances[$subclass] = new static;
        }
        return self::$instances[$subclass];
    }
}
