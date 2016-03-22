<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\video\models\Director;
use app\modules\video\models\Country;
use yii\widgets\Pjax;
use app\helpers\ImageResizeHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\video\models\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Video', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(['enablePushState' => false]) ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'origin_name',
            [
                'attribute' => 'origin_img',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img($data->imageurl, ['width' => '100']);
                },
                    ],
                         [
                'attribute' => 'origin_img',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img(ImageResizeHelper::init()->image($data->imageurl)->fit(500, 500)); //crop(500, 500));//Html::img($data->imageurl, ['width' => '100']);
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
                        'attribute' => 'year_start',
                        'value' => function($data) {
                            return $data->year_start . ' - ' . $data->year_end;
                        },
                    ],
                    [
                        'format' => 'raw',
                        'attribute' => 'director_list',
                        'value' => function($data) {
                            return $data->directors_url;
                        },
                    ],
                    // 'year_end',
                    // 'duration',
                    'premiere',
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
