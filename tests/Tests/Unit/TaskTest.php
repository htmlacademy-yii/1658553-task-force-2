<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use taskforce\models\Task;
use taskforce\exception;





class TaskTest extends TestCase
{

    /**
     * Тестирование статусов после конкретного действия
     */
    public function testGetNextStatusException()
    {

        $task = new Task(1, 2);
        $task->status='notExistingStatus';
        $this->expectException(exception\IncorrectActionException::class);
        $task->getNextStatus($task, 1);


    }
    public function testGetNextStatusCancel()
    {

        $task = new Task(1, 2);
        $status = $task->getNextStatus($task,1);
        $this->assertEquals('cancelled', $status);

    }



    public function testGetNextStatusDone()
    {
        $task = new Task(1, 2);
        $task->status='inWork';
        $status = $task->getNextStatus($task,1);
        $this->assertEquals('done', $status);
    }


    public function testGetNextStatusFailed()
    {
        $task = new Task(1, 2);
        $task->status='inWork';
        $status = $task->getNextStatus($task,2);
        $this->assertEquals('failed', $status);
    }

    public function testGetNextStatusInWork()
    {
        $task = new Task(1, 2);
        $status = $task->getNextStatus($task,2);
        $this->assertEquals('inWork', $status);
    }

    /**
     * тестирование доступных действий от конкретного статуса
     */
    public function testGetAvailebleStatusException()
    {

        $task = new Task(1, 2);
        $task->status='notExistingStatus';
        $this->expectException(exception\IncorrectStatusException::class);
        $task->getAvailebleStatus($task);


    }
    public function testGetAvailebleStatusNewRespond()
    {

        $task = new Task(1, 2);
        $status = $task->getAvailebleStatus($task);
        $this->assertEquals('respond', $status[0]);

    }

    public function testGetAvailebleStatusNewCancel()
    {
        $task = new Task(1, 2);
        $status = $task->getAvailebleStatus($task);
        $this->assertEquals('cancel', $status[1]);
    }

    public function testGetAvailebleStatusWorkDone()
    {
        $task = new Task(1, 2);
        $task->status = 'inWork';
        $status = $task->getAvailebleStatus($task);
        $this->assertEquals('done', $status[0]);
    }

    public function testGetAvailebleStatusWorkRefuse()
    {
        $task = new Task(1, 2);
        $task->status = 'inWork';
        $status = $task->getAvailebleStatus($task);
        $this->assertEquals('refuse', $status[1]);
    }

};
