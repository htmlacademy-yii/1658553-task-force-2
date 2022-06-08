<?php

namespace app\widgets\taskViewButtons\actions;

use yii\db\Exception;

class accessButtonsControl
{
    public const STATUS_NEW = 1;
    public const STATUS_CANCELLED = 2;
    public const STATUS_IN_WORK = 3;
    public const STATUS_DONE = 4;
    public const STATUS_FAILED = 5;

    public const ACTION_RESPOND = 'respond';
    public const ACTION_CANCEL = 'cancel';
    public const ACTION_DONE = 'done';
    public const ACTION_REFUSE = 'refuse';


    public int $customerId;
    public int $executorId;
    public string $status;

    public function __construct(string $status,int $customerId, int $executorId = null)
    {
        $this->executorId = $executorId;
        $this->customerId = $customerId;
        $this->status = $status;

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



    /**
     * Возвращает статус после определенного действия
     *
     * @param accessButtonsControl $task        Класс задачи
     * @param int  $profileUser id хозяина профиля
     *
     * @return string Доступный статус
     * @throws Exception
     */
    public function getNextStatus(accessButtonsControl $task, int $profileUser): string
    {
        if ((new ActionCancel())->isAvailable($task, $profileUser)) {
            return self::STATUS_CANCELLED;
        }
        if ((new ActionDone())->isAvailable($task, $profileUser)) {
            return self::STATUS_DONE;
        }
        if ((new ActionRefuse())->isAvailable($task, $profileUser)) {
            return self::STATUS_FAILED;
        }
        if ((new ActionRespond())->isAvailable($task, $profileUser)) {
            return self::STATUS_IN_WORK;
        }

        throw new Exception('такое действие не возможно???');
    }

    /**
     * возвращает список доступных действий из конкретного статуса
     *
     * @param accessButtonsControl $task Класс задачи
     *
     * @return array Доступные статусами
     * @throws Exception
     */
    public function getAvailableStatus(accessButtonsControl $task): array
    {
        if (!array_key_exists($task->status, $this->getStatusMap())) {
            throw new Exception('такого статуса нет');
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