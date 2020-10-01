<?php

namespace App\Criacao\Builder;

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
