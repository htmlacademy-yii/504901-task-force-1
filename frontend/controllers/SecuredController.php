<?php
namespace frontend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii;

abstract class SecuredController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                        'denyCallback' => function() 
                        {
                            return Yii::$app->getResponse()->redirect(['/']);
                        }
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                   ], 
                ]
            ]
        ];
    }
}
