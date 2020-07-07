<?php
require_once('vendor/autoload.php');

use taskForce\classes\CancelAction;
use taskForce\classes\FailAction;
use taskForce\classes\PerformAction;
use taskForce\classes\PublishAction;
use taskForce\classes\SelectAction;
use taskForce\classes\Task;

$task = new Task(1, 2);
assert($task->idCustomer == 1 && $task->idExecutor == 2);
$task1 = new Task(1);
assert($task1->idCustomer == 1 && is_null($task1->idExecutor));
assert($task->getStatus(PublishAction::ACTION_PUBLISH) == Task::STATUS_NEW);
assert($task->getStatus(PerformAction::ACTION_PERFORM) == Task::STATUS_PERFORMED);
assert($task->getStatus(SelectAction::ACTION_ARTIST_SELECTION) == Task::STATUS_IN_WORK);
assert($task->getStatus(CancelAction::ACTION_CANCEL) == Task::STATUS_CANCELED);
$task->idCurrentUser = 2;
assert($task->getStatus(FailAction::ACTION_FAIL) == Task::STATUS_FAILED);
$mapStatus = $task->mapStatus();
$status = [
    Task::STATUS_NEW => "Новое",
    Task::STATUS_CANCELED => "Отменено",
    Task::STATUS_IN_WORK => "В работе",
    Task::STATUS_PERFORMED => "Выполнено",
    Task::STATUS_FAILED => "Провалено"
];
assert($mapStatus == $status);
$actions = [
    PublishAction::ACTION_PUBLISH => "Опубликовать",
    CancelAction::ACTION_CANCEL => "Отмена",
    SelectAction::ACTION_ARTIST_SELECTION => "Выбор исполнителя",
    PerformAction::ACTION_PERFORM => "Завершить",
    FailAction::ACTION_FAIL => "Отказ от выполнения"
];
$mapActions = $task->mapActions();
assert($mapActions == $actions);
assert($task->getAvailableActions(Task::STATUS_NEW) == [CancelAction::ACTION_CANCEL, SelectAction::ACTION_ARTIST_SELECTION]);
assert($task->getAvailableActions(Task::STATUS_CANCELED) == []);
assert($task->getAvailableActions(Task::STATUS_PERFORMED) == []);
assert($task->getAvailableActions(Task::STATUS_FAILED) == []);
assert($task->getAvailableActions(Task::STATUS_IN_WORK) == [FailAction::ACTION_FAIL, PerformAction::ACTION_PERFORM]);

