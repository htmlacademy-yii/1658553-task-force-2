<?php

namespace taskforce\parsing;

use SplFileObject;
use taskforce\exception;

/**
 * Класс переводщий SVC фромат sql
 */
class ParsingToSql
{
    public string $name;

    public function __construct($name)
    {
        $this->name = $name;
        if (!file_exists(__DIR__."../../../data/$this->name.csv")) {
            throw new exception\ParsingToSqlException('Такой файл не найден');
        }
    }

    public function deleteSqlFile()
    {
        if (file_exists(__DIR__."../../../$this->name.sql")) {
            return unlink(__DIR__."../../../$this->name.sql");
        }
        throw new exception\ParsingToSqlException('Файл не найден, удаление не возможно');
    }


    public function copyToSql(string $tableName,)
    {
        $file = new SplFileObject(__DIR__."../../../data/$this->name.csv");
        for ($i = 1; $file->valid(); $i++) {
            $file->seek($i);
            $arrayIntoString = explode(',', $file->current());
            $query = "INSERT INTO cities (`name`, `coordinates`) VALUES ('$arrayIntoString[0]',
    POINT($arrayIntoString[1], $arrayIntoString[2]));";
            file_put_contents("$this->name.sql", $query, FILE_APPEND);
        }
    }


}
