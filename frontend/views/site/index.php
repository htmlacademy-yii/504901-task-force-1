<?php

/* @var $this yii\web\View */

use frontend\models\Category;

$this->title = 'My Yii Application';
?>
<main class="page-main">
    <?php
    $categories = Category::find()->all();
    foreach ($categories as $category) {
        print($category['name']);
        print("<br>");
    }
    ?>

</main>