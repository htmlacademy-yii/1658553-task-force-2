<?php

namespace taskforce\models;

class ActionRespond extends AbstractAction
{


    public function __construct()
    {
        $this->name = 'откликнуться';
        $this->code = 'respond';
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function isAction(task $task, int $profileUser)
    {
        if ($task->status === Task::STATUS_NEW & $task->executorId === $profileUser) {
            return true;
        }
    }

}
