## 2 - OPEN-CLOSED PRINCIPLE (PRINCÍPIO ABERTO-FECHADO)

O segundo princípio diz que você deve ser capaz de estender um comportamento de uma classe, sem modificá-lo.

A classe está aberta para expansão e fechada para alteração.

Sempre que precisarmos criar um novo recurso, devemos criar uma nova classe que implemente esse recurso.

#### Ferindo o princípio aberto-fechado
Criaremos uma classe de sistema tributário simplificado.
~~~~
<?php

class Impostometro
{
    public $valor_impostos;

    public function somar($item)
    {
        if ($item instanceof Produto) {
            $this->valor_impostos += $item->getValorICMS();
        } elseif ($item instanceof Servico) {
            $this->valor_impostos += $item->getValorISS();
        } else {
            throw new NotImplementedException('Não é possível calcular os impostos de "' . $item::CLASS . '"');
        }
    }
}
~~~~
Nessa classe, tudo que se paga hoje é o ICMS sobre produtos e ISS sobre serviços:

Agora, se quisermos adicionar um imposto sobre produto importado na classe atual, ficaria da seguinte forma:
~~~~
<?php

class ProdutoImportado extends Produto
{
    ...
}

class Impostometro
{
    public $valor_impostos;

    public function somar($item)
    {
        if ($item instanceof Produto) {
            $this->valor_impostos += $item->getValorICMS();
            if ($item instanceof ProdutoImportado) {
                $this->valor_impostos += $item->getValorII();
            }
        } elseif ($item instanceof Servico) {
            $this->valor_impostos += $item->getValorISS();
        } else {
            throw new NotImplementedException('Não é possível calcular os impostos de "' . $item::CLASS . '"');
        }
    }
}
~~~~
Para inserir o novo imposto, foi preciso alterar a classe Impostometro, porém, a classe deve estar fechada para alteração.

#### Aplicando o princípio aberto-fechado (utilizando o design pattern Strategy)
~~~~
<?php

interface Tributavel
{
    public function getValorImpostos();
}

class Servico implements Tributavel
{
    public function getValorImpostos()
    {
        return 10;
    }
}

class Produto implements Tributavel
{
    public function getValorImpostos()
    {
        return 20;
    }
}

class ProdutoImportado extends Produto
{
    public function getValorImpostos()
    {
        return parent::getValorImpostos() + 5;
    }
}

class Impostometro
{
    public $valor_impostos;

    public function somar(Tributavel $item)
    {
        $this->valor_impostos += $item->getValorImpostos();
        return $this->valor_impostos;
    }
}

$produto = new Produto();
$servico = new Servico();
$produtoImportado = new ProdutoImportado();

$imposto = new Impostometro();

echo $imposto->somar($produto)."<br>"; // 20
echo $imposto->somar($servico)."<br>"; // 30
echo $imposto->somar($produtoImportado); // 55
~~~~
Agora a classe do impostômetro não precisa mais saber quais métodos chamar para somar os impostos.

Ela pode receber qualquer novo item que seja criado no futuro e, desde que ele implemente a interface, ela será capaz de somar os impostos adequadamente.
