<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'layout' => 'common',
    'bootstrap' => ['log'],
    'language' => 'ru-Ru',
    'timeZone' => 'Asia/Yekaterinburg',
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'landing',
    'modules' => [
        'api' => [
            'class' => 'frontend\modules\api\Module'
        ]
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'landing/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'user/view/<id:\d+>' => 'users/view',
                'task/view/<id:\d+>' => 'tasks/view',
                'task/cancel/<id:\d+>' => 'tasks/cancel',
                'task/performed/<id:\d+>' => 'tasks/performed',
                'task/response/<id:\d+>' => 'tasks/response',
                'task/accept/<id:\d+>/<user:\d+>' => 'tasks/accept',
                'task/refuse/<id:\d+>/<user:\d+>' => 'tasks/refuse',
                'task/failed/<id:\d+>' => 'tasks/failed',
                'task/create' => 'tasks/create'
            ],
        ],
        'on beforeAction' => function(){
           if(!Yii::$app->user->isGuest){
                \frontend\models\User::updateAll(['date_activity'=>(new \DateTime())->format( 'Y-m-d H:i:s' )],['id'=>Yii::$app->user->id]);
            }
        },
    ],
    'params' => $params,
]; 
