<?php

namespace taskforce\parsing;
use SplFileObject;

class ParsingCategoriesToSql extends AbstractParsingToSql
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
            $query = "INSERT INTO categories (`name`, `icon`) VALUES ('$arrayIntoString[0]','$arrayIntoString[1]');";
            file_put_contents("$this->name.sql", $query, FILE_APPEND);
        }
    }

}
