<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'on beforeAction' => function(){
            if(!Yii::$app->user->isGuest){
                \common\models\User::updateAll(['activity'=>time()],['id'=>Yii::$app->user->id]);
            }
        },
    ],
];
