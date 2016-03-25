<?php

namespace app\modules\video\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "actor".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ActorHasVideo[] $actorHasVideos
 */
class BaseModel extends \yii\db\ActiveRecord {

    public function getSubject_url($class = NULL)
    {
        if (empty($class)) $class = 'video';
        $classes = $this->$class;
        for ($i = 0; $i <= count($classes); $i++)
        {
            if (!empty($classes[$i]['name']))
                $class_[] = Html::a($classes[$i]['name'], ['/video/' . $class . '/view', 'id' => $classes[$i]['id'],], ['class' => 'btn btn-link']);
        }
        return ($class_) ? implode($class_) : '';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['video_list'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'video_list' => 'Фильмы'
        ];
    }

}
