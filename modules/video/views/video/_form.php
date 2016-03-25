<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\video\models\Director;
use app\modules\video\models\Actor;
use app\modules\video\models\Genre;
use app\modules\video\models\Country;
use dosamigos\datepicker\DatePicker;
use dosamigos\datepicker\DateRangePicker;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>
<?= Yii::$app->session->getFlash('error'); ?>
<div class="video-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'origin_name')->textInput(['maxlength' => true]) ?>

    <label class="control-label" for="year_start">Страна</label>
    <?= Html::activeDropDownList($model, 'country_id', ArrayHelper::map(Country::find()->all(), 'id', 'name'), ['prompt' => 'Select...']) ?>

    <?=
    $form->field($model, 'year_start')->widget(DateRangePicker::className(), [
        'attributeTo' => 'year_end',
        'form' => $form, // best for correct client validation
        'language' => 'ru',
        // 'size' => 'lg',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy',
            'minViewMode' => 2,
        ]
    ]);
    ?>
    <?=
            $form->field($model, 'director_list')
            ->dropDownList(ArrayHelper::map(Director::find()->all(), 'id', 'name'), ['multiple' => true])
    ?>
    <?=
            $form->field($model, 'actor_list')
            ->dropDownList(ArrayHelper::map(Actor::find()->all(), 'id', 'name'), ['multiple' => true])
    ?>
        <?=
            $form->field($model, 'genre_list')
            ->dropDownList(ArrayHelper::map(Genre::find()->all(), 'id', 'name'), ['multiple' => true])
    ?>
    <?= $form->field($model, 'duration')->textInput() ?>


    <?php /*
      DatePicker::widget([
      'model' => $model,
      'attribute' => 'premiere',
      'template' => '{addon}{input}',
      'clientOptions' => [
      'autoclose' => true,
      'format' => 'dd-M-yyyy'
      ]
      ]); */
   // $filename = '56f120b65cd28.png';
    //  $img = Image::make(Yii::$app->urlManager->createAbsoluteUrl('uploads') .'/'.$filename)->resize(100, 145)->save(Yii::$app->getBasePath().DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'small_'. $filename);
           //         echo Yii::$app->urlManager->createAbsoluteUrl('uploads') .'/'.'56f120b65cd28.png';  
    ?>
    <?=
    $form->field($model, 'premiere')->widget(
            DatePicker::className(), [
        // inline too, not bad                
        //'inline' => TRUE,
        'language' => 'ru',
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd.mm.yyyy'
        ]
    ]);
    ?>
    <?= $form->field($model, 'preview')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textArea(['rows' => 6, 'maxlength' => true]) ?>

    <?= $form->field($model, 'origin_img')->fileInput() ?>
    <?php echo ($model->origin_img) ? Html::img('/uploads/' . $model->origin_img, ['width' => 100, 'height' => 100]) : null ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
