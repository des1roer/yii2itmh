<?php

use yii\db\Migration;

class m160322_045630_add_catalog_data extends Migration {

    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert('country', ['name'], [
            ['Австралия'],
            ['Австрия'],
            ['Азербайджан'],
            ['Албания'],
        ])->execute();
        Yii::$app->db->createCommand()->batchInsert('genre', ['name'], [
            ['аниме'],
            ['биографический'],
            ['боевик'],
            ['вестерн'],
        ])->execute();
        Yii::$app->db->createCommand()->batchInsert('actor', ['name'], [
            ['Эмили де Рэйвин'],
            ['Лариса Ерёмина'],
            ['Дэрил Ханна'],
            ['Анна Мэй Вонг'],
        ])->execute();
          Yii::$app->db->createCommand()->batchInsert('director', ['name'], [
            ['Вуди Аллен'],
            ['Ричард Айоаде'],
            ['Джун-хо Бон'],
            ['Френсис Форд Коппола'],
        ])->execute();
    }

    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('country', ['in', 'name', ['Австралия', 'Австрия', 'Азербайджан', 'Албания']]
        )->execute();
        Yii::$app->db->createCommand()->delete('genre', ['in', 'name', [ 'аниме', 'биографический', 'боевик', 'вестерн',]]
        )->execute();
        Yii::$app->db->createCommand()->delete('actor', ['in', 'name', ['Эмили де Рэйвин', 'Лариса Ерёмина', 'Дэрил Ханна', 'Анна Мэй Вонг']]
        )->execute();
          Yii::$app->db->createCommand()->delete('director', ['in', 'name', ['Вуди Аллен', 'Ричард Айоаде', 'Джун-хо Бон', 'Френсис Форд Коппола']]
        )->execute();
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
