<?php

use yii\db\Migration;

class m160322_093527_unique_idx extends Migration {

    public function up()
    {
        Yii::$app->db->createCommand()->createIndex('uniq_director_has_video', 'director_has_video', 'director_id, video_id', true)->execute();
        Yii::$app->db->createCommand()->createIndex('uniq_actor_has_video', 'actor_has_video', 'actor_id, video_id', true)->execute();
        Yii::$app->db->createCommand()->createIndex('uniq_video_has_genre', 'video_has_genre', 'genre_id, video_id', true)->execute();
    }

    public function down()
    {
        echo "m160322_093527_unique_idx cannot be reverted.\n";

        return false;
    }

    /*
      // Use safeUp/safeDown to run migration code within a transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}
