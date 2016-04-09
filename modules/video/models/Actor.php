<?php

namespace app\modules\video\models;

/**
 * This is the model class for table "actor".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ActorHasVideo[] $actorHasVideos
 */
class Actor extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actor';
    }


    public function behaviors()
    {
        return [

            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'video_list' => 'video',
                ],
            ],
        ];
    }
    public function getVideo()
    {
        return $this->hasMany(Video::className(), ['id' => 'video_id'])
                        ->viaTable('actor_has_video', ['actor_id' => 'id']);
    }

}
