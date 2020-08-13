<?php


namespace App;


class AppTest extends \PHPUnit\Framework\TestCase
{
    public function testTestarClasseFunciona()
    {
        $app = new App();
        $this->assertInstanceOf('App\App', $app);
    }
}
