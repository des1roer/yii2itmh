<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{
    public function register()
    {
        // do your magic
        var_dump($this);
    }
}
