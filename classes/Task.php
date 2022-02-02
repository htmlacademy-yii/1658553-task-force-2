<?php

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


    private int $customerId;
    private int $executorId;
    public string $status;

    public function __construct(int $customerId, int $executorId = null)
    {
        $this->executorId = $executorId;
        $this->customerId = $customerId;
        $this->status = $status ?? self::STATUS_NEW;
    }

    /**
     * Возвращает карту статусов
     *
     * @return string[] Карта статусов
     */
    public function getStatusMap()
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
     * @return string[] Карта действий
     */
    public function getActionMap()
    {
        return [
            self::ACTION_CANCEL  => 'отменить',
            self::ACTION_DONE    => 'завершить',
            self::ACTION_REFUSE  => 'отказаться',
            self::ACTION_RESPOND => 'откликнуться',
        ];
    }

    /**
     * Возвращает статус после определенного действия
     *
     * @param string $action Действие
     *
     * @return string Доступный статус
     */
    public function getNextStatus(string $action): string
    {
        $data = [
            self::ACTION_CANCEL  => self::STATUS_CANCELLED,
            self::ACTION_DONE    => self::STATUS_DONE,
            self::ACTION_REFUSE  => self::STATUS_FAILED,
            self::ACTION_RESPOND => self::STATUS_IN_WORK,

        ];

        return $data[$action] ?? '';
    }

    /**
     * возвращает список доступных действий из конкретного статуса
     *
     * @param string $status статус
     *
     * @return array  Доступные статусами
     */
    public function getAvailebleStatus(string $status): array
    {
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

        return $data[$status] ?? [];
    }

}




