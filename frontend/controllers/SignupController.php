<?php

namespace frontend\controllers;
use Yii;

use frontend\models\User;
use frontend\models\City;


class SignupController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        //$this->layout = 'anon';

        $this->enableCsrfValidation = false;
        return true;
    }

    public function actionIndex()
    {
        $this->enableCsrfValidation = false;
        $model = new User();
        $cities = City::find()->all();

        if (Yii::$app->request->getIsPost()) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['/']);
            }
        } else {
            $model->loadDefaultValues();
        }
    
        return $this->render('index', [
            'model' => $model,
            'cities' => $cities,
        ]);
    }

}
