<?php

namespace app\modules\video\models;

use Yii;

/**
 * This is the model class for table "actor".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ActorHasVideo[] $actorHasVideos
 */
class Actor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actor';
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
    public function getActorHasVideos()
    {
        return $this->hasMany(ActorHasVideo::className(), ['actor_id' => 'id']);
    }
}
