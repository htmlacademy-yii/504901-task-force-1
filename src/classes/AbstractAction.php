<?php

namespace taskForce\classes;

abstract class AbstractAction
{

    /**
     * Возврат названия
     * @return string Имя класса
     */
    abstract static function getTitle(): string;

    /**
     * Возврат внутреннего имени
     * @return string Внутреннее имя
     */
    abstract static function getName(): string;

    /**
     * проверка прав текущего пользователя
     * @param integer $id_customer Идентификатор заказчика
     * @param integer $id_executor Идентификатор исполнителя
     * @param integer $id_user Идентификатор текущего пользователя
     * @return bool Доступность действия
     */
    abstract static function verify(int $id_customer, int $id_executor, int $id_user): bool;

}

