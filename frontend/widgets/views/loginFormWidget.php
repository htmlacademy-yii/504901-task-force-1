<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Modal;


    Modal::begin([
    'title'=>'<h4>Вход на сайт</h4>',
    'id'=>'login-modal',
]);
?>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'action' => '/person/login',
                
                ]); ?>



                <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'autocomplete' => 'off']) ?>

                <?= $form->field($model, 'password')->passwordInput(['autocomplete' => 'off']) ?>

                <?= Html::submitButton('Войти', ['id' => 'login-form-submit', 'class' => 'button button__registration', 'name' => 'login-button']);?>
   


    <?php ActiveForm::end(); 
   

    Modal::end();
