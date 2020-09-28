## PADRÃO ABSTRACT FACTORY

##### Objetivo
Fornecer uma interface para criação de grupos de objetos relacionados aos dependentes sem especificar suas classes concretas.

##### Contexto
Produtos portáveis utilizam o conceito abstrato deste padrão para desvincular código fundamental da aplicação de recursos que são dependentes da plataforma.

##### Estrutura
- AbstractFactory: declara uma interface para operações que criam objetos abstratos;
- ConcreteFactory: implementa operações específicas para criar objetos concretos;
- AbstractProduct: declara uma interface para cada tipo de objeto;
- ConcreteProduct: implementa uma interface de AbstractProduct para definir um objeto que pode ser criado por sua ConcreteFactory correspondente;
- Client: utiliza as interfaces declaradas pelo AbstractFactory e AbstractProduct sem se preocupar com as implementações concretas.

##### Aplicabilidade
- Um sistema deve ser independente do modo como seus objetos são criados, compostos e representados;
- Um sistema deve ser configurado com vários grupos distintos de objetos;
- Alguns objetos relacionados formam projetados para serem utilizados em conjunto, e você precisa impor essa restrição;
- Você quer fornecer uma biblioteca de classes e pretende revelar apenas suas interfaces, não suas implementações.
