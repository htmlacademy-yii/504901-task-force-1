<?php

namespace taskForce\classes;

use frontend\models\Task;
use taskForce\task\TaskActions;
use taskForce\task\TaskStatuses;


class CancelAction extends AbstractAction
{
    const ACTION_CANCEL = 'cancel';
    const ACTION_CANCEL_TITLE = 'Отмена';

    /**
     * Возврат названия
     * @return string Название действия
     */
    static function getTitle(): string
    {

        return self::ACTION_CANCEL_TITLE;
    }

    /**
     * Возврат внутреннего имени
     * @return string Внутреннее имя
     */
    static function getName(): string
    {

        return self::ACTION_CANCEL;
    }

    /**
     * проверка прав текущего пользователя
     * @param integer $id_user Идентификатор текущего пользователя
     * @param Tasks $task Текущая задача
     * @return bool Доступность действия
     */
    static function verify(Tasks $task, int $userId): bool
    {

        if ($task->status_id !== TaskStatuses::STATUS_NEW) {
            return false;
        }

        if (isset($task->executor_id)) {
            return false;
        }

        return $userId === $task->owner_id;
        
    }
}
