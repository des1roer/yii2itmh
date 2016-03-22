<?php

namespace app\modules\video\models;

use Yii;
use yii\helpers\Html;
/**
 * This is the model class for table "director".
 *
 * @property integer $id
 * @property string $name
 *
 * @property DirectorHasVideo[] $directorHasVideos
 */
class Director extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'director';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['video_list'], 'safe'],
        ];
    }

    public function getVideo_url()
    {
        $videos = $this->videos;
        for ($i = 0; $i <= count($videos); $i++)
        {
            if (!empty($videos[$i]['name']))
                $video[] = Html::a($videos[$i]['name'], ['/video/video/view', 'id' => $videos[$i]['id'],], ['class' => 'btn btn-link']);
        }
        return ($video) ? implode($video) : '';
    }

    public function getVideos()
    {
        return $this->hasMany(Video::className(), ['id' => 'video_id'])
                        ->viaTable('director_has_video', ['director_id' => 'id']);
    }

    public function behaviors()
    {
        return [

            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'video_list' => 'videos',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'video_list' => 'Фильмы',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirectorHasVideos()
    {
        return $this->hasMany(DirectorHasVideo::className(), ['director_id' => 'id']);
    }

}
