<?php

namespace app\widgets\taskViewButtons\actions;

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

    abstract function isAvailable(accessButtonsControl $task, int $profileUser);

}
