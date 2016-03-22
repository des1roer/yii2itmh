<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\VideoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'origin_name') ?>

    <?= $form->field($model, 'country_id') ?>

    <?= $form->field($model, 'year_start') ?>

    <?php // echo $form->field($model, 'year_end') ?>

    <?php // echo $form->field($model, 'duration') ?>

    <?php // echo $form->field($model, 'premiere') ?>

    <?php // echo $form->field($model, 'preview') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'origin_img') ?>

    <?php // echo $form->field($model, 'big_img') ?>

    <?php // echo $form->field($model, 'uploader') ?>

    <?php // echo $form->field($model, 'small_img') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
