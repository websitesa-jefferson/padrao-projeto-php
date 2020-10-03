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
 * A interface Target representa a interface que as classes de seu aplicativo já seguem.
 */
interface Notification
{
    public function send(string $title, string $message);
}

/**
 * Aqui está um exemplo da classe existente que segue a interface Target.
 *
 * A verdade é que muitos aplicativos reais podem não ter essa interface claramente definida.
 * Se você estiver nesse barco, sua melhor aposta seria estender o adaptador de uma das classes existentes em seu aplicativo.
 * Se isso for estranho (por exemplo, SlackNotification não parece uma subclasse de EmailNotification), então
 * extrair uma interface deve ser o primeiro passo.
 */
class EmailNotification implements Notification
{
    private $adminEmail;

    public function __construct(string $adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    public function send(string $title, string $message): void
    {
        mail($this->adminEmail, $title, $message);
        echo "Email enviado com título '$title' para '{$this->adminEmail}' isso diz '$message'.";
    }
}

/**
 * O Adaptee é uma classe útil, incompatível com a interface Target.
 * Você não pode simplesmente entrar e alterar o código da classe para seguir a interface de destino, pois o código pode ser
 * fornecido por uma biblioteca de terceiros.
 */
class SlackApi
{
    private $login;
    private $apiKey;

    public function __construct(string $login, string $apiKey)
    {
        $this->login = $login;
        $this->apiKey = $apiKey;
    }

    public function logIn(): void
    {
        // Envie a solicitação de autenticação para o serviço da Web do Slack.
        echo "Conectado a uma conta slack '{$this->login}'.<br>";
    }

    public function sendMessage(string $chatId, string $message): void
    {
        // Envie uma solicitação de postagem de mensagem para o serviço da Web do Slack.
        echo "Postado a seguinte mensagem no '$chatId' bate-papo: '$message'.<br>";
    }
}

/**
 * O Adaptador é uma classe que vincula a interface Target e a classe Adaptee.
 * Nesse caso, permite que o aplicativo envie notificações usando a API Slack.
 */
class SlackNotification implements Notification
{
    private $slack;
    private $chatId;

    public function __construct(SlackApi $slack, string $chatId)
    {
        $this->slack = $slack;
        $this->chatId = $chatId;
    }

    /**
     * Um adaptador não é apenas capaz de adaptar interfaces, mas também pode converter dados de entrada para o formato
     * exigido pelo Adaptado.
     */
    public function send(string $title, string $message): void
    {
        $slackMessage = "#" . $title . "# " . strip_tags($message);
        $this->slack->logIn();
        $this->slack->sendMessage($this->chatId, $slackMessage);
    }
}

/**
 * O código do cliente pode funcionar com qualquer classe que siga a interface Target.
 */
function clientCode(Notification $notification)
{
    echo $notification->send("Site está fora do ar!",
        "<strong style='color:red;font-size: 50px;'>Alerta!</strong> " .
        "Nosso site não está respondendo. Ligue para os administradores e abra!");
}

echo "O código do cliente foi projetado corretamente e funciona com notificações por e-mail:<br>";
$notification = new EmailNotification("developers@example.com");
clientCode($notification);
echo "<br><br>";


echo "O mesmo código do cliente pode funcionar com outras classes via adaptador:<br>";
$slackApi = new SlackApi("example.com", "XXXXXXXX");
$notification = new SlackNotification($slackApi, "Example.com Developers");
clientCode($notification);
~~~~
Fonte: https://refactoring.guru/pt-br/design-patterns/adapter/php/example#lang-features
