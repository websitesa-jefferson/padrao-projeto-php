<?php

namespace Jefferson\Patterns\Singleton;

/**
 * A classe de registro é o uso mais conhecido e elogiado do padrão Singleton.
 * Na maioria dos casos, você precisa de um único objeto de registro que grava em um único registro
 * arquivo (controle sobre o recurso compartilhado). Você também precisa de uma maneira conveniente de acessar
 * essa instância de qualquer contexto de seu aplicativo (ponto de acesso global).
 */
class Logger extends Singleton
{
    /**
     * Um recurso de ponteiro de arquivo do arquivo de log.
     */
    private $fileHandle;

    /**
     * Como o construtor do Singleton é chamado apenas uma vez, apenas um único arquivo
     * de recurso está sempre aberto.
     *
     * Observe que, por uma questão de simplicidade, abrimos o fluxo do console em vez de
     * o arquivo real aqui.
     */
    protected function __construct()
    {
        $this->fileHandle = fopen('php://stdout', 'w');
    }

    /**
     * Grave uma entrada de registro no recurso de arquivo aberto.
     */
    public function writeLog(string $message): void
    {
        $date = date('Y-m-d');
        fwrite($this->fileHandle, "$date: $message\n");
    }

    /**
     * Apenas um atalho útil para reduzir a quantidade de código necessária para registrar mensagens
     * do código do cliente.
     */
    public static function log(string $message): void
    {
        $logger = static::getInstance();
        $logger->writeLog($message);
    }
}
