<?php


namespace taskForce\classes;


class PublishAction extends AbstractAction
{
    const ACTION_PUBLISH = 'publish';
    const ACTION_PUBLISH_TITLE = 'Опубликовать';

    /**
     * Возврат названия
     * @return string Название действия
     */
    static function getTitle(): string
    {

        return self::ACTION_PUBLISH_TITLE;
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
