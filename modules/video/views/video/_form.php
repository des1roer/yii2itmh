<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\video\models\Director;
use app\modules\video\models\Country;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'origin_name')->textInput(['maxlength' => true]) ?>


    <?= Html::activeDropDownList($model, 'country_id', ArrayHelper::map(Country::find()->all(), 'id', 'name'), ['prompt' => 'Select...']) ?>
    <?= $form->field($model, 'year_start')->textInput() ?>

    <?= $form->field($model, 'year_end')->textInput() ?>

    <?=
            $form->field($model, 'director_list')
            ->dropDownList(ArrayHelper::map(Director::find()->all(), 'id', 'name'), ['multiple' => true])
    ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'premiere')->textInput() ?>

    <?= $form->field($model, 'preview')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'origin_img')->fileInput() ?>
    <?php echo ($model->origin_img) ? Html::img('/uploads/' . $model->origin_img, ['width' => 100, 'height' => 100]) : null ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
