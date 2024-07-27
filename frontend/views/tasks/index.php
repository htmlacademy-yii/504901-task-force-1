<main class="page-main">
    <div class="main-container page-container">
        <section class="new-task">
            <div class="new-task__wrapper">
                <h1>Новые задания</h1>
                <?php

                use frontend\models\Category;
                use frontend\models\FormatDate;
                use yii\helpers\Url;
                use yii\widgets\ActiveForm;
                use yii\helpers\Html;

                foreach ($tasks as $task):?>
                    <div class="new-task__card">
                        <div class="new-task__title">
                            <a href="<?= Url::to(['task/view/' . $task->id]); ?>" class="link-regular"><h2><?= $task->name_task ?></h2></a>
                            <a class="new-task__type link-regular" href="#"><p><?= $task->category->name ?></p></a>
                        </div>
                        <div class="new-task__icon new-task__icon--<?= $task->category->icon ?>"></div>
                        <p class="new-task_description">
                            <?= $task->description ?>
                        </p>
                        <b class="new-task__price new-task__price--translation"><?= $task->budget ?><b> ₽</b></b>
                        <p class="new-task__place">
                           <?php if (!is_null($task->address)): ?>
                            <?= $task->address ?>
                            <?php endif;?>
                        </p>
                        <span class="new-task__time"><?= FormatDate::dateDiff($task->date_of_creation) ?> назад</span>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="new-task__pagination">
                <ul class="new-task__pagination-list">
                    <li class="pagination__item"><a href="#"></a></li>
                    <li class="pagination__item pagination__item--current">
                        <a>1</a></li>
                    <li class="pagination__item"><a href="#">2</a></li>
                    <li class="pagination__item"><a href="#">3</a></li>
                    <li class="pagination__item"><a href="#"></a></li>
                </ul>
            </div>
        </section>
        <section  class="search-task">
                <div class="search-task__wrapper">
                    <?php $form = ActiveForm::begin([
                        'id' => 'filter-form',
                        'options' => ['class' => 'search-task__form'],
                        'action' => ['/tasks'],
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
                    <?= $form->field($filter, 'withoutResponse', [
                        'template' => '{input}{label}',
                        'options' => ['class' => ''],
                    ])
                        ->checkbox([
                            'class' => 'visually-hidden checkbox__input',
                        ], false) ?>
                    <?= $form->field($filter, 'remoteWork', [
                        'template' => '{input}{label}',
                        'options' => ['class' => ''],
                    ])
                        ->checkbox([
                            'class' => 'visually-hidden checkbox__input',
                        ], false) ?>
                </fieldset>
                <label class="search-task__name" for="8">Период</label>
                <?= $form->field($filter, 'period', [
                    'options' => ['tag' => false],
                    'template' => '{label}{input}'
                ])
                    ->label(false)
                    ->dropDownList($filter->attributeLabelsPeriod(),
                        [
                            'class' => 'multiple-select input',
                            
                        ]); ?>

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
