<?php

namespace taskforce\parsing;
use SplFileObject;

class ParsingCitySql extends AbstractParsingToSql
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function copyToSql()
    {
        $file = new SplFileObject(__DIR__."/../../data/$this->name.csv");
        for ($i = 1; $file->valid(); $i++) {
            $file->seek($i);
            $arrayIntoString = explode(',', $file->current());
            $query = "INSERT INTO cities (`name`, `coordinates`) VALUES ('$arrayIntoString[0]',
    POINT($arrayIntoString[1], $arrayIntoString[2]));";
            file_put_contents("$this->name.sql", $query, FILE_APPEND);
        }
    }

}
