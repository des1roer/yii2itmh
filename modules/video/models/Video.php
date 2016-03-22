<?php

namespace app\modules\video\models;

use Yii;

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
class Video extends \yii\db\ActiveRecord
{
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
            [['name', 'origin_name', 'preview', 'description', 'origin_img', '100x145_img', '150x218_img'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['origin_name'], 'unique'],
            [['origin_img'], 'unique'],
            [['100x145_img'], 'unique'],
            [['150x218_img'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'origin_name' => 'Origin Name',
            'country_id' => 'Country ID',
            'year_start' => 'Year Start',
            'year_end' => 'Year End',
            'duration' => 'Duration',
            'premiere' => 'Premiere',
            'preview' => 'Preview',
            'description' => 'Description',
            'origin_img' => 'Origin Img',
            '100x145_img' => '100x145 Img',
            '150x218_img' => '150x218 Img',
            'uploader' => 'Uploader',
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
}
