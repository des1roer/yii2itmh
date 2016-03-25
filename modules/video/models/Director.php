<?php

namespace app\modules\video\models;

/**
 * This is the model class for table "director".
 *
 * @property integer $id
 * @property string $name
 *
 * @property DirectorHasVideo[] $directorHasVideos
 */
class Director extends BaseModel { //\yii\db\ActiveRecord {

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
    public function getVideo()
    {
        return $this->hasMany(Video::className(), ['id' => 'video_id'])
                        ->viaTable('director_has_video', ['director_id' => 'id']);
    }

}
