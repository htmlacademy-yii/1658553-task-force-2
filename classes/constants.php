<?php

/**
 * Константы для статусов задания
 */
class task_statuses
{
    public const STATUS_NEW = 'new';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_IN_WORK = 'in_work';
    public const STATUS_DONE = 'done';
    public const STATUS_FAILED = 'failed';
}

/**
 * Константы для действий задания
 */
class task_actions
{
    public const ACTION_RESPOND = 'respond';
    public const ACTION_CANCEL = 'cancel';
    public const ACTION_DONE = 'done';
    public const ACTION_REFUSE = 'refuse';
}
