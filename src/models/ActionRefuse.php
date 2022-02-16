<?php

namespace taskforce\models;

class ActionRefuse extends AbstractAction
{


    public function __construct()
    {
        $this->name = 'отказаться';
        $this->code = 'refuse';
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
        if ($task->status === Task::STATUS_IN_WORK & $task->executorId === $profileUser) {
            return true;
        }
    }

}
