<?php

use frontend\models\FormatDate;
use yii\helpers\Url;
use frontend\models\Task;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use frontend\widgets\RatingStarsWidget;

$this->registerJsFile('@web/js/actions.js');
?>
<main class="page-main">
    <div class="main-container page-container">
        <section class="content-view">
            <div class="content-view__card">
                <div class="content-view__card-wrapper">
                    <div class="content-view__header">
                        <div class="content-view__headline">
                            <h1><?=$task->name_task?></h1>
                            <span>Размещено в категории
                                <?php
                                $link ="/tasks?FilterTasksForm[categories]=&FilterTasksForm[categories][]=".strval($task->category_id)."&FilterTasksForm[withoutResponse]=0&FilterTasksForm[remoteWork]=0&FilterTasksForm[period]=all&FilterTasksForm[search]="
                                ?>
                                <a href="<?=$link?>" class="link-regular"><?=$task->category->name?></a>
                                <?= FormatDate::dateDiff($task->date_of_creation)?> назад</span>
                        </div>
                        <b class="new-task__price new-task__price--clean content-view-price"><?=$task->budget?><b> ₽</b></b>
                        <div class="new-task__icon new-task__icon--<?= $task->category->icon ?> content-view-icon"></div>
                    </div>
                    <div class="content-view__description">
                        <h3 class="content-view__h3">Общее описание</h3>
                        <p>
                            <?= $task->description?>
                        </p>
                    </div>
                    <div class="content-view__attach">
                        <h3 class="content-view__h3">Вложения</h3>
                        <?php foreach($task->files as $file):?>
                        <a href='<?=Url::to("/$file->name");?>'><?=str_replace('uploads/', '', $file->name)?></a>
                        <?php endforeach;?>
                    </div>
                    <div class="content-view__location">
                        <h3 class="content-view__h3">Расположение</h3>
                        <div class="content-view__location-wrapper">
                            <div class="content-view__map">
                                <a href="#"><img src="/img/map.jpg" width="361" height="292"
                                                 alt="Москва, Новый арбат, 23 к. 1"></a>
                            </div>
                            <div class="content-view__address">
                            <span class="address__town">Москва</span><br>
                            <span>Новый арбат, 23 к. 1</span>
                                <p>Вход под арку, код домофона 1122</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-view__action-buttons">
                <?php if (!Yii::$app->user->identity->isExecutor() && !$responses):?>   
                    <?= Html::a('Откликнуться', ['/#', 'id' => 'action-response'], ['class' => 'button button__big-color response-button', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#responseModal']) ?>
                    
                    <!-- <button class=" button button__big-color response-button open-modal"
                            type="button" data-for="response-form">Откликнуться</button> -->
                <?php endif;?>
                <?php if (!Yii::$app->user->identity->isExecutor() && $task->status_id === Task::STATUS_IN_WORK):?>    
                    <?= Html::a('Отказаться', ['/#', 'id' => 'action-failed'], ['class' => 'button button__big-color refusal-button', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#failedModal']) ?>
                    
                    <!-- <button class="button button__big-color refusal-button open-modal"
                            type="button" data-for="refuse-form">Отказаться</button> -->
                <?php endif;?>
                <?php if (Yii::$app->user->identity->isExecutor() && $task->status_id === Task::STATUS_NEW ):?>
                    <?= Html::a('Отменить', ['/#', 'id' => 'action-cancel'], ['class' => 'button button__big-color refusal-button', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#cancelModal']) ?>
                    <!-- <button class="button button__big-color cancel-button open-modal"
                            type="button" data-for="refuse-form" >Отменить</button> -->
                <?php endif;?>
                <?php if (Yii::$app->user->identity->isExecutor() && $task->status_id === Task::STATUS_IN_WORK):?>
                    <?= Html::a('Завершить', ['/#', 'id' => 'action-performed'], ['class' => 'button button__big-color request-button', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#performedModal']) ?>
                    
                    <!-- <button class="button button__big-color request-button open-modal"
                            type="button" data-for="complete-form">Завершить</button> -->
                <?php endif;?>
                </div>
            </div>
            <?php if (count($task->responses)) :?>
            <div class="content-view__feedback">
                <h2>Отклики <span>(<?= count($task->responses) ?>)</span></h2>
                <div class="content-view__feedback-wrapper">
                    <?php foreach ($responses as $response): ?>
                    <div class="content-view__feedback-card">
                         <div class="feedback-card__top">
                            <a href="#"><img src="\img\<?=$response->user->avatar?>" width="55" height="55"></a>
                            <div class="feedback-card__top--name">
                                <p><a href="#" class="link-regular"><?= $response->user->name?></a></p>
                                <?php
                                $countStars = round($response->user->rating, 0);
                                for ($i = 0; $i < $countStars; $i++): ?>
                                    <span></span>
                                <?php endfor; ?>
                                <?php for ($i = $countStars; $i < 5; $i++): ?>
                                    <span class="star-disabled"></span>
                                <?php endfor; ?>
                                <b><?= number_format($response->user->rating, 2) ?></b>
                            </div>
                            <span class="new-task__time"><?= FormatDate::dateDiff($response->user->date_activity) ?> назад</span>
                        </div>
                        <div class="feedback-card__content">
                            <p>
                                <?= $response->message?>
                            </p>
                            <span><?=$response->cost?> ₽</span>
                        </div>
                        <?php if (Yii::$app->user->identity->isExecutor() && !$response->canceled && $task->status_id !== Task::STATUS_IN_WORK):?>
                        <div class="feedback-card__actions">
                            <a href="<?= Url::to(['/task/accept/' . $task->id .'/' . $response->user_id]); ?>" class="button__small-color request-button button"
                               type="button">Подтвердить</a>
                            <a href="<?= Url::to(['/task/refuse/' . $task->id .'/' . $response->id]); ?>" class="button__small-color refusal-button button"
                               type="button">Отказать</a>
                               <!-- <a class="button__small-color refusal-button button"
                               type="button">Отказать</a> -->
                        </div>
                        <?php endif;?>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <?php endif;?>
        </section>
        <section class="connect-desk">
            <div class="connect-desk__profile-mini">
                <div class="profile-mini__wrapper">
                    <h3>Заказчик</h3>
                    <div class="profile-mini__top">
                        <img src="/img/<?=$task->owner->avatar?>" width="62" height="62" alt="Аватар заказчика">
                        <div class="profile-mini__name five-stars__rate">
                            <p><?=$task->owner->name?></p>
                        </div>
                    </div>
                    <p class="info-customer"><span><?=$task->owner->count_tasks?></span><span class="last-">
                            <?= FormatDate::dateDiff($task->owner->date_of_registration) ?> на сайте</span></p>
                    <a href="#" class="link-regular">Смотреть профиль</a>
                </div>
            </div>
            <div id="chat-container">
                <!--                    добавьте сюда атрибут task с указанием в нем id текущего задания-->
                <chat class="connect-desk__chat"></chat>
            </div>
        </section>
    </div>
</main>
<?php Modal::begin([
    'title' => 'Отмена задания',
    'id' => 'cancelModal',
]);?>
        <p class="pop-up-text">
            <b>Внимание!</b><br>
            Вы собираетесь отменить задание.<br>
            После выполнения этого действия вы не сможете выбирать исполнителей. Также задание не будет показываться на главной странице в списке заданий.
        </p>
        <a href="<?= Url::to(['/task/cancel/' . $task->id]); ?>" class="button button--pop-up button--orange button--submit">Отказаться</a>
<?php Modal::end();?>

<?php Modal::begin([
    'title' => 'Завершение задания',
    'id' => 'performedModal',
]);?>
<?php $form = ActiveForm::begin([
                'id' => 'performed-form',
                'action' => Url::to(['/task/performed/' . $task->id]),
            ]); ?>
    
        <p class="form-modal-description">Задание выполнено?</p>
        <?= $form-> field ($task, 'radio')->radio(['value' => "yes"])->label('Да') ?>
        <?= $form-> field ($task, 'radio')->radio(['value' => "difficulties"])->label('Возникли проблемы') ?>
        <?= $form->field($task, 'comment')->textarea(['rows' => 4, 'placeholder' => 'Place your text'])    
                    ->label('Комментарий'); ?>
        <p class="form-modal-description">
            Оценка
            <?= RatingStarsWidget::widget(['ratingValue' => 5, 'ratingClass' => 'big active-stars']); ?>
            <?= $form->field($task, 'mark')->hiddenInput(['class'=> 'stars-rating__value'])->label(false);?>
        </p>
        <?= Html::submitButton('Отправить', ['id' => 'performed-form-submit', 'class' => 'button modal-button', 'name' => 'performed-button']);?>
            <?php ActiveForm::end(); ?>
<?php Modal::end();?>

<?php Modal::begin([
    'title' => 'Отклик на задание',
    'id' => 'responseModal',
]);?>
<?php $form = ActiveForm::begin([
                'id' => 'response-form',
                'action' => Url::to(['/task/response/' . $task->id]),
            ]); ?>
    
        <p class="form-modal-description">
            Вы собираетесь оставить свой отклик к этому заданию.
            Пожалуйста, укажите стоимость работы и добавьте комментарий, если необходимо.
        </p>
        <?= $form-> field ($task, 'cost')->textInput(['type' => 'number', 'required' => true])->label('Ваша цена ₽')?>
        <?= $form->field($task, 'comment')->textarea(['rows' => 4, 'placeholder' => 'Place your text'])    
                    ->label('Комментарий'); ?>
        <?= Html::submitButton('Отправить', ['id' => 'response-form-submit', 'class' => 'button modal-button', 'name' => 'response-button']);?>
            <?php ActiveForm::end(); ?>
<?php Modal::end();?>

<?php Modal::begin([
    'title' => 'Отказ от задания',
    'id' => 'failedModal',
]);?>
        <p>
            Вы собираетесь отказаться от выполнения задания.
            Это действие приведёт к снижению вашего рейтинга.
            Вы уверены?
        </p>
        <a href="<?= Url::to(['/task/view/' . $task->id]); ?>" class="button button--pop-up button--orange button--submit">Отмена</a>
        <!-- <?= Html::resetButton('Отмена', ['class' => 'reset class="button button--pop-up button--orange button--submit"']) ?> -->
        <a href="<?= Url::to(['/task/failed/' . $task->id . '/' . Yii::$app->user->identity->id]); ?>" class="button button--pop-up button--orange button--submit">Отказаться</a>
<?php Modal::end();?>
