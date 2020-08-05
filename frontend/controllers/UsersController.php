<?php

namespace frontend\controllers;

use frontend\models\Profile;
use frontend\models\ProfileSpecialization;
use frontend\models\Specialization;
use yii\web\Controller;

/**
 * Users Controller
 */
class UsersController extends Controller
{
    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $users = Profile::find()
            ->with('city', 'statistic')
            ->joinWith('user')
            ->where(['id_role' => 2])
            ->orderBy(['date_of_registration' => SORT_DESC])
            ->all();
        $specializations = ProfileSpecialization::find()->with('specialization')->all();

        return $this->render('index', [
            'users' => $users,
            'specializations' => $specializations
        ]);
    }
}
