<?php

namespace app\modules\video\models;

use Yii;

/**
 * This is the model class for table "director".
 *
 * @property integer $id
 * @property string $name
 *
 * @property DirectorHasVideo[] $directorHasVideos
 */
class Director extends \yii\db\ActiveRecord
{
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
            [['name'], 'unique']
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
