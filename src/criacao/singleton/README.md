## PADRÃO SINGLETON

##### Objetivo
Garantir que uma classe tenha somente uma instância e fornecer um ponto global de acesso a ela.

##### Contexto
Restringir o acesso a recursos limitados e compartilhados pelo sistema, exemplo: conexão com banco de dados.

##### Estrutura
Possui apenas um item chamado Singleton.

##### Aplicabilidade
- Quando deve haver somente uma instância dessa classe em qualquer ponto do sistema.
- Quando a instância única deve ser extensível através de subclasses e os clientes devem ser capazes de usar uma instância estendida sem modificar seu código.
