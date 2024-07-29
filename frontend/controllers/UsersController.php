<?php

namespace frontend\controllers;

use frontend\models\FilterUsersForm;
use frontend\models\Profile;
use frontend\models\Task;
use frontend\models\User;
use frontend\models\Specialization;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Users Controller
 */
class UsersController extends Controller
{
    const MINUTES30 = "-30 minute";

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $filter = new FilterUsersForm();
        $query = User::find()
            ->joinWith('city')
            ->where(['role' => User::EXECUTOR])
            ->orderBy(['date_of_registration' => SORT_DESC]);

            $filter->load(Yii::$app->request->get());    
            if ($filter->categories) {
                $categories = [];
                foreach($filter->categories as $category) {
                    $categories[] = $category + 1;
                }
                $query->joinWith('specializations');
                $query->andWhere(['in', 'category_id', $categories]);
            }
            if ($filter->freeNow) {
                $notFreeUsers = (new \yii\db\Query())
                    ->select(['executor_id'])
                    ->from('executor_task')
                    ->innerJoin('task', 'executor_task.task_id=task.id')
                    ->where(['executor_task.status_id' => Task::STATUS_IN_WORK,
                    ])
                    ->all();
                $listUsers = [];
                foreach ($notFreeUsers as $notFreeUser) {
                    $listUsers[] = $notFreeUser['executor_id'];
                }
                $query->andWhere(['not in', 'user.id', $listUsers]);
            }
            if ($filter->search) {
                $query->andWhere(['LIKE', 'user.name', $filter->search]);
            }
            if ($filter->onlineNow) {
                $query->andWhere(['>=', 'user.date_activity', date("Y-m-d H:i:s", strtotime(SELF::MINUTES30))]);
            }
            if ($filter->withReviews) {
                $reviews = (new \yii\db\Query())
                    ->select(['user_id'])
                    ->from('review')
                    ->groupBy(['user_id'])
                    ->all();
                $listUsers = [];
                foreach ($reviews as $review) {
                        $listUsers[] = $review['user_id'];
                    }
                $query->andWhere(['in', 'user.id', $listUsers]);
            }
        $users = $query->all();
        return $this->render('index', [
            'users' => $users,
            'filter' => $filter,
        ]);
    }

    public function actionView($id)
    {
        $user = User::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException("Задания с id $id не существует");
        }
        return $this->render('view',['user' => $user]);
    }
}
