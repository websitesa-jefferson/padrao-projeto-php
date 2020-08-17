## 5 - DEPENDENCY INVERSION PRINCIPLE (PRINCÍPIO DE INVERSÃO DE DEPENDÊNCIA)

O último e quinto princípio diz para que uma classe dependa de uma abstração e não de uma implementação.

##### Ferindo o princípio de inversão de dependência
Criaremos uma classe para gerenciar relatórios.
~~~~
<?php

class Email
{
    public function enviar($mensagem)
    {
        //lógica
    }
}

class Notificacao
{
    public __construct()
    {
        $this->mensagem = new Email();
    }

    public function enviar($mensagem)
    {
        $this->mensagem->enviar($mensagem)
    }
}
~~~~
Neste exemplo, temos o que chamamos de acoplamento e uma dependência da classe Notificação cria uma instancia da classe Email dentro dela.

E o metodo enviar faz a utilização da classe Email para enviar a notificação por e-mail.

Isso fere o princípio da inversão da dependência, porque não desenvolvemos a classe Notificação para uma abstração, e sim para uma implementação já que classe E-mail implementa a lógica para o envio do e-mail.

##### Aplicando o princípio de inversão de dependência
~~~~
<?php

interface MensagemInterface
{
    public function enviar($mensagem);
}

class Email implements MensagemInterface
{
    public function enviar($mensagem)
    {
        //lógica
    }
}

class Notificacao
{
    public __construct(MensagemInterface $mensagem)
    {
        $this->mensagem = $mensagem;
    }

    public function enviar($mensagem)
    {
        $this->mensagem->enviar($mensagem)
    }
}
~~~~
Agora desacoplamos a classe E-mail da classe Notificação estamos trabalhando com a abstração MensagemInterface, para Notificação não importa qual classe você está usando, e sim, que ela implemente a interface MensagemInterface porque sabemos que ela vai ter o método enviar que precisamos.

Isso também permite que a classe Notificação use outras classes que implementem a interface MensagemInterface.
