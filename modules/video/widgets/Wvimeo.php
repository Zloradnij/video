<?php

namespace app\modules\video\widgets;

use yii\base\Widget;

class Wvimeo extends Widget
{
    public $frame_link;

    public function init()
    {

        parent::init();

        if ($this->frame_link === null) {
            return false;
        }
    }

    public function run()
    {
        print '<iframe src="' . $this->frame_link . '" width="300" height="200" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    }
}
