<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\video\models\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('video', 'Videos');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('video', 'Create Video'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'source',
            'title',
            'description:ntext',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data){
                    return Html::img($data->image,['class' => 'col-md-12']);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($data){
                    return $data->status == $data::STATUS_ACTIVE ? Yii::t('video','Active') : Yii::t('video','Disable');
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function($data){
                    return date('Y-m-d', $data->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($data){
                    return date('Y-m-d', $data->updated_at);
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
