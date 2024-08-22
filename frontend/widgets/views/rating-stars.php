<?php

/** @var integer $ratingValue */
/** @var string $ratingClass */

use frontend\widgets\RatingStarsWidget;
?>

<div class="stars-rating <?= $ratingClass; ?>">
    <?php for ($counter = RatingStarsWidget::RATING_MIN; $counter <= RatingStarsWidget::RATING_MAX; $counter++): ?>
        <span
                data-number="<?= $counter; ?>"
                class="stars-rating__star
                <?= $counter <= $ratingValue ? 'stars-rating__star--fill' : '' ?>"
        >&nbsp;</span>
    <?php endfor; ?>
    <!-- <input type="hidden" name="rating" class="stars-rating__value"> -->
</div>
