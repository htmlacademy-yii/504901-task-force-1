<?php

namespace taskForce\task;

class TaskActions
{
    const ACTION_CANCEL = 'customerCancel';
    const ACTION_START = 'customerStart';
    const ACTION_FINISH = 'customerFinish';
    const ACTION_REJECT = 'executorReject';
    const ACTION_REACT = 'executorReact';

    public static function getActionsMap(): array
    {
        return [
            self::ACTION_CANCEL => 'Заказчик отменил задание',
            self::ACTION_START => 'Заказчик выбрал исполнителя для задания',
            self::ACTION_FINISH => 'Заказчик отметил задание как выполненное',
            self::ACTION_REJECT => 'Исполнитель отказался от выполнения задания',
            self::ACTION_REACT => 'Исполнитель откликнулся на задание'
        ];
    }
}