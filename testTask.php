<?php
require_once('vendor/autoload.php');
use taskForce\models\Task;
$task = new Task(1,1);
assert($task->id_customer == 1 && $task->id_executor == 1);
$task1 = new Task(1);
assert($task1->id_customer == 1 && is_null($task1->id_executor));
assert($task->get_status(Task::ACTION_PUBLISH) == Task::STATUS_NEW);
assert($task->get_status(Task::ACTION_PERFORM) == Task::STATUS_PERFORMED);
assert($task->get_status(Task::ACTION_FAIL) == Task::STATUS_FAILED);
assert($task->get_status(Task::ACTION_ARTIST_SELECTION) == Task::STATUS_IN_WORK);
assert($task->get_status(Task::ACTION_CANCEL) == Task::STATUS_CANCELED);
$map_status = $task->map_status();
$status = [
    Task::STATUS_NEW => "Новое",
    Task::STATUS_CANCELED => "Отменено",
    Task::STATUS_IN_WORK => "В работе",
    Task::STATUS_PERFORMED => "Выполнено",
    Task::STATUS_FAILED => "Провалено"
];
assert($map_status == $status);
$actions = [
    Task::ACTION_PUBLISH => "Опубликовать",
    Task::ACTION_CANCEL => "Отмена",
    Task::ACTION_ARTIST_SELECTION => "Выбор исполнителя",
    Task::ACTION_PERFORM => "Завершить",
    Task::ACTION_FAIL => "Отказ от выполнения"
];
$map_actions = $task->map_actions();
assert($map_actions == $actions);
assert($task->get_available_actions(Task::STATUS_NEW) == [Task::ACTION_CANCEL, Task::ACTION_ARTIST_SELECTION]);
assert($task->get_available_actions(Task::STATUS_CANCELED) == []);
assert($task->get_available_actions(Task::STATUS_PERFORMED) == []);
assert($task->get_available_actions(Task::STATUS_FAILED) == []);
assert($task->get_available_actions(Task::STATUS_IN_WORK) == [Task::ACTION_FAIL, Task::ACTION_PERFORM]);

