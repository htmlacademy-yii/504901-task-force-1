<?php


namespace taskForce\classes;


class PublishAction extends AbstractAction
{
    const ACTION_PUBLISH = 'publish';

    /**
     * Возврат названия
     * @return string Имя класса
     */
    static function getTitle(): string
    {
        return __CLASS__;
    }

    /**
     * Возврат внутреннего имени
     * @return string Внутреннее имя
     */
    static function getName(): string
    {
        return self::ACTION_PUBLISH;
    }

    /**
     * проверка прав текущего пользователя
     * @param integer $id_customer Идентификатор заказчика
     * @param integer $id_executor Идентификатор исполнителя
     * @param integer $id_user Идентификатор текущего пользователя
     * @return bool Доступность действия
     */
    static function verify(int $id_customer, int $id_executor, int $id_user): bool
    {
        return $id_user === $id_customer;
    }
}
