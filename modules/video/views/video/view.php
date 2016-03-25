<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\modules\video\models\Director;
use app\modules\video\models\Country;
use amnah\yii2\user\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id='trailer'>
  <?php  
  if ($model->trailer)
  {
  echo \wbraganca\videojs\VideoJsWidget::widget([
        'options' => [
            'class' => 'video-js vjs-default-skin vjs-big-play-centered',
            'poster' => $model->getImageurl($model->big_img),
            'controls' => true,
            'preload' => 'auto',
            'width' => '970',
            'height' => '400',
        ],
        'tags' => [
            'source' => [
                ['src' => $model->getImageurl($model->trailer), 'type' => 'video/mp4'],
            ],            
        ]
    ]);  
  }
  
  //echo $model->trailer; ?>
</div>
<div class="video-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'origin_name',
            ['attribute' => 'country_id', 'value' => $model->country->name,],
            [
                'format' => 'raw',
                'attribute' => 'year_start',
                'value' => $model->year_start . ' - ' . $model->year_end,
            ],
            [
                'format' => 'raw',
                'attribute' => 'director_list',
                'value' => $model->getSubject_url('director'),
            ],
            [
                'format' => 'raw',
                'attribute' => 'actor_list',
                'value' => $model->getSubject_url('actor'),
            ],
            [
                'format' => 'raw',
                'attribute' => 'genre_list',
                'value' => $model->getSubject_url('genre'),
            ],
            /*[
                'attribute' => 'origin_img',
                'format' => 'html',
                'value' => Html::img($model->getImageurl($model->origin_img), ['width' => '100']),
            ],*/
            'duration',
            'premiere',
            'preview',
            'description',         
            ['attribute' => 'uploader', 'value' => User::findIdentity($model->uploader)->username],
        
        ],
    ])
    ?>

</div>
