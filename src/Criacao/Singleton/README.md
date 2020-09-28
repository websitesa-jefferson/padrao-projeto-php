## PADRÃO SINGLETON

##### Objetivo
Garantir que uma classe tenha somente uma instância e fornecer um ponto global de acesso a ela.

##### Contexto
Restringir o acesso a recursos limitados e compartilhados pelo sistema, exemplo: classe de log.

##### Estrutura
Possui apenas um item chamado Singleton.

##### Aplicabilidade
- Quando deve haver somente uma instância dessa classe em qualquer ponto do sistema.
- Quando a instância única deve ser extensível através de subclasses e os clientes devem ser capazes de usar uma instância estendida sem modificar seu código.

##### Ferindo o Singleton
Criaremos uma classe log.
~~~~
<?php

class Log
{
    ...
}

$log1 = new Log;
$log2 = new Log;
$log3 = new Log;
$log4 = new Log;
$log5 = new Log;

var_dump($log1); // object(Log)#1 (0) {}
var_dump($log2); // object(Log)#2 (0) {}
var_dump($log3); // object(Log)#3 (0) {}
var_dump($log4); // object(Log)#4 (0) {}
var_dump($log5); // object(Log)#5 (0) {}
~~~~
Se executarmos o exemplo acima, poderemos ver que a cada nova chamada da classe Log, nós criamos uma nova instância, indo de #1 até #5.

##### Aplicando o Singleton
Agora vamos começar a implementar o padrão Singleton na nossa classe.

Faremos isso alterando a visibilidade dos nosso métodos mágicos __construct o __wakeup e do __clone.
Com isso, garantimos que a classe não pode ser mais instanciada de forma normal.

E também vamos criar um método estático getInstance que vai ser o único responsável por retornar a nova instância da nossa classe.
É neste método que vamos verificar se já existe uma instância na nossa classe.
~~~~
<?php

class LogSingleton
{
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

$log1 = LogSingleton::getInstance();
$log2 = LogSingleton::getInstance();
$log3 = LogSingleton::getInstance();
$log4 = LogSingleton::getInstance();
$log5 = LogSingleton::getInstance();

var_dump($log1); // object(Log)#1 (0) {}
var_dump($log2); // object(Log)#1 (0) {}
var_dump($log3); // object(Log)#1 (0) {}
var_dump($log4); // object(Log)#1 (0) {}
var_dump($log5); // object(Log)#1 (0) {}
~~~~
Se executarmos o exemplo acima, poderemos ver que a cada nova chamada da classe LogSingleton, nós utilizamos a mesma instância #1.

Fonte: https://imasters.com.br/back-end/o-padrao-singleton-com-php
