<?php

namespace app\modules\job;

use app\modules\video\models\Video;

/**
 * This is the model class for table "video".
 *
 * @property integer $id
 * @property integer $link
 * @property integer $source
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class YandexVideo extends Video
{
    public $currentSource = 'yandex';

    public $metaTitle       = 'twitter:title';
    public $metaDescription = 'description';
    public $metaImage       = 'twitter:image';

    public function transformationLink($link){
        return $link;
    }
}
