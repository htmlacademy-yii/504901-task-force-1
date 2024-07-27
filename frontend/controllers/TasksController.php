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
            ->joinWith('category')
            ->where(['status_id' => Task::STATUS_NEW])
            ->orderBy(['date_of_creation' => SORT_DESC]);
     
            $filter->load(Yii::$app->request->get());
            if ($filter->withoutResponse) {
                $query->join('LEFT JOIN', 'response', 'response.task_id = task.id');
                $query->andWhere(['task_id' => null]);
            }
            if ($filter->categories) {
                $categories = [];
                foreach($filter->categories as $category) {
                    $categories[] = $category + 1;
                }
                $query->andWhere(['in', 'category_id', $categories]);
            }
            if ($filter->remoteWork) {
                $query->andWhere(['address' => null]);
            }
            if ($filter->search) {
                $query->andWhere(['LIKE', 'task.name_task', $filter->search]);
            }
            switch ($filter->period) {
                case 'day':
                    $query->andWhere(['>=', 'date_of_creation', date("Y-m-d", strtotime("-1 day"))]);
                    break;
                case 'week':
                    $query->andWhere(['>=', 'date_of_creation', date("Y-m-d H:i:s", strtotime("-1 week"))]);
                    break;
                case 'month':
                    $query->andWhere(['>=', 'date_of_creation', date("Y-m-d H:i:s", strtotime("-1 month"))]);
                    break;
            };
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
