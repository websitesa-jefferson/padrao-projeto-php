<?php

namespace App\Estrutura\Adapter;

/**
 * A interface Target representa a interface que as classes de seu aplicativo já seguem.
 */
interface Notification
{
    public function send(string $title, string $message);
}
