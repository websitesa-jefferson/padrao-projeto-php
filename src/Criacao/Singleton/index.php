<?php

use App\Criacao\Singleton\Log;
use App\Criacao\Singleton\LogSingleton;

require __DIR__.'/../../bootstrap.php';

echo '<pre>';

echo '<b>Instâncias de Log()</b><br><br>';
$log1 = new Log;
$log2 = new Log;
$log3 = new Log;
$log4 = new Log;
$log5 = new Log;

var_dump($log1);
var_dump($log2);
var_dump($log3);
var_dump($log4);
var_dump($log5);

echo '<br><br>';

echo '<b>Instâncias de LogSingleton()</b><br><br>';
$log1 = LogSingleton::getInstance();
$log2 = LogSingleton::getInstance();
$log3 = LogSingleton::getInstance();
$log4 = LogSingleton::getInstance();
$log5 = LogSingleton::getInstance();

var_dump($log1);
var_dump($log2);
var_dump($log3);
var_dump($log4);
var_dump($log5);
