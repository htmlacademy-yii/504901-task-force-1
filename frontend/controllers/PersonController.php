<?php

namespace frontend\controllers;
use Yii;

use frontend\models\User;
use frontend\models\City;
use frontend\models\LoginForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class PersonController extends \yii\web\Controller
{
    public $layout = 'landing';
    
    public function behaviors()
        {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?']
                    ]
                ]
            ]
        ];
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new User();
        $cities = City::find()->all();

        if (Yii::$app->request->getIsPost()) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['/']);
            }
        } else {
            $model->loadDefaultValues();
        }
    
        return $this->render('signup', [
            'model' => $model,
            'cities' => $cities,
        ]);
    }
    public function actionLogin()
    {
        $loginForm = new LoginForm();

        if (\Yii::$app->request->getIsPost()) {
            $loginForm->load(\Yii::$app->request->post());

            if ($loginForm->validate()) {
                $user = $loginForm->getUser();

                \Yii::$app->user->login($user);

                return $this->redirect(['/tasks']);
            }else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($loginForm);
            }
            
        }

       return $this->redirect(['landing/index']);
    }
}
