<?php

namespace App\Criacao\Singleton;

class LogSingletonTest extends \PHPUnit\Framework\TestCase
{
    public function testclasseExiste()
    {
        $log = LogSingleton::getInstance();

        $this->assertInstanceOf('App\Criacao\Singleton\LogSingleton', $log);
    }

    public function testInstanciasIguais()
    {
        $log1 = LogSingleton::getInstance();
        $log2 = LogSingleton::getInstance();

        $iguais = false;

        if ($log1 === $log2) {
            $iguais = true;
        }

        $this->assertEquals(true, $iguais);
    }
}
