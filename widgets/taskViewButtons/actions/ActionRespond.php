<?php

namespace app\widgets\taskViewButtons\actions;

class ActionRespond extends AbstractAction
{


    public function __construct()
    {
        $this->name = 'откликнуться';
        $this->code = 'respond';
    }


    public function isAvailable(accessButtonsControl $task, int $profileUser): bool
    {
        if ($task->status === accessButtonsControl::STATUS_NEW && $task->executorId === null) {
            return true;
        }

        return false;
    }

}
