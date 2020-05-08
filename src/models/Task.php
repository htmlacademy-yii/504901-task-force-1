<?php
namespace taskForce\models;
class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_IN_WORK = 'in_work';
    const STATUS_PERFORMED = 'performed';
    const STATUS_FAILED = 'failed';
    const ACTION_PUBLISH = 'publish';
    const ACTION_CANCEL = 'cancel';
    const ACTION_ARTIST_SELECTION = 'artist_selection';
    const ACTION_PERFORM = 'perform';
    const ACTION_FAIL = 'fail';

    public $id_customer = null;
    public $id_executor = null;
    public $current_status = null;

    public function __construct($id_customer, $id_executor = null)
    {
        $this->id_customer = $id_customer;
        $this->id_executor = $id_executor;
    }

    /**
     * Получить статус после выполнения указанного действия
     * @param  string $action Действие
     * @return string статус
     */
    public function get_status($action)
    {
        switch ($action)
        {
            case self::ACTION_PUBLISH : return self::STATUS_NEW;
            case self::ACTION_CANCEL : return self::STATUS_CANCELED;
            case self::ACTION_ARTIST_SELECTION : return self::STATUS_IN_WORK;
            case self::ACTION_PERFORM : return self::STATUS_PERFORMED;
            case self::ACTION_FAIL : return self::STATUS_FAILED;
        }
        return null;
    }

    /**
     * Получить названия статусов
     * @return array Ассоциативный массив названий статусов
     */
    public function map_status()
    {
        return [
            self::STATUS_NEW => "Новое",
            self::STATUS_CANCELED => "Отменено",
            self::STATUS_IN_WORK => "В работе",
            self::STATUS_PERFORMED => "Выполнено",
            self::STATUS_FAILED => "Провалено"
        ];
    }

    /**
     * Получить названия действий
     * @return array Ассоциативный массив названий действий
     */
    public function map_actions()
    {
        return [
            self::ACTION_PUBLISH => "Опубликовать",
            self::ACTION_CANCEL => "Отмена",
            self::ACTION_ARTIST_SELECTION => "Выбор исполнителя",
            self::ACTION_PERFORM => "Завершить",
            self::ACTION_FAIL => "Отказ от выполнения"
        ];
    }

    /**
     * Получить доступные действия
     * @param string $status Статус
     * @return array массив действий
     */
    public function get_available_actions($status)
    {
        switch ($status)
        {
            case self::STATUS_NEW :       return [self::ACTION_CANCEL, self::ACTION_ARTIST_SELECTION];
            case self::STATUS_CANCELED :
            case self::STATUS_PERFORMED :
            case self::STATUS_FAILED :    return [];
            case self::STATUS_IN_WORK :   return [self::ACTION_FAIL, self::ACTION_PERFORM];
        }
        return null;
    }

}

