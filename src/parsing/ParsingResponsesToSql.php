<?php

namespace taskforce\parsing;

use SplFileObject;
use taskforce\exception;

class ParsingResponsesToSql extends AbstractParsingToSql
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function copyToSql()
    {
        if (file_exists(__DIR__."/../../$this->name.sql")) {
            throw new exception\ParsingToSqlException('Такой уже существует');
        }
        $file = new SplFileObject(__DIR__."/../../data/$this->name.csv");
        for ($i = 1; $file->valid(); $i++) {
            $file->seek($i);
            if ($file->current()) {
                $arrayIntoString = explode(',', $file->current());
                $trimData = [];
                foreach ($arrayIntoString as $key=>$value){
                    $trimData[] = trim($value);
                }
                $query
                    = "INSERT INTO responses (`task_id`,`executor_id`,`price`,`comment`,`rejected`,`create_time`) VALUES
                ('$trimData[0]','$trimData[1]','$trimData[2]','$trimData[3]',
                 '$trimData[4]','$trimData[5]');";
                file_put_contents("$this->name.sql", $query, FILE_APPEND);
            }
        }
    }
}
