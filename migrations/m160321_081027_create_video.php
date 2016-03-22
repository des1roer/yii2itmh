<?php

use yii\db\Migration;

class m160321_081027_create_video extends Migration {
/*https://github.com/yiisoft/yii2/blob/master/docs/guide-ru/db-migrations.md*/
    public function up()
    {
        $this->createTable('country', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull()->unique(),
        ]);
        $this->createTable('video', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique(),
            'origin_name' => $this->string(255)->notNull()->unique(),
            'country_id' => $this->integer(),
            'year_start' => $this->integer(),
            'year_end' => $this->integer(),
            'duration' => $this->integer(),
            'premiere' => $this->dateTime(),
            'preview' => $this->string(255),
            'description' => $this->string(255),
            'origin_img' => $this->string(255),
            'small_img' => $this->string(255),
            'big_img' => $this->string(255),
            'uploader' => $this->integer(),
        ]);
        $this->createIndex('idx-country_id', 'video', 'country_id');
        $this->addForeignKey('fk-country_id', 'video', 'country_id', 'country', 'id', 'CASCADE');

        $this->createTable('genre', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull()->unique(),
        ]);
        $this->createTable('video_has_genre', [
            'id' => $this->primaryKey(),
            'video_id' => $this->integer(),
            'genre_id' => $this->integer(),
        ]);

        $this->createIndex('idx-video_id', 'video_has_genre', 'video_id');
        $this->addForeignKey('fk-video_id', 'video_has_genre', 'video_id', 'video', 'id', 'CASCADE');

        $this->createIndex('idx-genre_id', 'video_has_genre', 'genre_id');
        $this->addForeignKey('fk-genre_id', 'video_has_genre', 'genre_id', 'genre', 'id', 'CASCADE');

        $this->createTable('director', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull()->unique(),
        ]);
        $this->createTable('director_has_video', [
            'id' => $this->primaryKey(),
            'director_id' => $this->integer(),
            'video_id' => $this->integer(),
        ]);

        $this->createIndex('idx-director_id', 'director_has_video', 'director_id');
        $this->addForeignKey('fk-director_id', 'director_has_video', 'director_id', 'director', 'id', 'CASCADE');

        $this->createIndex('idx-director_has_video', 'director_has_video', 'video_id');
        $this->addForeignKey('fk-director_has_video', 'director_has_video', 'video_id', 'video', 'id', 'CASCADE');

        $this->createTable('actor', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull()->unique(),
        ]);
        $this->createTable('actor_has_video', [
            'id' => $this->primaryKey(),
            'actor_id' => $this->integer(),
            'video_id' => $this->integer(),
        ]);

        $this->createIndex('idx-actor_id', 'actor_has_video', 'actor_id');
        $this->addForeignKey('fk-actor_id', 'actor_has_video', 'actor_id', 'actor', 'id', 'CASCADE');

        $this->createIndex('idx-actor_has_video', 'actor_has_video', 'video_id');
        $this->addForeignKey('fk-actor_has_video', 'actor_has_video', 'video_id', 'video', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('actor_has_video');
        $this->dropTable('director_has_video');
        $this->dropTable('video_has_genre');
        $this->dropTable('video');
        $this->dropTable('country');
        $this->dropTable('actor');
        $this->dropTable('director');
        $this->dropTable('genre');
    }

}

/*CREATE TABLE IF NOT EXISTS `mydb`.`country` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;*/
