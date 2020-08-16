<?php

namespace frontend\controllers;

use frontend\models\FilterUsersForm;
use frontend\models\Profile;
use frontend\models\Task;
use frontend\models\User;
use Yii;
use yii\web\Controller;

/**
 * Users Controller
 */
class UsersController extends Controller
{
    const MINUTES30 = 30 * 60;

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $filter = new FilterUsersForm();
        $query = Profile::find()
            ->with('city', 'statistic', 'categoryProfiles.category')
            ->joinWith('user')
            ->where(['id_role' => User::EXECUTOR])
            ->orderBy(['date_of_registration' => SORT_DESC]);

        if (Yii::$app->request->getIsPost()) {

            $filter->load(Yii::$app->request->post());
            if ($filter->categories) {
                $query->joinWith('categoryProfiles')->where(['category_id' => $filter->categories]);
            }
            if ($filter->freeNow) {
                $notFreeUsers = (new \yii\db\Query())
                    ->select(['id_executor'])
                    ->from('executor_task')
                    ->innerJoin('task', 'executor_task.id_task=task.id_task')
                    ->where(['status' => Task::STATUS_IN_WORK,
                    ])
                    ->all();
                $listUsers = [];
                foreach ($notFreeUsers as $notFeeUser) {
                    $listUsers[] = $notFeeUser['id_executor'];
                }
                $query->andWhere(['not in', 'profile.id_user', $listUsers]);
            }
            if ($filter->search) {
                $query->andWhere(['LIKE', 'user.name', $filter->search]);
            }
            if ($filter->onlineNow) {
                $query->andWhere(['>=', 'user.last_activity', time() - self::MINUTES30]);
            }
            if ($filter->withReviews) {
                $query->innerJoin('review', 'profile.id_user = review.id_user');
                //$query->andWhere(['not', ['review.id_user' => null]]);
            }
        }
        $users = $query->all();
        return $this->render('index', [
            'users' => $users,
            'filter' => $filter

        ]);
    }
}
