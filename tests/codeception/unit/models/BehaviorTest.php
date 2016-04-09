<?php

namespace models;

use app\modules\video\models\Actor;
use app\modules\video\models\Director;
use app\modules\video\models\Genre;
use app\modules\video\models\Video;
use yii\helpers\ArrayHelper;

class BehaviorTest extends \yii\codeception\DbTestCase {

    private function notEmpty($class, $param = null)
    {
        if (empty($param))
            $param = ['id', 'name'];
        return $res = ArrayHelper::map($class::find()->all(), $param[0], $param[1]);
    }

    private function saveAndDelete($model, $post, $param)
    {
        $this->assertNotEmpty($model, 'Load model');
        codecept_debug($param);
        $this->assertTrue($model->load($post), 'Load POST data');
        $this->assertTrue($model->save(), 'Save model');
        $model = $model::findOne(['name' => $param]);
        codecept_debug($model->id);
        $this->assertNotEmpty($model, 'Find model');
        $this->assertEquals(1, $model->delete(), 'Delete model');
    }

    // tests
    public function testMigration()
    {
        //проверяем применены ли миграции
        $this->assertNotEmpty($this->notEmpty(new Actor), 'Model Actor not empty');
        $this->assertNotEmpty($this->notEmpty(new Director), 'Model Director not empty');
        $this->assertNotEmpty($this->notEmpty(new Genre), 'Model Genre not empty');
        //$this->assertEmpty($this->notEmpty(new Video), 'Model Video empty');
    }

    public function testVideo()
    {
        //пробуем загрузить и удалить данные
        $param = uniqid();
        $post = ['Actor' =>
            ['name' => $param],
        ];
        $this->saveAndDelete(new Actor, $post, $param);

        $param = uniqid();
        $post = ['Director' =>
            ['name' => $param],
        ];
        $this->saveAndDelete(new Director, $post, $param);

        $param = uniqid();
        $post = ['Video' =>
            [
                'name' => $param,
                'origin_name' => $param,
                'director_list' => [ 1, 2, 3],
                'premiere' => '29.03.2016',
                
            ],
        ];
        codecept_debug($post);
        $this->saveAndDelete(new Video, $post, $param);
    }

}
