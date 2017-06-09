<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('video', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('video', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('video', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('video', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'frame_link',
            'source',
            'title',
            'description:ntext',
            [
                'attribute' => 'image',
                'value' => Html::img($model->image,['class' => 'col-md-4']),
                'format' => 'html'
            ],
            [
                'attribute' => 'status',
                'value' => $model->status == $model::STATUS_ACTIVE ? Yii::t('video','Active') : Yii::t('video','Disable'),
            ],
//            'created_by',
//            'updated_by',
            [
                'attribute' => 'created_at',
                'value' => date('Y-m-d', $model->created_at),
            ],
            [
                'attribute' => 'updated_at',
                'value' => date('Y-m-d', $model->updated_at),
            ],
        ],
    ]) ?>

</div>
