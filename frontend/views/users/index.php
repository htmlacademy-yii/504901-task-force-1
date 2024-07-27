<main class="page-main">
    <div class="main-container page-container">
        <section class="user__search">
            <div class="user__search-link">
                <p>Сортировать по:</p>
                <ul class="user__search-list">
                    <li class="user__search-item user__search-item--current">
                        <a href="#" class="link-regular">Рейтингу</a>
                    </li>
                    <li class="user__search-item">
                        <a href="#" class="link-regular">Числу заказов</a>
                    </li>
                    <li class="user__search-item">
                        <a href="#" class="link-regular">Популярности</a>
                    </li>
                </ul>
            </div>
            <?php 
            use frontend\models\Category;
            use frontend\models\FormatDate;
            use yii\helpers\Html;
            use yii\widgets\ActiveForm;
            use yii\helpers\Url;

            foreach ($users as $user): ?>
                <div class="content-view__feedback-card user__search-wrapper">
                    <div class="feedback-card__top">
                        <div class="user__search-icon">
                            <a href="<?= Url::to(['user/view/' . $user->id]); ?>"><img src="./img/<?= $user->avatar ?>" width="65" height="65"></a>
                            <span><?= $user->count_tasks ?> заданий</span>
                            <span><?= $user->count_views ?> отзывов</span>
                        </div>
                        <div class="feedback-card__top--name user__search-card">
                            <p class="link-name"><a href="<?= Url::to(['user/view/' . $user->id]); ?>" class="link-regular"><?=$user->name?></a></p>
                            <?php
                            $countStars = round($user->rating, 0);
                            for ($i = 0; $i < $countStars; $i++): ?>
                                <span></span>
                            <?php endfor; ?>
                            <?php for ($i = $countStars; $i < 5; $i++): ?>
                                <span class="star-disabled"></span>
                            <?php endfor; ?>
                            <b><?= number_format($user->rating, 2) ?></b>
                            <p class="user__search-content">
                                <?= $user->about ?>
                            </p>
                        </div>
                        <span class="new-task__time">Был на сайте <?= FormatDate::dateDiff($user->date_activity) ?> назад</span>
                    </div>
                    <div class="link-specialization user__search-link--bottom">
                        <?php
                        foreach ($user->specializations as $item) {
                            $href = Url::to(['/tasks',  'FilterTasksForm[categories][]' => $item->category->id - 1]);
                            print "<a href='{$href}' class='link-regular'>{$item->category->name} </a>";
                        }
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
        <section class="search-task">
            <div class="search-task__wrapper">
                <?php $form = ActiveForm::begin([
                    'id' => 'filter-user-form',
                    'options' => ['class' => 'search-task__form'],
                    'action' => ['/users'],
                    'method' => 'get'
                ]); ?>
                <fieldset class="search-task__categories">
                    <legend>Категории</legend>
                    <?= $form->field($filter, 'categories')
                        ->checkboxList(Category::find()->select(['name', 'id'])->column(),
                            [
                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $checked = $checked ? 'checked' : '';
                                    return "<input class=\"visually-hidden checkbox__input\" id='{$index}' type='checkbox' name='{$name}' value='{$value}' $checked >
										<label for='{$index}'>{$label}</label>";
                                }])->label(false) ?>
                </fieldset>

                <fieldset class="search-task__categories">
                    <legend>Дополнительно</legend>
                    <?= $form->field($filter, 'freeNow', [
                        'template' => '{input}{label}',
                        'options' => ['class' => ''],
                    ])
                        ->checkbox([
                            'class' => 'visually-hidden checkbox__input',
                        ], false) ?>
                    <?= $form->field($filter, 'onlineNow', [
                        'template' => '{input}{label}',
                        'options' => ['class' => ''],
                    ])
                        ->checkbox([
                            'class' => 'visually-hidden checkbox__input',
                        ], false) ?>
                    <?= $form->field($filter, 'withReviews', [
                        'template' => '{input}{label}',
                        'options' => ['class' => ''],
                    ])
                        ->checkbox([
                            'class' => 'visually-hidden checkbox__input',
                        ], false) ?>
                    <?= $form->field($filter, 'withFavorites', [
                        'template' => '{input}{label}',
                        'options' => ['class' => ''],
                    ])
                        ->checkbox([
                            'class' => 'visually-hidden checkbox__input',
                        ], false) ?>
                </fieldset>
                <?= $form->field($filter, 'search', [
                    'template' => '{label}{input}',
                    'options' => ['class' => ''],
                    'labelOptions' => ['class' => 'search-task__name']
                ])
                    ->input('search', [
                        'class' => 'input-middle input',
                        'style' => 'width: 100%'
                    ]);
                ?>

                <?= Html::submitButton('Искать', ['class' => 'button']); ?>
                <?php ActiveForm::end(); ?>
            </div>
        </section>
    </div>
</main>