<?php

namespace app\modules\video\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "video".
 *
 * @property integer $id
 * @property string $name
 * @property string $origin_name
 * @property integer $country_id
 * @property integer $year_start
 * @property integer $year_end
 * @property integer $duration
 * @property string $premiere
 * @property string $preview
 * @property string $description
 * @property string $origin_img
 * @property string $100x145_img
 * @property string $150x218_img
 * @property integer $uploader
 *
 * @property ActorHasVideo[] $actorHasVideos
 * @property DirectorHasVideo[] $directorHasVideos
 * @property Country $country
 * @property VideoHasGenre[] $videoHasGenres
 */
class Video extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'origin_name'], 'required'],
            [['country_id', 'year_start', 'year_end', 'duration', 'uploader'], 'integer'],
            [['premiere'], 'safe'],
            [['name', 'origin_name', 'preview', 'description'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['origin_name'], 'unique'],
            [['origin_img'], 'unique'],
            [['small_img'], 'unique'],
            [['big_img'], 'unique'],
            [['director_list'], 'safe'],
            [['origin_img', 'big_img', 'small_img'], 'file'],
        ];
    }

    public function getImageurl($data = null)
    {
        // return your image url here
        //echo $arg; $data->getImageurl(342)
        return \Yii::$app->request->BaseUrl . '/uploads/' . $data;
    }

    public function getDirectors_url()
    {
        $directors = $this->directors;
        for ($i = 0; $i <= count($directors); $i++)
        {
            if (!empty($directors[$i]['name']))
                $director[] = Html::a($directors[$i]['name'], ['/video/director/view', 'id' => $directors[$i]['id'],], ['class' => 'btn btn-link']);
        }
        return ($director) ? implode($director) : '';
    }

    public function getDirectors()
    {
        return $this->hasMany(Director::className(), ['id' => 'director_id'])
                        ->viaTable('director_has_video', ['video_id' => 'id']);
    }

    public function behaviors()
    {
        return [

            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'director_list' => 'directors',
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
            'id' => 'ID',
            'name' => 'Название',
            'origin_name' => 'Оригинальное название ',
            'country_id' => 'Страна',
            'year_start' => 'Даты создания',
            'year_end' => 'Year End',
            'duration' => 'Продолжительность (секунды)',
            'premiere' => 'Премьера',
            'preview' => 'Анонс',
            'description' => 'Описание',
            'origin_img' => 'Афиша',
            'small_img' => 'small_img',
            'big_img' => 'big_img',
            'uploader' => 'Uploader',
            'director_list' => 'Режиссёр',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActorHasVideos()
    {
        return $this->hasMany(ActorHasVideo::className(), ['video_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirectorHasVideos()
    {
        return $this->hasMany(DirectorHasVideo::className(), ['video_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoHasGenres()
    {
        return $this->hasMany(VideoHasGenre::className(), ['video_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {

              if ($this->premiere)
            $this->premiere = date('Y-m-d', strtotime($this->premiere));

            return true;
        }
        return false;
    }

    public function afterFind()
    {
        if ($this->premiere)
            $this->premiere = date('d.m.Y', strtotime($this->premiere));
    }

}
