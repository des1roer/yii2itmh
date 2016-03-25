<?php

namespace app\modules\video;
use Yii;

class Module extends \yii\base\Module {

    public $controllerNamespace = 'app\modules\video\controllers';

  /*  public function beforeAction($action)
    {

        if (!parent::beforeAction($action))
        {
            return false;
        }

        if (!Yii::$app->user->isGuest)
        {
            return true;
        }
        else
        {
            Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());
            //для перестраховки вернем false
            return false;
        }
    }*/

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

}
