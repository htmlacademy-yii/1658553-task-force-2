<?php

namespace taskforce\parsing;
use taskforce\exception;

/**
 * Класс переводщий SVC фромат sql
 */
abstract class AbstractParsingToSql
{
    public string $name;

    public function __construct($name)
    {
        $this->name = $name;
        if (!file_exists(__DIR__."/../../data/$this->name.csv")) {
            throw new exception\ParsingToSqlException('Такой файл не найден');
        }
    }

    public function deleteSqlFile()
    {
        if (file_exists(__DIR__."/../../$this->name.sql")) {
            return unlink(__DIR__."/../../$this->name.sql");
        }
        throw new exception\ParsingToSqlException('Файл не найден, удаление не возможно');
    }

    abstract public function copyToSql();



}
