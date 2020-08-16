## 3 - LISKOV SUBSTITUTION PRINCIPLE (PRINCÍPIO DA SUBSTITUIÇÃO DE LISKOV)

O terceiro princípio foi escrito pela cientista da computação Barbara Liskov, onde classes derivadas podem ser substituíveis por suas classes base e classes irmãs.

Resumindo, quando temos uma classe B e classe C que estende da classe A, deveríamos poder trocar a classe B pelo classe A, ou pela classe C dentro do projeto sem quebrar o código.

#### Ferindo o princípio de substituição de Liskov
Primeiro exemplo
~~~~
<?php

class Logger // classe-pai
{
    public function log($mensagem)
    {
        $this->append($mensagem);
    }
}

class DatabaseLogger extends Logger // sub-classe
{
    public function log($mensagem) // sobrescreve o método Logger::log($mensagem)
    {
        $this->database->insert('log', ['message' => $mensagem]);
    }
}

$logger->log('Não foi possível enviar o pedido.'); // true

$databaseLogger->log('Não foi possível enviar o pedido.'); // PHP Fatal error: Call to a member function insert() on a non-object
~~~~
O problema nesse exemplo é que a instância de DatabaseLogger só funciona no lugar de Logger se o valor da propriedade database for informada antes do uso.

Segundo exemplo
~~~~
<?php

class DatabaseLogger extends Logger // sub-classe
{
    public function log($mensagem) // sobrescreve o método Logger::log($mensagem)
    {
        if (empty($this->database) || !$this->database->isConnected()) {
            throw new DbConnectionError; // exceção que não existe na classe-mãe
        }
        $this->database->insert('log', ['message' => $mensagem]);
    }
}

$fileLogger->log('Não foi possível enviar o pedido.'); // true

$databaseLogger->log('Não foi possível enviar o pedido.'); // PHP Warning: Uncaught exception 'DbConnectionError'
~~~~
Neste segundo caso o sistema não espera uma exceção do tipo DbConnectionError, então quebrará sem tratar apropriadamente o erro.

Terceiro exemplo
~~~~
<?php

class DatabaseLogger extends Logger // sub-classe
{
    public function log($mensagem) // sobrescreve o método Logger::log($mensagem)
    {
        // não faz nada
    }
}

$fileLogger->log('Não foi possível enviar o pedido.'); // true

$databaseLogger->log('Não foi possível enviar o pedido.'); // método não faz nada
~~~~
Se o comportamento da sub-classe muda ao ponto de um método não executar nada, é provável que a hierarquia precisa ser refatorada para tratar dois casos distintos.

#### Aplicando o princípio de substituição de Liskov
~~~~
<?php

class DatabaseLogger extends Logger // sub-classe
{
    public function __construct(..., Database $database)
    {
        parent::__construct(...);

        $this->database = $database;

        if (!$this->database->isConnected()) {
            $this->database->connect();
        }
    }

    public function log($mensagem)
    {
        $this->append($mensagem);
    }

}
~~~~
Como poderíamos resolver esse caso? Existem diversas maneiras, uma delas é fazer com que a classe receba as dependências no construtor e configure o que for necessário, desta forma o método log() sempre se comportará da maneira esperada:
