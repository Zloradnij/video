<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('video', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$widget = 'app\modules\video\widgets\W' . $model->source;

?>
<div class="video-view">
    <?= $widget::widget([
        'frame_link' => $model->frame_link,
    ]);?>

</div>
