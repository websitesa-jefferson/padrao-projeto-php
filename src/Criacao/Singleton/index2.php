<?php

require __DIR__.'../../../../vendor/autoload.php';

\App\Criacao\Singleton\Logger::log("Iniciado!");

// Compara os valores do singleton Logger.
$l1 = Logger::getInstance();
$l2 = Logger::getInstance();
if ($l1 === $l2) {
    Logger::log("Logger tem uma única instância.");
} else {
    Logger::log("Loggers são diferentes.");
}
