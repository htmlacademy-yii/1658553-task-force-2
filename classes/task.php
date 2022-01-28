<?php

require_once '../config/config.php';
require_once 'constants.php';

class task
{

    private int $client;
    private int $contractor;
    public string $status;

    public function __construct(int $contractor, int $client)
    {
        $this->contractor = $contractor;
        $this->client = $client;
        $this->status = task_statuses::STATUS_NEW;
    }

    /**
     * Возвращает карту статусов
     *
     * @return string[] Карта статусов
     */
    public function get_status_map()
    {
        return [
            task_statuses::STATUS_NEW       => 'новое',
            task_statuses::STATUS_CANCELLED => 'отмененное',
            task_statuses::STATUS_IN_WORK   => 'в работе',
            task_statuses::STATUS_DONE      => 'выполнено',
            task_statuses::STATUS_FAILED    => 'провалено',
        ];
    }

    /**
     * возвращает карту действий
     *
     * @return string[] Карта действий
     */
    public function get_action_map()
    {
        return [
            task_actions::ACTION_CANCEL  => 'отменить',
            task_actions::ACTION_DONE    => 'выполнено',
            task_actions::ACTION_REFUSE  => 'отказаться',
            task_actions::ACTION_RESPOND => 'откликнуться',
        ];
    }

    /**
     * Возвращает статус после определенного действия
     * @param string $action Действие
     *
     * @return string Доступный статус
     */
    public function get_next_status(string $action): string
    {
        $data = [
            task_actions::ACTION_CANCEL  => task_statuses::STATUS_CANCELLED,
            task_actions::ACTION_DONE    => task_statuses::STATUS_DONE,
            task_actions::ACTION_REFUSE  => task_statuses::STATUS_FAILED,
            task_actions::ACTION_RESPOND => task_statuses::STATUS_IN_WORK,

        ];

        return $data[$action] ?? '';
    }

    /**
     * возвращает список доступных статусов из конкретного статуса
     * @param string $status статус
     *
     * @return array  Доступные статусами
     */
    public function get_availeble_status(string $status): array
    {
        $data = [
            task_statuses::STATUS_NEW     => [
                task_actions::ACTION_RESPOND,
                task_actions::ACTION_CANCEL,
            ],
            task_statuses::STATUS_IN_WORK => [
                task_actions::ACTION_DONE,
                task_actions::ACTION_REFUSE,
            ],
        ];

        return $data[$status] ?? [];
    }

}

$task = new task(1, 2);
var_dump($task->get_availeble_status($task->status));


