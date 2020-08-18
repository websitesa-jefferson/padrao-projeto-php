<?php

namespace App\Criacao\Singleton;

class LogTest extends \PHPUnit\Framework\TestCase
{
    public function testclasseExiste()
    {
        $log = new Log();

        $this->assertInstanceOf('App\Criacao\Singleton\Log', $log);
    }

    public function testInstanciasDiferentes()
    {
        $log1 = new Log();
        $log2 = new Log();

        $diferentes = false;

        if ($log1 !== $log2) {
            $diferentes = true;
        }

        $this->assertEquals(true, $diferentes);
    }
}
