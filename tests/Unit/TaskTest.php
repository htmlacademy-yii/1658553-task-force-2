<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use src\models\Task;



class TaskTest extends TestCase
{
    /**
     * Тестирование статусов после конкретного действия
     */
    public function testGetNextStatusCancel()
    {
        $task = new Task(1, 2);
        $status = $task->getNextStatus('cancel');

        $this->assertEquals('cancelled', $status);
    }

    public function testGetNextStatusDone()
    {
        $task = new Task(1, 2);
        $status = $task->getNextStatus('done');

        $this->assertEquals('done', $status);
    }

    public function testGetNextStatusFailed()
    {
        $task = new Task(1, 2);
        $status = $task->getNextStatus('refuse');

        $this->assertEquals('failed', $status);
    }

    public function testGetNextStatusInWork()
    {
        $task = new Task(1, 2);
        $status = $task->getNextStatus('respond');

        $this->assertEquals('inWork', $status);
    }

    /**
     * тестирование доступных действий от конкретного статуса
     */
    public function testGetAvailebleStatusNewRespond()
    {
        $task = new Task(1, 2);
        $status = $task->getAvailebleStatus('new');
        $this->assertEquals('respond', $status[0]);
    }

    public function testGetAvailebleStatusNewCancel()
    {
        $task = new Task(1, 2);
        $status = $task->getAvailebleStatus('new');
        $this->assertEquals('cancel', $status[1]);
    }

    public function testGetAvailebleStatusWorkDone()
    {
        $task = new Task(1, 2);
        $status = $task->getAvailebleStatus('inWork');
        $this->assertEquals('done', $status[0]);
    }

    public function testGetAvailebleStatusWorkRefuse()
    {
        $task = new Task(1, 2);
        $status = $task->getAvailebleStatus('inWork');
        $this->assertEquals('refuse', $status[1]);
    }

}
