<?php

namespace app\modules\video\models;

/**
 * This is the model class for table "genre".
 *
 * @property integer $id
 * @property string $name
 *
 * @property VideoHasGenre[] $videoHasGenres
 */
class Genre extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genre';
    }

    public function getVideo()
    {
        return $this->hasMany(Video::className(), ['id' => 'video_id'])
                        ->viaTable('video_has_genre', ['genre_id' => 'id']);
    }
    /**
     * @inheritdoc
     */


}
