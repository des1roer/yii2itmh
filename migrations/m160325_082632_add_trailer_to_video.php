<?php

use yii\db\Migration;

class m160325_082632_add_trailer_to_video extends Migration
{
    public function up()
    {
        $this->addColumn('video', 'trailer', $this->string(255));
    }

    public function down()
    {
        $this->dropColumn('video', 'trailer');
    }
}
