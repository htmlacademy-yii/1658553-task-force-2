<?php

namespace taskforce\models;

abstract class AbstractAction
{
    protected string $name;
    protected string $code;

    public function getName()
    {
        return $this->name;
    }


    public function getCode()
    {
        return $this->code;
    }

    abstract function isAvailable(Task $task, int $profileUser);

}
