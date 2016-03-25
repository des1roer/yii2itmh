<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\video\models\Director;
use app\modules\video\models\Country;
use yii\widgets\Pjax;
use app\helpers\ImageResizeHelper;
use app\modules\video\models\Video;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\video\models\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>
    <?php
//$model = new Video;
    //$res =  ArrayHelper::map($model::find()->all(), 'id', 'name');
    //echo '<pre>';
//$res = $model::findOne(['name'=>'asdas'])->name;
    //      var_dump($res);
    // $res = \amnah\yii2\user\models\User::findIdentity(Yii::$app->user->identity->id)->username;
    // $res = app\models\User::findByUsername(Yii::$app->user->identity->username);
    //  var_dump($res);
    // echo Yii::$app->user->identity->username; 
    ?>
    <p>
        <?= Html::a('Create Video', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(['enablePushState' => false]) ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [


            'name',
            'origin_name',
            [
                'attribute' => 'origin_img',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img($data->getImageurl($data->origin_img), ['width' => '100']);
                },
                    ],
                    [
                        'attribute' => 'small_img',
                        'format' => 'html',
                        'value' => function($data) {
                            return Html::img($data->getImageurl($data->small_img), ['width' => '100']);
                        },
                            ],
                            [
                                'attribute' => 'country_id',
                                'format' => 'raw',
                                // 'label' => 'раса',
                                'filter' => ArrayHelper::map(Country::find()->all(), 'id', 'name'),
                                'value' => 'country.name'
                            ],
                            [
                                'format' => 'raw',
                                'attribute' => 'director_list',
                                'value' => function($data) {
                                    return $data->getSubject_url('director');
                                },
                            ],
                            [
                                'format' => 'raw',
                                'attribute' => 'genre_list',
                                'value' => function($data) {
                                    return $data->getSubject_url('genre');
                                },
                            ],
                            [
                                'format' => 'raw',
                                'attribute' => 'actor_list',
                                'value' => function($data) {
                                    return $data->getSubject_url('actor');
                                },
                            ],
                            // 'year_end',
                            // 'duration',
                       
                            // 'preview',
                            // 'description',
                            // 'origin_img',
                            // 'big_img',
                            // 'uploader',
                            // 'small_img',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                    <?php Pjax::end() ?>
</div>
