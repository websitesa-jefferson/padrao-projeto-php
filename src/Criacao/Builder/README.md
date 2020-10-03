## PADRÃO BUILDER

##### Objetivo
Permitir construir objetos complexos passo a passo.  
O padrão permite produzir diferentes tipos e representações de um objeto usando o mesmo código de construção.

##### Contexto
Sistema capaz de gerar ações indeterminadas para uma única aplicação, utilizam a estrutura modular deste padrão para permitir a implementação do soluções alternativas que utilizem de uma fonte única.

##### Estrutura
- Builder: especifica uma interface abstrata para a criação de módulos do sistema;
- ConcreteBuilder: cria e executa móudulos através da interface Builder, controla a representação criada e fornece um meio obtenção dos resultados;
- Director: constroi o objeto principal utilizando a interface Builder;
- Product: prepresenta um módulo alternativo que inclui interfaces para geração do resultado final;

##### Aplicabilidade
- O processo e construção deve permitir diferentes representações para o objeto contruído.

~~~~
/**
 * A interface Builder declara um conjunto de métodos para montar uma consulta SQL.
 * Todas as etapas de construção estão retornando o objeto construtor atual para permitir o encadeamento:
 * $ builder-> select (...) -> where (...)
 */
interface SQLQueryBuilder
{
    public function select(string $table, array $fields): SQLQueryBuilder;

    public function where(string $field, string $value, string $operator = '='): SQLQueryBuilder;

    public function limit(int $start, int $offset): SQLQueryBuilder;

    // +100 outros métodos de sintaxe SQL ...

    public function getSQL(): string;
}

/**
 * Cada construtor concreto corresponde a um dialeto SQL específico e pode implementar os passos do construtor um pouco
 * diferente dos outros.
 * Este construtor concreto pode construir consultas SQL compatíveis com MySQL.
 */
class MysqlQueryBuilder implements SQLQueryBuilder
{
    protected $query;

    protected function reset(): void
    {
        $this->query = new \stdClass();
    }

    /**
     * Crie uma consulta SELECT de base.
     */
    public function select(string $table, array $fields): SQLQueryBuilder
    {
        $this->reset();
        $this->query->base = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        $this->query->type = 'select';

        return $this;
    }

    /**
     * Adicione uma condição WHERE.
     */
    public function where(string $field, string $value, string $operator = '='): SQLQueryBuilder
    {
        if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new \Exception("WHERE só pode ser adicionado a SELECT, UPDATE OR DELETE");
        }
        $this->query->where[] = "$field $operator '$value'";

        return $this;
    }

    /**
     * Adicione uma restrição LIMIT.
     */
    public function limit(int $start, int $offset): SQLQueryBuilder
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("LIMIT can only be added to SELECT");
        }
        $this->query->limit = " LIMIT " . $start . ", " . $offset;

        return $this;
    }

    /**
     * Obtenha a string de consulta final.
     */
    public function getSQL(): string
    {
        $query = $this->query;
        $sql = $query->base;
        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }
        if (isset($query->limit)) {
            $sql .= $query->limit;
        }
        $sql .= ";";
        return $sql;
    }
}

/**
 * Este Concrete Builder é compatível com PostgreSQL.
 * Embora o Postgres seja muito semelhante ao Mysql, ainda tem vários diferenças.
 * Para reutilizar o código comum, nós o estendemos do construtor MySQL, enquanto sobrescrevemos algumas das etapas de construção.
 */
class PostgresQueryBuilder extends MysqlQueryBuilder
{
    /**
     * Entre outras coisas, o PostgreSQL tem uma sintaxe LIMIT ligeiramente diferente.
     */
    public function limit(int $start, int $offset): SQLQueryBuilder
    {
        parent::limit($start, $offset);

        $this->query->limit = " LIMIT " . $start . " OFFSET " . $offset;

        return $this;
    }
}

/**
 * Observe que o código do cliente usa o objeto construtor diretamente.
 * Uma classe Director designada não é necessária neste caso, porque o código do cliente quase precisa de consultas
 * diferentes todas as vezes, então a sequência das etapas de construção não pode ser facilmente reutilizada.
 *
 * Como todos os nossos construtores de consulta criam produtos do mesmo tipo (que é uma string), podemos interagir com
 * todos os construtores usando sua interface comum.
 * Posteriormente, se implementarmos uma nova classe Builder, seremos capazes de passar sua instância para o código do
 * cliente existente sem quebrando-o graças à interface SQLQueryBuilder.
 */
function clientCode(SQLQueryBuilder $queryBuilder)
{
    $query = $queryBuilder
        ->select("users", ["name", "email", "password"])
        ->where("age", 18, ">")
        ->where("age", 30, "<")
        ->limit(10, 20)
        ->getSQL();

    echo $query;
}

/**
 * O aplicativo seleciona o tipo de construtor de consulta adequado, dependendo da configuração atual ou das configurações do ambiente.
 */
// if ($_ENV['database_type'] == 'postgres') {
//     $builder = new PostgresQueryBuilder(); } else {
//     $builder = new MysqlQueryBuilder(); }
//
// clientCode($builder);

echo "Testando o construtor de consulta MySQL:<br>";
clientCode(new MysqlQueryBuilder());

echo "<br><br>";

echo "Testando o construtor de consulta PostgresSQL:<br>";
clientCode(new PostgresQueryBuilder());
~~~~

Fonte: https://refactoring.guru/pt-br/design-patterns/builder/php/example#lang-features
