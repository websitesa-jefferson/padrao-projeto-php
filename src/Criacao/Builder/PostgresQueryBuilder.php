<?php

namespace App\Criacao\Builder;

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
