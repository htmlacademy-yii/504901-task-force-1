<?php

namespace frontend\widgets;

use yii\base\Widget;

class RatingStarsWidget extends Widget
{
    public $ratingValue;
    public $ratingClass;
    const RATING_MIN = 1;
    const RATING_MAX = 5;
 
    public function init()
    {
        parent::init();
        if (empty($this->ratingValue)) {
            $this->ratingValue = 0;
        }

        if (empty($this->ratingClass)) {
            $this->ratingClass = 'small';
        }
    }

    public function run()
    {
        $ratingValue = $this->ratingValue;
        $ratingClass = $this->ratingClass;

        return $this->render('rating-stars', compact('ratingValue', 'ratingClass'));
    }
}
