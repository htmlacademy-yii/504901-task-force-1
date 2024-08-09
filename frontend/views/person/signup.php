<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
?>
<main class="page-main">
        <div class="main-container page-container">
            <section class="registration__user">
                <h1>Регистрация аккаунта</h1>
                <div class="registration-wrapper">
                <?php $form = ActiveForm::begin(['id' => 'form-signup', 
                'options' => ['class' => "registration__user-form form-create"]]); ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'autofocus' => true, 'placeholder' => "kumarm@mail.ru"])
                    ->label("Электронная почта"); ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => "Мамедов Кумар"])
                    ->label("Ваше имя"); ?>
                <?php 
                    $items = ArrayHelper::map($cities,'id','name');
                    $params = ['prompt' => 'Укажите город проживания'];
                    echo $form->field($model, 'city_id')->dropDownList($items,$params);
                ?>
                <?= $form->field($model, 'password')->passwordInput()->label("Пароль"); ?>
                <div class="form-group">
                    <?= Html::submitButton('Cоздать аккаунт', ['class' => 'button button__registration', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
                </div>
            </section>

        </div>
    </main>
