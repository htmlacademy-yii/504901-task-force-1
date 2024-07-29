<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
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

                    <!-- <form class="registration__user-form form-create">
                        <label for="16">Электронная почта</label>
                        <textarea class="input textarea" rows="1" id="16" name="" placeholder="kumarm@mail.ru"></textarea>
                        <span>Введите валидный адрес электронной почты</span>
                        <label for="17">Ваше имя</label>
                        <textarea class="input textarea" rows="1" id="17" name="" placeholder="Мамедов Кумар"></textarea>
                        <span>Введите ваше имя и фамилию</span>
                        <label for="18">Город проживания</label>
                        <select id="18" class="multiple-select input town-select registration-town" size="1" name="town[]">
                            <option value="Moscow">Москва</option>
                            <option selected value="SPB">Санкт-Петербург</option>
                            <option value="Krasnodar">Краснодар</option>
                            <option value="Irkutsk">Иркутск</option>
                            <option value="Bladivostok">Владивосток</option>
                        </select>
                        <span>Укажите город, чтобы находить подходящие задачи</span>
                        <label class="input-danger" for="19">Пароль</label>
                        <input class="input textarea " type="password" id="19" name="">
                        <span>Длина пароля от 8 символов</span>
                        <button class="button button__registration" type="submit">Cоздать аккаунт</button>
                    </form> -->
                </div>
            </section>

        </div>
    </main>
