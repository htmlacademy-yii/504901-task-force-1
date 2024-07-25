<?php

namespace frontend\controllers;

use frontend\models\FilterUsersForm;
use frontend\models\Profile;
use frontend\models\Task;
use frontend\models\User;
use frontend\models\Specialization;
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
        $query = User::find()
            ->joinWith('city')
            ->where(['role' => User::EXECUTOR])
            ->orderBy(['date_of_registration' => SORT_DESC]);

       // $specialization = Specialization::find()->all();
        $users = $query->all();
        return $this->render('index', [
            'users' => $users,
            'filter' => $filter,
           // 'specialization' => $specialization,
        ]);
    }
}
