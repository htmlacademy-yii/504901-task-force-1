<?php

namespace frontend\controllers;

use frontend\models\Task;
use yii\web\Controller;

/**
 * Tasks Controller
 */
class TasksController extends Controller
{
    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $tasks = Task::find()
            ->with('city')
            ->with('category')
            ->joinWith('status')
            ->where(['status.name' => 'new'])
            ->orderBy(['date_of_creation' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'tasks' => $tasks,
        ]);
    }
}
