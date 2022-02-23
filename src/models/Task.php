<?php

namespace taskforce\models;

use taskforce\exception;

class Task
{
    public const STATUS_NEW = 'new';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_IN_WORK = 'inWork';
    public const STATUS_DONE = 'done';
    public const STATUS_FAILED = 'failed';

    public const ACTION_RESPOND = 'respond';
    public const ACTION_CANCEL = 'cancel';
    public const ACTION_DONE = 'done';
    public const ACTION_REFUSE = 'refuse';


    public int $customerId;
    public int $executorId;
    public string $status;

    public function __construct(int $customerId, int $executorId = null)
    {
        $this->executorId = $executorId;
        $this->customerId = $customerId;
        $this->status = $status ?? self::STATUS_NEW;

        if (!array_key_exists($this->status, $this->getStatusMap())) {
            throw new exception\IncorrectStatusException('такого статуса нет');
        }
        if ($this->executorId === $this->customerId) {
            throw new exception\ExecutorIsCustomerException('заказчик не может быть исполнителем');
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

    /**
     * возвращает карту действий
     *
     *
     */
    public function getActionMap(): array
    {
        return [
            new ActionCancel(),
            new ActionDone(),
            new ActionRefuse(),
            new ActionRespond(),
        ];
    }

    /**
     * Возвращает статус после определенного действия
     *
     * @param Task $task        Класс задачи
     * @param int  $profileUser id хозяина профиля
     *
     * @return string Доступный статус
     * @throws exception\IncorrectActionException
     */
    public function getNextStatus(Task $task, int $profileUser): string
    {
        if ((new ActionCancel())->isAvailable($task, $profileUser)) {
            return $this->status = self::STATUS_CANCELLED;
        }
        if ((new ActionDone())->isAvailable($task, $profileUser)) {
            return $this->status = self::STATUS_DONE;
        }
        if ((new ActionRefuse())->isAvailable($task, $profileUser)) {
            return $this->status = self::STATUS_FAILED;
        }
        if ((new ActionRespond())->isAvailable($task, $profileUser)) {
            return $this->status = self::STATUS_IN_WORK;
        }

         throw new exception\IncorrectActionException('такое действие не возможно???');
    }

    /**
     * возвращает список доступных действий из конкретного статуса
     *
     * @param Task $task Класс задачи
     *
     * @return array Доступные статусами
     * @throws exception\IncorrectStatusException
     */
    public function getAvailebleStatus(Task $task): array
    {
        if (!array_key_exists($task->status, $this->getStatusMap())) {
            throw new exception\IncorrectStatusException('такого статуса нет');
        }
        $data = [
            self::STATUS_NEW     => [
                self::ACTION_RESPOND,
                self::ACTION_CANCEL,
            ],
            self::STATUS_IN_WORK => [
                self::ACTION_DONE,
                self::ACTION_REFUSE,
            ],
        ];

        return $data[$task->status] ?? [];
    }

}




