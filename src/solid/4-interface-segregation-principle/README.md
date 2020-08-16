## 4 - SEGREGATION INTERFACE PRINCIPLE (PRINCÍPIO DE SEGREGAÇÃO DE INTERFACE)

O quarto princípio diz que muitas interfaces específicas são melhores que uma única interface para não forçar uma classe a implementar um método que ela não vai usar.

Precisamos criar pequenas interfaces mais específicas ao invés de termos uma única genérica.

##### Ferindo o princípio da segregação de interface
Criaremos uma classe de aves.
~~~~
<?php

interface Aves
{
    public function andar();
    public function voar();
    public function nadar();
}

class Pato implements Aves
{
    public function voar()
    {
        //lógica
    }

    public function nadar()
    {
        //lógica
    }

    public function andar()
    {
        //lógica
    }
}

class Pinguim implements Aves
{
    public function voar()
    {
        //lógica
    }

    public function nadar()
    {
        //lógica
    }

    public function andar()
    {
        //lógica
    }
}

class Andorinha implements Aves
{
    public function voar()
    {
        //lógica
    }

    public function nadar()
    {
        //lógica
    }

    public function andar()
    {
        //lógica
    }
}
~~~~
Nessa estrutura estamos forçando algumas aves a implementar alguns métodos que elas não deveriam possuir.

Isso porque existem aves que não voam e aves que não nadam.

Como o Pinguim, que implementou o método voar já que pinguins não voam.

E o mesmo para a Andorinha, que não nada.

##### Aplicando o princípio da segregação de interface
~~~~
<?php

interface Aves
{
    public function andar();
}

interface AvesQueVoam extends Aves
{
    public function voar();
}

interface AvesQueNadam extends Aves
{
    public function nadar();
}

class Pato implements AvesQueVoam, AvesQueNadam
{
    public function voar()
    {
        //lógica
    }

    public function nadar()
    {
        //lógica
    }

    public function andar()
    {
        //lógica
    }
}

class Pinguim implements AvesQueNadam
{
    public function nadar()
    {
        //lógica
    }

    public function andar()
    {
        //lógica
    }
}

class Andorinha implements AvesQueVoam
{
    public function andar()
    {
        //lógica
    }

    public function voar()
    {
        //lógica
    }
}
~~~~
Agora, sim. Temos as interfaces AvesQueVoam, AvesQueNadam ao invés de somente uma interface Aves.
