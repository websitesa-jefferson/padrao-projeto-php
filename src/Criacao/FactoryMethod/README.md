## PADRÃO FACTORY METHOD

##### Objetivo
Fornecer uma interface para criar objetos em uma superclasse, mas permite que as subclasses alterem o tipo de objetos que serão criados.

##### Contexto
Sistemas que manipulam um número variável de tipos de objetos podem utilizar este modelo devido à sua flexibilidade.
Permite que a aplicação final implemente o suporte aos objetos necessários.

##### Estrutura
- Product: define as interfaces dos objetos criados por este padrão;
- ConcreteProduct: implementa a interface do produto;
- Creator: declara o método que retorna o objeto do tipo esperado;
- ConcreteCreator: sobreescreve o método original para retornar uma instancia do objeto esperado, ou seja, o ConcreteProduct.

##### Aplicabilidade
- A aplicação não pode antecipar o tipos de objetos que devem se criados;
- Uma classe espera que suas subclasses especifiquem o tipo de objeto a ser criado;
- As classes delegam a responsabilidade a uma das subclasses e você quer identificar de qual subclasses advém o conhecimento.

~~~~
/**
 * O Criador declara um método de fábrica que pode ser usado como uma substituição para as chamadas diretas do
 * construtor de produtos, por exemplo:
 *
 * - Antes: $p = new FacebookConnector();
 * - Depois de: $p = $this->getSocialNetwork;
 *
 * Isso permite alterar o tipo de produto que está sendo criado pelas subclasses de SocialNetworkPoster.
 */
abstract class SocialNetworkPoster
{
    /**
     * O método de fábrica real.
     * Observe que ele retorna o conector abstrato.
     * Isso permite que as subclasses retornem quaisquer conectores concretos sem quebrar o contrato da superclasse.
     */
    abstract public function getSocialNetwork(): SocialNetworkConnector;

    /**
     * Quando o método de fábrica é usado dentro da lógica de negócios do Criador, as subclasses podem alterar a lógica
     * indiretamente, retornando diferentes tipos de conector do método de fábrica.
     */
    public function post($content): void
    {
        // Chame o método de fábrica para criar um objeto Produto ...
        $network = $this->getSocialNetwork();
        // ...em seguida, use-o como quiser.
        $network->logIn();
        $network->createPost($content);
        $network->logout();
    }
}

/**
 * Este Concrete Creator é compatível com o Facebook.
 * Lembre-se de que essa classe também herda o método 'post' da classe pai.
 * Os Criadores Concretos são as classes que o Cliente realmente usa.
 */
class FacebookPoster extends SocialNetworkPoster
{
    private $login, $password;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new FacebookConnector($this->login, $this->password);
    }
}

/**
 * Este Concrete Creator oferece suporte ao LinkedIn.
 */
class LinkedInPoster extends SocialNetworkPoster
{
    private $email, $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new LinkedInConnector($this->email, $this->password);
    }
}

/**
 * A interface do produto declara o comportamento de vários tipos de produtos.
 */
interface SocialNetworkConnector
{
    public function logIn(): void;

    public function logOut(): void;

    public function createPost($content): void;
}

/**
 * Este produto concreto implementa a API do Facebook.
 */
class FacebookConnector implements SocialNetworkConnector
{
    private $login, $password;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function logIn(): void
    {
        echo "Enviar solicitação de API HTTP para login do usuário $this->login com senha $this->password<br>";
    }

    public function logOut(): void
    {
        echo "Enviar solicitação de API HTTP para logout do usuário $this->login<br>";
    }

    public function createPost($content): void
    {
        echo "Envie solicitações HTTP API para criar uma postagem na linha do tempo do Facebook.<br>";
    }
}

/**
 * Este produto concreto implementa a API do LinkedIn.
 */
class LinkedInConnector implements SocialNetworkConnector
{
    private $email, $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function logIn(): void
    {
        echo "Enviar solicitação de API HTTP para login do usuário $this->email com senha $this->password<br>";
    }

    public function logOut(): void
    {
        echo "Enviar solicitação de API HTTP para logout do usuário $this->email<br>";
    }

    public function createPost($content): void
    {
        echo "Envie solicitações HTTP API para criar uma postagem na linha do tempo do LinkedIn.<br>";
    }
}

/**
 * O código do cliente pode funcionar com qualquer subclasse de SocialNetworkPoster, pois não depende de classes concretas.
 */
function clientCode(SocialNetworkPoster $creator)
{
    $creator->post("Olá Mundo!");
    $creator->post("Eu comi um hambúrguer grande esta manhã!");
}

/**
 * Durante a fase de inicialização, o aplicativo pode decidir com qual rede social deseja trabalhar, criar um objeto de
 * a subclasse apropriada e passe-a para o código do cliente.
 */
echo "Testando ConcreteCreator1:<br>";
clientCode(new FacebookPoster("john_smith", "******"));
echo "<br><br>";

echo "Testando ConcreteCreator2:<br>";
clientCode(new LinkedInPoster("john_smith@example.com", "******"));
~~~~
Fonte: https://refactoring.guru/pt-br/design-patterns/factory-method/php/example#lang-features
