<?php

namespace app\widgets\taskViewButtons\actions;


class ActionCancel extends AbstractAction
{


    public function __construct()
    {
        $this->name = 'Отменить';
        $this->code = 'cancel';
    }


    public function isAvailable(accessButtonsControl $task, int $profileUser):bool
    {
        if ($task->status === accessButtonsControl::STATUS_NEW && $task->customerId === $profileUser) {
            return true;
        }
        return false;
    }

}
