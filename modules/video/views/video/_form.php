<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'frame_link')->textInput() ?>

    <?php
    //= $form->field($model, 'title')->textInput(['maxlength' => true])
    ?>

    <?php
    //= $form->field($model, 'description')->textarea(['rows' => 6])
    ?>

    <!--
    <div class="container">
        <div class="col-md-6">
            <?= $form->field($model, 'file')->fileInput() ?>
        </div>
        <div class="col-md-6"><?php
            if(!empty($model->image)){?>
                <img src="<?= $model->image?>" alt="<?= $model->title?>" title="<?= $model->title?>" /><?php
            }?>
        </div>
    </div>
    -->

    <?= $form->field($model, 'status')->dropDownList([$model::STATUS_ACTIVE => 'Active', $model::STATUS_DELETED => 'Disable']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('video', 'Create') : Yii::t('video', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
