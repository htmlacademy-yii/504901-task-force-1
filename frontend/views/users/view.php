<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\FormatDate;
use frontend\models\FormatPhone;
?>
<main class="page-main">
        <div class="main-container page-container">
            <section class="content-view">
                <div class="user__card-wrapper">
                    <div class="user__card">
                        <?= Html::img("@web/img/$user->avatar", ['alt' => 'Аватар пользователя', 'width' => '100', 'height' => '100']) ?>    
                        <div class="content-view__headline">
                            <h1><?=$user->name?></h1>
                            <p>Россия, <?=$user->city->name?>, <?=FormatDate::age($user->birthday)?></p>
                            <div class="profile-mini__name five-stars__rate">
                            <?php
                            $countStars = round($user->rating, 0);
                            for ($i = 0; $i < $countStars; $i++): ?>
                                <span></span>
                            <?php endfor; ?>
                            <?php for ($i = $countStars; $i < 5; $i++): ?>
                                <span class="star-disabled"></span>
                            <?php endfor; ?>
                            <b><?= number_format($user->rating, 2) ?></b>
                            </div>
                            <b class="done-task">Выполнил <?= $user->count_tasks ?> заказов</b><b class="done-review">Получил <?= $user->count_views ?> отзывов</b>
                         </div>
                        <div class="content-view__headline user__card-bookmark user__card-bookmark--current">
                            <span>Был на сайте <?= FormatDate::dateDiff($user->date_activity) ?> назад</span>
                             <a href="#"><b></b></a>
                        </div>
                    </div>
                    <div class="content-view__description">
                        <p><?= $user->about ?></p>
                    </div>
                    <div class="user__card-general-information">
                        <div class="user__card-info">
                            <h3 class="content-view__h3">Специализации</h3>
                            <div class="link-specialization">
                            <?php
                            foreach ($user->specializations as $item) {
                                $href = Url::to(['/tasks',  'FilterTasksForm[categories][]' => $item->category->id - 1]);
                                print "<a href='{$href}' class='link-regular'>{$item->category->name} </a>";
                            }
                            ?> 
                            </div>
                            <h3 class="content-view__h3">Контакты</h3> 
                            <div class="user__card-link">
                                <a class="user__card-link--tel link-regular" href="#"><?=FormatPhone::format($user->phone)?></a>
                                <a class="user__card-link--email link-regular" href="#"><?=$user->email?></a>
                                <a class="user__card-link--skype link-regular" href="#"><?=$user->skype?></a>
                            </div>
                         </div>
                        <div class="user__card-photo">
                            <h3 class="content-view__h3">Фото работ</h3>
                            <a href="#"><img src="/img/rome-photo.jpg" width="85" height="86" alt="Фото работы"></a>
                            <a href="#"><img src="/img/smartphone-photo.png" width="85" height="86" alt="Фото работы"></a>
                            <a href="#"><img src="/img/dotonbori-photo.png" width="85" height="86" alt="Фото работы"></a>
                         </div>
                    </div>
                </div>
                <div class="content-view__feedback">
                    <h2>Отзывы<span>(<?= count($user->reviews) ?>)</span></h2>
                    <div class="content-view__feedback-wrapper reviews-wrapper">
                    <?php foreach ($user->reviews as $review): ?>
                        <div class="feedback-card__reviews">
                            <p class="link-task link">Задание <a href="#" class="link-regular"><?=$review->task->name_task?></a></p>
                            <div class="card__review">
                                <a href="#"><?=Html::img("@web/img/{$review->task->owner->avatar}", ['alt' => 'Аватар заказчика', 'width' => '55', 'height' => '54']) ?>
                                </a>
                                <div class="feedback-card__reviews-content">
                                    <p class="link-name link"><a href="#" class="link-regular"><?=$review->task->owner->name?></a></p>
                                    <p class="review-text">
                                        <?=$review->comment?>
                                    </p>
                                </div>
                                <div class="card__review-rate">
                                    <p class="five-rate big-rate"><?=$review->mark?><span></span></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                            
                </div>
            </section>
            <section class="connect-desk">
                <div class="connect-desk__chat">

                </div>
            </section>
        </div>
    </main>