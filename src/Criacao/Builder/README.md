## PADRÃO SINGLETON

##### Objetivo
Separar a construção de um objeto complexo da sua representação, de modo que o mesmo processo de construção possa criar diferentes representações.

##### Contexto
Sistema capaz de gerar ações indeterminadas para uma única aplicação, utilizam a estrutura modular deste padrão para permitir a implementação do soluções alternativas que utilizem de uma fonte única.

##### Estrutura
Builder: especifica uma interface abstrata para a criação de módulos do sistema;
ConcreteBuilder: cria e executa móudulos através da interface Builder, controla a representação criada e fornece um meio obtenção dos resultados;
Director: constroi o objeto principal utilizando a interface Builder;
Product: prepresenta um módulo alternativo que inclui interfaces para geração do resultado final;

##### Aplicabilidade
- O processo e construção deve permitir diferentes representações para o objeto contruído.
