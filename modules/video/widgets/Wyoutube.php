<?php

namespace app\modules\video\widgets;

use yii\base\Widget;

class Wyoutube extends Widget
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
        print '<iframe width="300" height="200" src="' . $this->frame_link . '" frameborder="0" allowfullscreen></iframe>';
    }
}
