<?php

namespace App\Criacao\Singleton;

/**
 * @internal Classe com o padrão Singleton
 */
class LogSingleton
{
    /**
     * @var  Classe com o padrão Singleton
     */
    private static $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
