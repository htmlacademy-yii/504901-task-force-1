<?php

use frontend\models\FormatDate;

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
                                $link ="/tasks?FilterTasksForm[categories]=&FilterTasksForm[categories][]=".strval($task->category->id_category)."&FilterTasksForm[withoutResponse]=0&FilterTasksForm[remoteWork]=0&FilterTasksForm[period]=all&FilterTasksForm[search]="
                                ?>
                                <a href="<?=$link?>" class="link-regular"><?=$task->category->name?></a>
                                <?= FormatDate::dateDiff(strtotime($task->date_of_creation))?> назад</span>
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
                        <a href="#">my_picture.jpeg</a>
                        <a href="#">agreement.docx</a>
                    </div>
                    <div class="content-view__location">
                        <h3 class="content-view__h3">Расположение</h3>
                        <div class="content-view__location-wrapper">
                            <div class="content-view__map">
                                <a href="#"><img src="/img/map.jpg" width="361" height="292"
                                                 alt="Москва, Новый арбат, 23 к. 1"></a>
                            </div>
                            <div class="content-view__address">
                                <span class="address__town"><?= $task->city->name ?></span><br>
                                <span><?= $task->address ?></span>
                                <p>Вход под арку, код домофона 1122</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-view__action-buttons">
                    <button class=" button button__big-color response-button open-modal"
                            type="button" data-for="response-form">Откликнуться</button>
                    <button class="button button__big-color refusal-button open-modal"
                            type="button" data-for="refuse-form">Отказаться</button>
                    <button class="button button__big-color request-button open-modal"
                            type="button" data-for="complete-form">Завершить</button>
                </div>
            </div>
            <div class="content-view__feedback">
                <h2>Отклики <span>(<?= count($task->profileTasks) ?>)</span></h2>
                <div class="content-view__feedback-wrapper">
                    <?php foreach ($task->profileTasks as $response): ?>
                    <div class="content-view__feedback-card">
                         <div class="feedback-card__top">
                            <a href="#"><img src="\img\<?=$response->profile->avatar?>" width="55" height="55"></a>
                            <div class="feedback-card__top--name">
                                <p><a href="#" class="link-regular"><?= $response->profile->user->name?></a></p>
                                <?php
                                $countStars = round($response->profile->statistic->rating, 0);
                                for ($i = 0; $i < $countStars; $i++): ?>
                                    <span></span>
                                <?php endfor; ?>
                                <?php for ($i = $countStars; $i < 5; $i++): ?>
                                    <span class="star-disabled"></span>
                                <?php endfor; ?>
                                <b><?= number_format($response->profile->statistic->rating, 2) ?></b>
                            </div>
                            <span class="new-task__time"><?= FormatDate::dateDiff($response->profile->user->last_activity) ?> назад</span>
                        </div>
                        <div class="feedback-card__content">
                            <p>
                                <?= $response->message?>
                            </p>
                            <span><?=$response->cost?> ₽</span>
                        </div>
                        <div class="feedback-card__actions">
                            <a class="button__small-color request-button button"
                               type="button">Подтвердить</a>
                            <a class="button__small-color refusal-button button"
                               type="button">Отказать</a>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </section>
        <section class="connect-desk">
            <div class="connect-desk__profile-mini">
                <div class="profile-mini__wrapper">
                    <h3>Заказчик</h3>
                    <div class="profile-mini__top">
                        <img src="/img/<?=$task->owner->profile->avatar?>" width="62" height="62" alt="Аватар заказчика">
                        <div class="profile-mini__name five-stars__rate">
                            <p><?=$task->owner->profile->user->name?></p>
                        </div>
                    </div>
                    <p class="info-customer"><span><?= count($task->owner) ?></span><span class="last-">
                            <?= FormatDate::dateDiff($task->owner->user->date_of_registration) ?> на сайте</span></p>
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
