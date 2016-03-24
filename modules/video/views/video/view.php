<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\modules\video\models\Director;
use app\modules\video\models\Country;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
            'year_start',
            'year_end',
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
            [
                'attribute' => 'origin_img',
                'value' => $model->imageurl,
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
            'duration',
            'premiere',
            'preview',
            'description',
            'big_img',
            'uploader',
            'small_img',
        ],
    ])
    ?>

</div>
