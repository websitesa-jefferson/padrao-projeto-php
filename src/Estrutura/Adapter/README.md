## PADRÃO ADAPTER

##### Objetivo
É usado quando queremos converter a interface de uma classe em outra interface utilizada pelo cliente.

##### Contexto
Este padrão é útil quando precisamos da comunicação entre classess que não poderiam trabalhar juntas devido a incompatibilidade de suas interfaces.

##### Estrutura
- Client: colabora entre os objetos conforme a interface alvo;
- Target: define a interface de domínio especifico que o cliente utiliza;
- Adapter: Adapta a classe existente para ser utilizada pela classe alvo.

##### Aplicabilidade
- Deseja-se usar uma classe existente e sua interface não está em acordo com o que a aplicação em desenvolvimento necessita;

~~~~
/**
 * O destino define a interface específica do domínio usada pelo código do cliente.
 */
class Target
{
    public function request(): string
    {
        return "Alvo: o comportamento do alvo padrão.";
    }
}

/**
 * O Adaptee contém alguns comportamentos úteis, mas sua interface é incompatível com o código do cliente existente.
 * O Adaptee precisa de alguma adaptação antes que o código do cliente possa usá-lo.
 */
class Adaptee
{
    public function specificRequest(): string
    {
        return ".eetpadA od laicepse otnematropmoC";
    }
}

/**
 * O Adaptador torna a interface do Adaptee compatível com a interface do Destino.
 */
class Adapter extends Target
{
    private $adaptee;

    public function __construct(Adaptee $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function request(): string
    {
        return "Adaptador: (TRADUZIDO) " . strrev($this->adaptee->specificRequest());
    }
}

/**
 * O código do cliente oferece suporte a todas as classes que seguem a interface de destino.
 */
function clientCode(Target $target)
{
    echo $target->request();
}

echo "Cliente: Posso trabalhar muito bem com os objetos Alvo:<br>";
$target = new Target();
clientCode($target);
echo "<br><br>";

$adaptee = new Adaptee();
echo "Cliente: A classe Adaptee tem uma interface estranha. Veja, eu não entendo isso:<br>";
echo "Adaptee: " . $adaptee->specificRequest();
echo "<br><br>";

echo "Cliente: Mas posso trabalhar com isso por meio do Adaptador:<br>";
$adapter = new Adapter($adaptee);
clientCode($adapter);
~~~~
Fonte: https://refactoring.guru/pt-br/design-patterns/adapter/php/example#lang-features
