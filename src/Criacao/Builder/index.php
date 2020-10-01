<?php

use App\Criacao\Builder\SQLQueryBuilder;
use App\Criacao\Builder\MysqlQueryBuilder;
use App\Criacao\Builder\PostgresQueryBuilder;

require __DIR__.'/../../bootstrap.php';

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
