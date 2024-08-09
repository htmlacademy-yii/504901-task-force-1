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
                'id' => 'login-form-local',
                ]);
                ?>

                <?= $form->field($model, 'email')->textInput(['id' => 'login-form-local-email', 'autofocus' => true, 'autocomplete' => 'off']) ?>

                <?= $form->field($model, 'password')->passwordInput(['id' => 'login-form-local-password', 'autocomplete' => 'off']) ?>

                
                <div class="form-group">
                    <?= Html::submitButton('Войти', ['class' => 'button button__registration', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); 
            Modal::end();
 
         