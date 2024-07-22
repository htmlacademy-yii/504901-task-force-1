<?php

namespace frontend\controllers;

use frontend\models\FilterTasksForm;
use frontend\models\Task;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
        $filter = new FilterTasksForm();
        $query = Task::find()
            ->with('category', 'city')
            ->where(['task.status' => Task::STATUS_NEW])
            ->orderBy(['date_of_creation' => SORT_DESC]);
     //   if (Yii::$app->request->getIsPost()) {

            $filter->load(Yii::$app->request->get());
            if ($filter->withoutResponse) {
                $query->joinWith('profileTasks');
                $query->andWhere(['profile_task.task_id' => null]);
            }
            if ($filter->categories) {
                $query->andWhere(['id_category' => $filter->categories]);
            }
            if ($filter->remoteWork) {
                $query->andWhere(['address' => null]);
            }
            if ($filter->search) {
                $query->andWhere(['LIKE', 'task.name_task', $filter->search]);
            }
            switch ($filter->period) {
                case 'day':
                    $query->andWhere(['>=', 'date_of_creation', date("Y-m-d H:i:s", strtotime("-1 day"))]);
                    break;
                case 'week':
                    $query->andWhere(['>=', 'date_of_creation', date("Y-m-d H:i:s", strtotime("-1 week"))]);
                    break;
                case 'month':
                    $query->andWhere(['>=', 'date_of_creation', date("Y-m-d H:i:s", strtotime("-1 month"))]);
                    break;
            }
 //       }
        $tasks = $query->all();
        return $this->render('index', [
            'tasks' => $tasks,
            'filter' => $filter,
        ]);
    }

    public function actionView($id)
    {
        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException("Задания с id $id не существует");
        }
        return $this->render('view',['task' => $task]);
    }
}
