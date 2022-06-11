<?php

namespace app\widgets\taskViewButtons\actions;


use app\models\Tasks;
use yii\db\Exception;

class AccessButtonsControl
{
    public const STATUS_NEW = '1';
    public const STATUS_CANCELLED = '2';
    public const STATUS_IN_WORK = '3';
    public const STATUS_DONE = '4';
    public const STATUS_FAILED = '5';

    public const ACTION_RESPOND = 'respond';
    public const ACTION_CANCEL = 'cancel';
    public const ACTION_DONE = 'done';
    public const ACTION_REFUSE = 'refuse';


    public int $customerId;
    public  $executorId;
    public string $status;
    public object $task;

    public function __construct(Tasks $task)
    {

        $this->executorId = $task->executor_id;
        $this->customerId = $task->customer_id;
        $this->status = $task->status;
        $this->task = $task;

        if (!array_key_exists($this->status, $this->getStatusMap())) {
            throw new Exception('такого статуса нет');
        }
        if ($this->executorId === $this->customerId) {
            throw new Exception('заказчик не может быть исполнителем');
        }
    }

    /**
     * Возвращает карту статусов
     *
     * @return string[] Карта статусов
     */
    public function getStatusMap(): array
    {
        return [
            self::STATUS_NEW       => 'новое',
            self::STATUS_CANCELLED => 'отмененное',
            self::STATUS_IN_WORK   => 'в работе',
            self::STATUS_DONE      => 'выполнено',
            self::STATUS_FAILED    => 'провалено',
        ];
    }




}